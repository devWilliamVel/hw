<?php

namespace App\Http\Controllers;

use App\Models\GuildModel;
use App\Models\TeamHeroesFullInformationModel;
use App\Models\TeamHeroesFullPowerModel;
use App\Models\TeamHeroesWithPowerModel;
use App\Models\TeamTitansFullInformationModel;
use App\Models\TeamTitansFullPowerModel;
use App\Models\TeamTitansWithPowerModel;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $thfim = TeamHeroesFullInformationModel::query()->whereBetween('created_at',[date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:29:29'])->count();
        $thfpm = TeamHeroesFullPowerModel::query()->whereBetween('created_at',[date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:29:29'])->count();
        $thwpm = TeamHeroesWithPowerModel::query()->whereBetween('created_at',[date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:29:29'])->count();
        $ttfim = TeamTitansFullInformationModel::query()->whereBetween('created_at',[date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:29:29'])->count();
        $ttfpm = TeamTitansFullPowerModel::query()->whereBetween('created_at',[date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:29:29'])->count();
        $ttwpm = TeamTitansWithPowerModel::query()->whereBetween('created_at',[date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:29:29'])->count();

        $battlesToday = $thfim + $thfpm + $thwpm + $ttfim + $ttfpm + $ttwpm;
        $usersCounter = User::query()->where('active','=',1)->count();
        $guildsCounter = GuildModel::all()->count();
        return view('home')
            ->with('battlesToday',$battlesToday)
            ->with('usersCounter',$usersCounter)
            ->with('guildsCounter',$guildsCounter);
    }
}
