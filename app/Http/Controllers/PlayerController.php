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
            ->select('ph.hero_id as id', 'ph.level', 'h.name', 'ph.power', 'ph.stars', 'ph.range_color')
            ->get();

        $pets = DB::table(app(PetModel::class)->getTable() . " AS p")
            ->join(app(PlayerPetModel::class)->getTable() . " AS pp", 'pp.pet_id', '=', 'p.id')
            ->where('pp.player_id', '=', $player->id)
            ->select('pp.pet_id as id', 'pp.level', 'p.name', 'pp.power', 'pp.stars', 'pp.range_color')
            ->get();

        $titans = DB::table(app(TitanModel::class)->getTable() . " AS t")
            ->join(app(PlayerTitanModel::class)->getTable() . " AS pt", 'pt.titan_id', '=', 't.id')
            ->where('pt.player_id', '=', $player->id)
            ->select('pt.titan_id as id', 'pt.level', 't.name', 't.element', 'pt.power', 'pt.stars')
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

        $heroStars = HeroModel::getStars();
        $heroRanges = HeroModel::getRanges();
        $petStars = PetModel::getStars();
        $petRanges = PetModel::getRanges();
        $titanStars = TitanModel::getStars();

        return view('player.show')
            ->with('player', $player)
            ->with('guild', $guild)
            ->with('heroes', $heroes)
            ->with('pets', $pets)
            ->with('titans', $titans)
            ->with('missingHeroes', $missingHeroes)
            ->with('missingTitans', $missingTitans)
            ->with('missingPets', $missingPets)
            ->with('heroStars', $heroStars)
            ->with('heroRanges', $heroRanges)
            ->with('petStars', $petStars)
            ->with('petRanges', $petRanges)
            ->with('titanStars', $titanStars);
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
        PlayerHeroModel::create([
            'player_id' => $playerId,
            'hero_id' => intval($request->input('addHeroId')),
            'level' => intval($request->input('newHeroLevel')),
            'power' => intval($request->input('newHeroPower')),
            'stars' => intval($request->input('newHeroStars')),
            'range_color' => intval($request->input('newHeroRange')),
        ]);

        return back();
    }

    public function addTitan ( Request $request, int $playerId)
    {
        PlayerTitanModel::create([
            'player_id' => $playerId,
            'titan_id' => intval($request->input('addTitanId')),
            'level' => intval($request->input('newTitanLevel')),
            'power' => intval($request->input('newTitanPower')),
            'stars' => intval($request->input('newTitanPower')),
        ]);

        return back();
    }

    public function addPet ( Request $request, int $playerId)
    {
        PlayerPetModel::create([
            'player_id' => $playerId,
            'pet_id' => intval($request->input('addPetId')),
            'level' => intval($request->input('newPetLevel')),
            'power' => intval($request->input('newPetPower')),
            'stars' => intval($request->input('newPetStars')),
            'range_color' => intval($request->input('newPetRange')),
        ]);

        return back();
    }

    public function updateHero ( Request $request, int $playerId)
    {
        $heroId = intval($request->input('editHeroId'));

        PlayerHeroModel::where('player_id', '=', $playerId)
            ->where('hero_id', '=', $heroId)
            ->update([
                'level' => intval($request->input('editHeroLevel')),
                'power' => intval($request->input('editHeroPower')),
                'stars' => intval($request->input('editHeroStars')),
                'range_color' => intval($request->input('editHeroRange')),
            ]);

        return back();
    }

    public function updateTitan ( Request $request, int $playerId)
    {
        $titanId = intval($request->input('editTitanId'));

        PlayerTitanModel::where('player_id', '=', $playerId)
            ->where('titan_id', '=', $titanId)
            ->update([
                'level' => intval($request->input('editTitanLevel')),
                'power' => intval($request->input('editTitanPower')),
                'stars' => intval($request->input('editTitanStars')),
            ]);

        return back();
    }

    public function updatePet ( Request $request, int $playerId)
    {
        $petId = intval($request->input('editPetId'));

        PlayerPetModel::where('player_id', '=', $playerId)
            ->where('pet_id', '=', $petId)
            ->update([
                'level' => intval($request->input('editPetLevel')),
                'power' => intval($request->input('editPetPower')),
                'stars' => intval($request->input('editPetStars')),
                'range_color' => intval($request->input('editPetRange')),
            ]);

        return back();
    }
}
