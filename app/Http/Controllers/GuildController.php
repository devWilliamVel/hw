<?php

namespace App\Http\Controllers;

use App\Models\GuildModel;
use App\Models\GuildPlayerModel;
use Illuminate\Http\Request;

class GuildController extends Controller
{
    public function index ()
    {
        $guilds = GuildModel::all();
        $successMsg = session('successMsg') ?? '';
        $errorMsg = session('errorMsg') ?? '';

        return view('guild.index')
            ->with('guilds', $guilds)
            ->with('successMsg', $successMsg)
            ->with('errorMsg', $errorMsg);
    }

    public function show ( $id )
    {
        $guild = GuildModel::findOrFail($id);
        $members = $guild->members;

        return view('guild.show')
            ->with('guild', $guild)
            ->with('members', $members);
    }

    public function store ( Request $request )
    {
        $name = trim($request->input('name'));

        if ( strlen($name) > 0 )
        {
            $counter = GuildModel::where('name', '=', $name)->count();

            if ( ! $counter )
            {
                try
                {
                    GuildModel::create([ 'name' => $name ]);

                    $request->session()->flash('successMsg', __('guild.guild_create'));
                }
                catch ( \Exception $e )
                {
                    $request->session()->flash('errorMsg', __('messages.server_error_on_delete'));
                }
            }
            else
                $request->session()->flash('errorMsg', __('guild.cannot_store_exist_guild'));
        }
        else
            $request->session()->flash('errorMsg', __('messages.error_empty_data'));

        return back();
    }

    public function update( Request $request )
    {
        $guildId = intval($request->input('guildId'));
        $name = trim($request->input('currentName'));

        if ( $guildId > 0 && strlen($name) > 0 )
        {
            try
            {
                GuildModel::where('id', '=', $guildId)
                    ->update(['name'=>$name]);

                return back()->with('successMsg', __('messages.success_update'));
            }
            catch ( \Exception $e )
            {
                return back()->with('errorMsg', __('messages.error_on_saving'));
            }
        }

        return back()->with('errorMsg', __('messages.error_empty_data'));
    }

    public function delete( Request $request, int $id )
    {
        $guild = GuildModel::findOrFail($id);

        try
        {
            GuildPlayerModel::where('guild_id', '=', $guild->id)->delete();
            $guild->delete();
        }
        catch ( \Exception $e )
        {
            $request->session()->flash('errorMsg', __('messages.server_error_on_delete'));
        }

        return back();
    }
}
