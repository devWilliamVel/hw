<?php

namespace App\Http\Controllers;

use App\Models\GuildPlayerModel;
use App\Models\HeroModel;
use App\Models\PetModel;
use App\Models\PlayerHeroModel;
use App\Models\PlayerModel;
use App\Models\PlayerPetModel;
use App\Models\PlayerTitanModel;
use App\Models\TitanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    public function index ( Request $request )
    {
        $players = PlayerModel::all();
        $successMsg = session('successMsg') ?? '';
        $errorMsg = session('errorMsg') ?? '';

        return view('player.index')
            ->with('players', $players)
            ->with('successMsg', $successMsg)
            ->with('errorMsg', $errorMsg);
    }

    public function show ($id)
    {
        $player = PlayerModel::findOrFail($id);
        $guild = $player->guilds->first() ?? null;

        $heroes = DB::table(app(HeroModel::class)->getTable() . " AS h")
            ->join(app(PlayerHeroModel::class)->getTable() . " AS ph", 'ph.hero_id', '=', 'h.id')
            ->where('ph.player_id', '=', $player->id)
            ->select('ph.hero_id as id', 'ph.level', 'h.name', 'ph.power')
            ->get();

        $pets = DB::table(app(PetModel::class)->getTable() . " AS p")
            ->join(app(PlayerPetModel::class)->getTable() . " AS pp", 'pp.pet_id', '=', 'p.id')
            ->where('pp.player_id', '=', $player->id)
            ->select('pp.pet_id as id', 'pp.level', 'p.name', 'pp.power')
            ->get();

        $titans = DB::table(app(TitanModel::class)->getTable() . " AS t")
            ->join(app(PlayerTitanModel::class)->getTable() . " AS pt", 'pt.titan_id', '=', 't.id')
            ->where('pt.player_id', '=', $player->id)
            ->select('pt.titan_id as id', 'pt.level', 't.name', 't.element', 'pt.power')
            ->get();

        $missingHeroes = DB::table(app(HeroModel::class)->getTable())
            ->whereNotIn('id', $heroes->pluck('id')->toArray())
            ->orderBy('name', 'asc')
            ->select('id', 'name')
            ->get();

        $missingTitans = DB::table(app(TitanModel::class)->getTable())
            ->whereNotIn('id', $titans->pluck('id')->toArray())
            ->orderBy('name', 'asc')
            ->select('id', 'name')
            ->get();

        $missingPets = DB::table(app(PetModel::class)->getTable())
            ->whereNotIn('id', $pets->pluck('id')->toArray())
            ->orderBy('name', 'asc')
            ->select('id', 'name')
            ->get();

        return view('player.show')
            ->with('player', $player)
            ->with('guild', $guild)
            ->with('heroes', $heroes)
            ->with('pets', $pets)
            ->with('titans', $titans)
            ->with('missingHeroes', $missingHeroes)
            ->with('missingTitans', $missingTitans)
            ->with('missingPets', $missingPets);
    }

    public function store ( Request $request )
    {
        $name = trim($request->input('name'));

        if ( strlen($name) > 0 )
        {
            $counter = PlayerModel::where('name', '=', $name)->count();

            if ( ! $counter )
            {
                try
                {
                    PlayerModel::create([
                        'name' => $name,
                    ]);

                    $request->session()->flash('successMsg', __('messages.player_create'));
                }
                catch ( \Exception $e )
                {
                    $request->session()->flash('errorMsg', __('messages.error_on_saving'));
                }
            }
        }
        else
            $request->session()->flash('errorMsg', __('messages.error_empty_data'));

        return back();
    }

    public function update( Request $request )
    {
        $playerId = intval($request->input('playerId'));
        $name = trim($request->input('currentName'));

        if ( $playerId > 0 && strlen($name) > 0 )
        {
            try
            {
                PlayerModel::where('id', '=', $playerId)
                    ->update(['name'=>$name]);

                $request->session()->flash('successMsg', __('messages.success_update'));
            }
            catch ( \Exception $e )
            {
                $request->session()->flash('errorMsg', __('messages.error_on_saving'));
            }
        }
        else
            $request->session()->flash('errorMsg', __('messages.error_empty_data'));

        return back();
    }

    public function delete( Request $request, int $id )
    {
        $player = PlayerModel::findOrFail($id);

        try
        {
            GuildPlayerModel::where('player_id', '=', $player->id)->delete();
            PlayerHeroModel::where('player_id', '=', $player->id)->delete();
            $player->delete();

            //$request->session()->flash('successMsg', __('messages.success_update'));
        }
        catch ( \Exception $e )
        {
            $request->session()->flash('errorMsg', __('messages.server_error_on_delete'));
        }

        return back();
    }

    public function removeHero ( Request $request, int $playerId, int $heroId )
    {
        PlayerHeroModel::where('player_id', '=', $playerId)
            ->where('hero_id', '=', $heroId)
            ->delete();

        return back();
    }

    public function removeTitan ( Request $request, int $playerId, int $titanId )
    {
        PlayerTitanModel::where('player_id', '=', $playerId)
            ->where('titan_id', '=', $titanId)
            ->delete();

        return back();
    }

    public function removePet ( Request $request, int $playerId, int $petId )
    {
        PlayerPetModel::where('player_id', '=', $playerId)
            ->where('pet_id', '=', $petId)
            ->delete();

        return back();
    }

    public function addHero ( Request $request, int $playerId)
    {
        $heroId = intval($request->input('addHeroId'));
        $level = intval($request->input('newHeroLevel'));
        $power = intval($request->input('newHeroPower'));

        PlayerHeroModel::create([
            'player_id' => $playerId,
            'hero_id' => $heroId,
            'level' => $level,
            'power' => $power,
        ]);

        return back();
    }

    public function addTitan ( Request $request, int $playerId)
    {
        $titanId = intval($request->input('addTitanId'));
        $level = intval($request->input('newTitanLevel'));
        $power = intval($request->input('newTitanPower'));

        PlayerTitanModel::create([
            'player_id' => $playerId,
            'titan_id' => $titanId,
            'level' => $level,
            'power' => $power,
        ]);

        return back();
    }

    public function addPet ( Request $request, int $playerId)
    {
        $petId = intval($request->input('addPetId'));
        $level = intval($request->input('newPetLevel'));
        $power = intval($request->input('newPetPower'));

        PlayerPetModel::create([
            'player_id' => $playerId,
            'pet_id' => $petId,
            'level' => $level,
            'power' => $power,
        ]);

        return back();
    }

    public function updateHero ( Request $request, int $playerId)
    {
        $heroId = intval($request->input('editHeroId'));
        $level = intval($request->input('editHeroLevel'));
        $power = intval($request->input('editHeroPower'));

        PlayerHeroModel::where('player_id', '=', $playerId)
            ->where('hero_id', '=', $heroId)
            ->update([
                'level' => $level,
                'power' => $power,
            ]);

        return back();
    }

    public function updateTitan ( Request $request, int $playerId)
    {
        $titanId = intval($request->input('editTitanId'));
        $level = intval($request->input('editTitanLevel'));
        $power = intval($request->input('editTitanPower'));

        PlayerTitanModel::where('player_id', '=', $playerId)
            ->where('titan_id', '=', $titanId)
            ->update([
                'level' => $level,
                'power' => $power,
            ]);

        return back();
    }

    public function updatePet ( Request $request, int $playerId)
    {
        $petId = intval($request->input('editPetId'));
        $level = intval($request->input('editPetLevel'));
        $power = intval($request->input('editPetPower'));

        PlayerPetModel::where('player_id', '=', $playerId)
            ->where('pet_id', '=', $petId)
            ->update([
                'level' => $level,
                'power' => $power,
            ]);

        return back();
    }
}
