<?php

namespace App\Http\Controllers;

use App\Models\HeroModel;
use App\Models\PlayerHeroModel;
use App\Models\TeamHeroesFullInformationModel;
use App\Models\TeamHeroesFullPowerModel;
use App\Models\TeamHeroesWithPowerModel;
use App\Models\WarDefenseHeroModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeroController extends Controller
{
    public function index ()
    {
        $heroes = HeroModel::all();

        foreach ($heroes as $hero)
        {
            $hero->vsa = $hero->getHeroesVSA();
            $hero->sa = $hero->getHeroesSA();
            $hero->vwa = $hero->getHeroesVWA();
            $hero->wa = $hero->getHeroesWA();
        }

        return view('heroes.list')->with('heroes', $heroes);
    }

    public function create ()
    {
        $heroes = HeroModel::all();

        return view('heroes.create')->with('heroes', $heroes);
    }

    public function store (Request $request)
    {
        $res = ['err'=>true, 'msg'=>'', 'id'=>0];
        $statusCode = 200;
        $name = trim($request->input('name'));
        $vsa = (array) $request->input('vsa');
        $sa = (array) $request->input('sa');
        $vwa = (array) $request->input('vwa');
        $wa = (array) $request->input('wa');

        if ( strlen($name) < 2 )
        {
            $res['msg'] = ucfirst(__('general.name_min_length_two'));
        }
        else
        {
            try
            {
                $hero = new HeroModel;
                $hero->name = $name;
                $hero->very_strong_against = implode(' ', $vsa);
                $hero->strong_against = implode(' ', $sa);
                $hero->very_weak_against = implode(' ', $vwa);
                $hero->weak_against = implode(' ', $wa);
                $hero->save();

                foreach ($vsa as $heroId)
                {
                    $heroAux = HeroModel::find($heroId);
                    $heroAux->very_weak_against = empty($heroAux->very_weak_against) ? $hero->id : ($heroAux->very_weak_against . ' ' . $hero->id);
                    $heroAux->save();
                }

                foreach ($sa as $heroId)
                {
                    $heroAux = HeroModel::find($heroId);
                    $heroAux->weak_against = empty($heroAux->weak_against) ? $hero->id : ($heroAux->weak_against . ' ' . $hero->id);
                    $heroAux->save();
                }

                foreach ($vwa as $heroId)
                {
                    $heroAux = HeroModel::find($heroId);
                    $heroAux->very_strong_against = empty($heroAux->very_strong_against) ? $hero->id : ($heroAux->very_strong_against . ' ' . $hero->id);
                    $heroAux->save();
                }

                foreach ($wa as $heroId)
                {
                    $heroAux = HeroModel::find($heroId);
                    $heroAux->strong_against = empty($heroAux->strong_against) ? $hero->id : ($heroAux->strong_against . ' ' . $hero->id);
                    $heroAux->save();
                }

                $res['id'] = $hero->id;
                $res['err'] = false;
                $res['msg'] = ucfirst(__('hero.hero_created'));
            }
            catch ( \Exception $e )
            {
                $res['msg'] = ucfirst(__('general.server_error_on_insert'));
                $statusCode = 500;
            }
        }

        return response()->json($res, $statusCode);
    }

    public function edit (int $id)
    {
        $heroes = HeroModel::where('id', '!=', $id)->get();

        $hero = HeroModel::where('id', '=', $id)->firstOrFail();

        $hero->vsa = $hero->getHeroesVSA();
        $hero->sa = $hero->getHeroesSA();
        $hero->vwa = $hero->getHeroesVWA();
        $hero->wa = $hero->getHeroesWA();

        return view('heroes.edit')
            ->with('heroes', $heroes)
            ->with('hero', $hero);
    }

    public function update ( Request $request, int $id )
    {
        $res = ['err'=>true, 'msg'=>''];
        $statusCode = 200;
        $name = trim($request->input('name'));
        $vsa = (array) $request->input('vsa');
        $sa = (array) $request->input('sa');
        $vwa = (array) $request->input('vwa');
        $wa = (array) $request->input('wa');

        if ( strlen($name) < 2 )
        {
            $res['msg'] = ucfirst(__('general.name_min_length_two'));
        }
        else
        {
            try
            {
                $hero = HeroModel::find($id);

                $hero->removeVSHero();

                $hero->name = $name;
                $hero->very_strong_against = implode(' ', $vsa);
                $hero->strong_against = implode(' ', $sa);
                $hero->very_weak_against = implode(' ', $vwa);
                $hero->weak_against = implode(' ', $wa);
                $hero->save();

                foreach ($vsa as $heroId)
                    $hero->addVSHero($heroId, 'very_weak_against');

                foreach ($sa as $heroId)
                    $hero->addVSHero($heroId, 'weak_against');

                foreach ($vwa as $heroId)
                    $hero->addVSHero($heroId, 'very_strong_against');

                foreach ($wa as $heroId)
                    $hero->addVSHero($heroId, 'strong_against');

                $res['err'] = false;
            }
            catch ( \Exception $e )
            {
                $res['msg'] = ucfirst(__('general.server_error_on_update'));
                $statusCode = 500;
            }
        }

        return response()->json($res, $statusCode);
    }

    public function delete (int $id)
    {
        $hero = HeroModel::find($id);

        if ( $hero->id )
        {
            $hero->removeVSHero();
            PlayerHeroModel::where('hero_id', '=', $hero->id)->delete();
            WarDefenseHeroModel::where('player_hero_id', '=', $hero->id)->delete();
            TeamHeroesFullPowerModel::where('winner_a_hero_id', '=', $hero->id)
                ->orWhere('winner_b_hero_id', '=', $hero->id)
                ->orWhere('winner_c_hero_id', '=', $hero->id)
                ->orWhere('winner_d_hero_id', '=', $hero->id)
                ->orWhere('winner_e_hero_id', '=', $hero->id)
                ->orWhere('looser_a_hero_id', '=', $hero->id)
                ->orWhere('looser_b_hero_id', '=', $hero->id)
                ->orWhere('looser_c_hero_id', '=', $hero->id)
                ->orWhere('looser_d_hero_id', '=', $hero->id)
                ->orWhere('looser_e_hero_id', '=', $hero->id)
                ->delete();
            TeamHeroesWithPowerModel::where('winner_a_hero_id', '=', $hero->id)
                ->orWhere('winner_b_hero_id', '=', $hero->id)
                ->orWhere('winner_c_hero_id', '=', $hero->id)
                ->orWhere('winner_d_hero_id', '=', $hero->id)
                ->orWhere('winner_e_hero_id', '=', $hero->id)
                ->orWhere('looser_a_hero_id', '=', $hero->id)
                ->orWhere('looser_b_hero_id', '=', $hero->id)
                ->orWhere('looser_c_hero_id', '=', $hero->id)
                ->orWhere('looser_d_hero_id', '=', $hero->id)
                ->orWhere('looser_e_hero_id', '=', $hero->id)
                ->delete();
            TeamHeroesFullInformationModel::where('winner_a_hero_id', '=', $hero->id)
                ->orWhere('winner_b_hero_id', '=', $hero->id)
                ->orWhere('winner_c_hero_id', '=', $hero->id)
                ->orWhere('winner_d_hero_id', '=', $hero->id)
                ->orWhere('winner_e_hero_id', '=', $hero->id)
                ->orWhere('looser_a_hero_id', '=', $hero->id)
                ->orWhere('looser_b_hero_id', '=', $hero->id)
                ->orWhere('looser_c_hero_id', '=', $hero->id)
                ->orWhere('looser_d_hero_id', '=', $hero->id)
                ->orWhere('looser_e_hero_id', '=', $hero->id)
                ->delete();
            $hero->delete();
        }

        return redirect()->route('heroes');
    }
}
