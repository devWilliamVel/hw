<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     * @throws ValidationException
     */
    public function loginWithActiveVerification(Request $request)
    {
        $this->validateLogin($request);

        $user = User::where('email','=',$request->input('email'))->first();
        if ( ! empty($user->id) )
        {
            if ( $user->active )
            {
                $this->login($request);
            }
            else
            {
                throw ValidationException::withMessages([
                    'email' => ['cuenta desactivada, contacta un adminitrador'],
                ]);
            }
        }
        else
        {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
    }
}
