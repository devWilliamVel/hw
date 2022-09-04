<?php

namespace App\Http\Controllers;

use App\Models\PetModel;
use App\Models\PlayerPetModel;
use App\Models\TeamHeroesFullInformationModel;
use App\Models\TeamHeroesFullPowerModel;
use App\Models\TeamHeroesWithPowerModel;
use App\Models\WarDefensePetModel;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index ()
    {
        $pets = PetModel::all();

        foreach ($pets as $pet)
        {
            $pet->vsa = $pet->getPetsVSA();
            $pet->sa = $pet->getPetsSA();
            $pet->vwa = $pet->getPetsVWA();
            $pet->wa = $pet->getPetsWA();
        }

        return view('pets.list')->with('pets', $pets);
    }

    public function create ()
    {
        $pets = PetModel::all();

        return view('pets.create')->with('pets', $pets);
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
                $pet = new PetModel();
                $pet->name = $name;
                $pet->very_strong_against = implode(' ', $vsa);
                $pet->strong_against = implode(' ', $sa);
                $pet->very_weak_against = implode(' ', $vwa);
                $pet->weak_against = implode(' ', $wa);
                $pet->save();

                foreach ($vsa as $petId)
                {
                    $petAux = PetModel::find($petId);
                    $petAux->very_weak_against = empty($petAux->very_weak_against) ? $pet->id : ($petAux->very_weak_against . ' ' . $pet->id);
                    $petAux->save();
                }

                foreach ($sa as $petId)
                {
                    $petAux = PetModel::find($petId);
                    $petAux->weak_against = empty($petAux->weak_against) ? $pet->id : ($petAux->weak_against . ' ' . $pet->id);
                    $petAux->save();
                }

                foreach ($vwa as $petId)
                {
                    $petAux = PetModel::find($petId);
                    $petAux->very_strong_against = empty($petAux->very_strong_against) ? $pet->id : ($petAux->very_strong_against . ' ' . $pet->id);
                    $petAux->save();
                }

                foreach ($wa as $petId)
                {
                    $petAux = PetModel::find($petId);
                    $petAux->strong_against = empty($petAux->strong_against) ? $pet->id : ($petAux->strong_against . ' ' . $pet->id);
                    $petAux->save();
                }

                $res['id'] = $pet->id;
                $res['err'] = false;
                $res['msg'] = ucfirst(__('pet.pet_created'));
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
        $pets = PetModel::where('id', '!=', $id)->get();

        $pet = PetModel::where('id', '=', $id)->firstOrFail();

        $pet->vsa = $pet->getPetsVSA();
        $pet->sa = $pet->getPetsSA();
        $pet->vwa = $pet->getPetsVWA();
        $pet->wa = $pet->getPetsWA();

        return view('pets.edit')
            ->with('pets', $pets)
            ->with('pet', $pet);
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
                $pet = PetModel::find($id);

                $pet->removeVSPet();

                $pet->name = $name;
                $pet->very_strong_against = implode(' ', $vsa);
                $pet->strong_against = implode(' ', $sa);
                $pet->very_weak_against = implode(' ', $vwa);
                $pet->weak_against = implode(' ', $wa);
                $pet->save();

                foreach ($vsa as $petId)
                    $pet->addVSPet($petId, 'very_weak_against');

                foreach ($sa as $petId)
                    $pet->addVSPet($petId, 'weak_against');

                foreach ($vwa as $petId)
                    $pet->addVSPet($petId, 'very_strong_against');

                foreach ($wa as $petId)
                    $pet->addVSPet($petId, 'strong_against');

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
        $pet = PetModel::find($id);

        if ( $pet->id )
        {
            $pet->removeVSPet();
            PlayerPetModel::where('pet_id', '=', $pet->id)->delete();
            WarDefensePetModel::where('player_pet_id', '=', $pet->id)->delete();
            TeamHeroesFullPowerModel::where('winner_pet_id', '=', $pet->id)
                ->orWhere('looser_pet_id', '=', $pet->id)
                ->delete();
            TeamHeroesWithPowerModel::where('winner_pet_id', '=', $pet->id)
                ->orWhere('looser_pet_id', '=', $pet->id)
                ->delete();
            TeamHeroesFullInformationModel::where('winner_a_hero_pet', '=', $pet->id)
                ->orWhere('winner_b_hero_pet', '=', $pet->id)
                ->orWhere('winner_c_hero_pet', '=', $pet->id)
                ->orWhere('winner_d_hero_pet', '=', $pet->id)
                ->orWhere('winner_e_hero_pet', '=', $pet->id)
                ->orWhere('winner_pet_id', '=', $pet->id)
                ->orWhere('looser_a_hero_pet', '=', $pet->id)
                ->orWhere('looser_b_hero_pet', '=', $pet->id)
                ->orWhere('looser_c_hero_pet', '=', $pet->id)
                ->orWhere('looser_d_hero_pet', '=', $pet->id)
                ->orWhere('looser_e_hero_pet', '=', $pet->id)
                ->orWhere('looser_pet_id', '=', $pet->id)
                ->delete();
            $pet->delete();
        }

        return redirect()->route('pets');
    }
}
