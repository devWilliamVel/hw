<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Libraries\Permissions;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AuthenticatesUsers;

    private $maxFailedLoginAttempts = 3;

    public function __construct()
    {
        $this->middleware('admin')->except(['login', 'profile', 'updateUserProfile', 'updateUserPassword']);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $email = strtolower(trim($request->input('email')));
        $user = User::where('email', $email)->first();

        if ( ! empty($user->id) )
        {
            $attempts = intval($user->failed_login_attempts);

            if ( $attempts >= $this->maxFailedLoginAttempts )
                return back()->withErrors(['errore' => "La cuenta '" . $email . "' ha sido bloqueada por repetidos intentos fallidos de login"]);

            if ( $user->active )
            {
                if ($this->attemptLogin($request))
                {
                    $user->failed_login_attempts = 0;
                    $user->save();

                    return $this->sendLoginResponse($request);
                }

                $user->failed_login_attempts = $attempts + 1;
                if ( $user->failed_login_attempts >= $this->maxFailedLoginAttempts )
                    $user->active = 0;

                $user->save();
            }
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function register(RegisterUserRequest $request)
    {
        if ( ! Auth::user()->hasRole([Permissions::ROLE_SUPER_ADMIN]) )
            return redirect('home');

        $user = User::create([
            'name' => $request->input('name'),
            'email' => strtolower(trim($request->input('email'))),
            'password' => Hash::make($request->input('password')),
            'active' => empty($request->input('name')) ? 0 : 1,
        ]);

        if ( empty($user->id) )
            return back()->withErrors("Errore! L'utente non è stato registrato, riprovare");

        event(new Registered($user));

        return redirect()->route('user.edit', ['id' => $user->id])->with('successMsg', "L'utente " . $user->name . " è stato registrato");
    }

    public function edit($id) {

        $id = intval($id);
        $user = User::find($id);
        $loggedUser = Auth::user();

        if ( ! Auth::user()->hasRole([Permissions::ROLE_SUPER_ADMIN]) && $user->id !== $loggedUser->id )
        {
            return redirect('home');
        }

        if ( empty($user->id) )
            return redirect('users');

        return view('users.edit')
            ->with('user', $user);
    }

    public function updateUser(UserUpdateRequest $request, $id) {
        $id = intval($id);
        $user = User::find($id);

        if ( empty($user->id) )
            return redirect('users');

        $oldActive = intval($user->active);
        $active = $request->input('active') ? 1 : 0;

        $user->name = $request->input('name');
        $user->email = strtolower(trim($request->input('email')));
        $user->active = $active;
        $user->is_admin = $request->input('is_admin') ? 1 : 0;
        if ( ! $active || (! $oldActive && $active) )
            $user->failed_login_attempts = 0;

        $user->update();

        return back()->with('successMsg', "L'utente è stato aggiornato");
    }

    public function updatePassword(PasswordRequest $request, $id) {
        $id = intval($id);
        $user = User::find($id);

        if ( empty($user->id) )
            return redirect('users');

        $user->password = Hash::make($request->input('password'));
        $user->updated_at = date('Y-m-d H:i:s');
        $user->update();

        return back()->with('status', 'La password è stata aggiornata');
    }

    public function enableDisableUser(Request $request)
    {
        $id = intval($request->input('id'));
        $user = User::find($id);

        if (empty($user->id))
        {
            $active = 0;
            $resultCode = config('constants.http_response.bad_request');
        }
        else
        {
            $active = intval($user->active) ? 1 : 0;
            $user->active = ($active+1)%2;
            if ( ! $active )
                $user->failed_login_attempts = 0;

            $user->save();
            $resultCode = config('constants.http_response.ok');
        }

        return response()->json(['active' => ! $active], $resultCode);
    }

    /**
     * visualizza la pagina di profilo dell'utente loggato, nel caso l'utente non esiste, si fa una redirect alla
     * pagina di login
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function profile()
    {
        $user = Auth::user();

        if ( empty($user->id) )
            return redirect()->route('login');

        return view('users.profile')->with('user', $user);
    }

    /**
     * Modifica i dati dell'utente loggato, nel caso in cui non è stato effetuato il login, si fa una redirect alla
     * pagina di login
     *
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserProfile(UserUpdateRequest $request)
    {
        $user = Auth::user();

        if ( empty($user->id) )
            return redirect()->route('login');

        $user->email = trim(strtolower($request->input('email')));
        $user->name = trim(strtolower($request->input('name')));
        $user->update();

        return redirect()->route('user.profile')->with('successMsg', "I dati dell'utente sono stati aggiornati");
    }

    /**
     * Modifica la password dell'utente loggato, nel caso in cui non è stato effetuato il login, si fa una redirect alla
     * pagina di login
     *
     * @param PasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserPassword(PasswordRequest $request)
    {
        $user = Auth::user();

        if ( empty($user->id) )
            return redirect()->route('login');

        $user->password = Hash::make($request->input('password'));
        $user->updated_at = date('Y-m-d H:i:s');
        $user->update();

        return back()->with('status', 'La password è stata aggiornata');
    }
}
