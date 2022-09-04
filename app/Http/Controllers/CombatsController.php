<?php

namespace App\Http\Controllers;

use App\Models\HeroModel;
use App\Models\PetModel;
use App\Models\PlayerHeroModel;
use App\Models\PlayerPetModel;
use App\Models\PlayerTitanModel;
use App\Models\TeamHeroesFullInformationModel;
use App\Models\TeamHeroesFullPowerModel;
use App\Models\TeamHeroesWithPowerModel;
use App\Models\TeamTitansFullInformationModel;
use App\Models\TeamTitansFullPowerModel;
use App\Models\TeamTitansWithPowerModel;
use App\Models\TitanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CombatsController extends Controller
{
    public function heroesCombats()
    {
        $heroes = HeroModel::all();
        $heroStars = HeroModel::getStars();
        $heroRanges = HeroModel::getRanges();
        $pets = PetModel::all();
        $petStars = PetModel::getStars();
        $petRanges = PetModel::getRanges();

        $successMsg = session('successMsg') ?? '';
        $errorMsg = session('errorMsg') ?? '';

        return view('combats.heroes')
            ->with('heroes', $heroes)
            ->with('heroStars', $heroStars)
            ->with('heroRanges', $heroRanges)
            ->with('pets', $pets)
            ->with('petStars', $petStars)
            ->with('petRanges', $petRanges)
            ->with('successMsg', $successMsg)
            ->with('errorMsg', $errorMsg);
    }

    public function storeHeroesCombatFullPower ( Request $request )
    {
        $winner = strtoupper($request->input('addCombatModalWinner'));
        $looser = $winner === 'A' ? 'B' : 'A';

        $dataTeamWinner = [];

        $this->addValueToArray($dataTeamWinner, 'winner_a_hero_id', $request->input('addCombatModalAHeroIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_hero_id', $request->input('addCombatModalBHeroIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_hero_id', $request->input('addCombatModalCHeroIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_hero_id', $request->input('addCombatModalDHeroIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_hero_id', $request->input('addCombatModalEHeroIdTeam' . $winner));

        if ( count($dataTeamWinner) === 0 )
        {
            $request->session()->flash('errorMsg', __('combat.error_empty_hero_team'));
            return redirect()->route('combats.heroes');
        }

        $dataTeamLooser = [];

        $this->addValueToArray($dataTeamLooser, 'looser_a_hero_id', $request->input('addCombatModalAHeroIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_b_hero_id', $request->input('addCombatModalBHeroIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_hero_id', $request->input('addCombatModalCHeroIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_hero_id', $request->input('addCombatModalDHeroIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_e_hero_id', $request->input('addCombatModalEHeroIdTeam' . $looser));

        if ( count($dataTeamLooser) === 0 )
        {
            $request->session()->flash('errorMsg', __('combat.error_empty_hero_team'));
            return redirect()->route('combats.heroes');
        }

        $winnerPet = (int)$request->input('addCombatModalPetIdTeam' . $winner);
        $looserPet = (int)$request->input('addCombatModalPetIdTeam' . $looser);

        if ( $winnerPet ) $dataTeamWinner['winner_pet_id'] = $winnerPet;
        if ( $looserPet ) $dataTeamLooser['looser_pet_id'] = $looserPet;

        try
        {
            TeamHeroesFullPowerModel::create(array_merge($dataTeamWinner, $dataTeamLooser, ['created_at'=>date('Y-m-d')]));
            $request->session()->flash('successMsg', __('combat.success_insert_database'));
        }
        catch ( \Exception $e )
        {
            $request->session()->flash('errorMsg', __('general.error_insert_database'));
        }

        return redirect()->route('combats.heroes');
    }

    public function storeHeroesCombatWithPower ( Request $request )
    {
        $winner = strtoupper($request->input('addCombatWithPowerModalWinner'));
        $looser = $winner === 'A' ? 'B' : 'A';

        $dataTeamWinner = [];

        $this->addValueToArray($dataTeamWinner, 'winner_a_hero_id', $request->input('addCombatWithPowerModalAHeroIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_hero_id', $request->input('addCombatWithPowerModalBHeroIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_hero_id', $request->input('addCombatWithPowerModalCHeroIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_hero_id', $request->input('addCombatWithPowerModalDHeroIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_hero_id', $request->input('addCombatWithPowerModalEHeroIdTeam' . $winner));

        if ( count($dataTeamWinner) === 0 )
        {
            $request->session()->flash('errorMsg', __('combat.error_empty_hero_team'));
            return redirect()->route('combats.heroes');
        }

        $this->addValueToArray($dataTeamWinner, 'winner_a_hero_power', $request->input('addCombatWithPowerModalAHeroPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_hero_power', $request->input('addCombatWithPowerModalBHeroPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_hero_power', $request->input('addCombatWithPowerModalCHeroPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_hero_power', $request->input('addCombatWithPowerModalDHeroPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_hero_power', $request->input('addCombatWithPowerModalEHeroPowerTeam' . $winner));

        $dataTeamLooser = [];

        $this->addValueToArray($dataTeamLooser, 'looser_a_hero_id', $request->input('addCombatWithPowerModalAHeroIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_b_hero_id', $request->input('addCombatWithPowerModalBHeroIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_hero_id', $request->input('addCombatWithPowerModalCHeroIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_hero_id', $request->input('addCombatWithPowerModalDHeroIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_e_hero_id', $request->input('addCombatWithPowerModalEHeroIdTeam' . $looser));

        if ( count($dataTeamLooser) === 0 )
        {
            $request->session()->flash('errorMsg', __('combat.error_empty_hero_team'));
            return redirect()->route('combats.heroes');
        }

        $this->addValueToArray($dataTeamLooser, 'looser_a_hero_power', $request->input('addCombatWithPowerModalAHeroPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_b_hero_power', $request->input('addCombatWithPowerModalBHeroPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_hero_power', $request->input('addCombatWithPowerModalCHeroPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_hero_power', $request->input('addCombatWithPowerModalDHeroPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_e_hero_power', $request->input('addCombatWithPowerModalEHeroPowerTeam' . $looser));

        $winnerPet = (int)$request->input('addCombatWithPowerModalPetIdTeam' . $winner);
        $looserPet = (int)$request->input('addCombatWithPowerModalPetIdTeam' . $looser);

        if ( $winnerPet )
        {
            $dataTeamWinner['winner_pet_id'] = $winnerPet;
            $dataTeamWinner['winner_pet_power'] = (int)$request->input('addCombatWithPowerModalPetPowerTeam' . $winner);
        }

        if ( $looserPet )
        {
            $dataTeamLooser['looser_pet_id'] = $looserPet;
            $dataTeamLooser['looser_pet_power'] = (int)$request->input('addCombatWithPowerModalPetPowerTeam' . $looser);
        }

        try
        {
            TeamHeroesWithPowerModel::create(array_merge($dataTeamWinner, $dataTeamLooser, ['created_at'=>date('Y-m-d')]));
            $request->session()->flash('successMsg', __('combat.success_insert_database'));
        }
        catch ( \Exception $e )
        {
            $request->session()->flash('errorMsg', __('general.error_insert_database'));
        }

        return redirect()->route('combats.heroes');
    }

    public function storeHeroesCombatFullInformation ( Request $request )
    {
        $winner = strtoupper($request->input('addCombatFullInformationModalWinner'));
        $looser = $winner === 'A' ? 'B' : 'A';

        $dataTeamWinner = [];

        $this->addValueToArray($dataTeamWinner, 'winner_a_hero_id', $request->input('addCombatFullInformationModalAHeroIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_hero_id', $request->input('addCombatFullInformationModalBHeroIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_hero_id', $request->input('addCombatFullInformationModalCHeroIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_hero_id', $request->input('addCombatFullInformationModalDHeroIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_hero_id', $request->input('addCombatFullInformationModalEHeroIdTeam' . $winner));

        if ( count($dataTeamWinner) === 0 )
        {
            $request->session()->flash('errorMsg', __('combat.error_empty_hero_team'));
            return redirect()->route('combats.heroes');
        }

        $this->addValueToArray($dataTeamWinner, 'winner_a_hero_power', $request->input('addCombatFullInformationModalAHeroPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_a_hero_stars', $request->input('addCombatFullInformationModalAHeroStarTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_a_hero_range', $request->input('addCombatFullInformationModalAHeroRangeTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_a_hero_pet', $request->input('addCombatFullInformationModalAHeroPetTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_hero_power', $request->input('addCombatFullInformationModalBHeroPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_hero_stars', $request->input('addCombatFullInformationModalBHeroStarTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_hero_range', $request->input('addCombatFullInformationModalBHeroRangeTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_hero_pet', $request->input('addCombatFullInformationModalBHeroPetTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_hero_power', $request->input('addCombatFullInformationModalCHeroPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_hero_stars', $request->input('addCombatFullInformationModalCHeroStarTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_hero_range', $request->input('addCombatFullInformationModalCHeroRangeTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_hero_pet', $request->input('addCombatFullInformationModalCHeroPetTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_hero_power', $request->input('addCombatFullInformationModalDHeroPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_hero_stars', $request->input('addCombatFullInformationModalDHeroStarTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_hero_range', $request->input('addCombatFullInformationModalDHeroRangeTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_hero_pet', $request->input('addCombatFullInformationModalDHeroPetTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_hero_power', $request->input('addCombatFullInformationModalEHeroPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_hero_stars', $request->input('addCombatFullInformationModalEHeroStarTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_hero_range', $request->input('addCombatFullInformationModalEHeroRangeTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_hero_pet', $request->input('addCombatFullInformationModalEHeroPetTeam' . $winner));

        $dataTeamLooser = [];

        $this->addValueToArray($dataTeamLooser, 'looser_a_hero_id', $request->input('addCombatFullInformationModalAHeroIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_b_hero_id', $request->input('addCombatFullInformationModalBHeroIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_hero_id', $request->input('addCombatFullInformationModalCHeroIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_hero_id', $request->input('addCombatFullInformationModalDHeroIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_e_hero_id', $request->input('addCombatFullInformationModalEHeroIdTeam' . $looser));

        if ( count($dataTeamLooser) === 0 )
        {
            $request->session()->flash('errorMsg', __('combat.error_empty_hero_team'));
            return redirect()->route('combats.heroes');
        }

        $this->addValueToArray($dataTeamLooser, 'looser_a_hero_power', $request->input('addCombatFullInformationModalAHeroPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_a_hero_stars', $request->input('addCombatFullInformationModalAHeroStarTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_a_hero_range', $request->input('addCombatFullInformationModalAHeroRangeTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_a_hero_pet', $request->input('addCombatFullInformationModalAHeroPetTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_b_hero_power', $request->input('addCombatFullInformationModalBHeroPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_b_hero_stars', $request->input('addCombatFullInformationModalBHeroStarTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_b_hero_range', $request->input('addCombatFullInformationModalBHeroRangeTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_hero_pet', $request->input('addCombatFullInformationModalBHeroPetTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_hero_power', $request->input('addCombatFullInformationModalCHeroPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_hero_stars', $request->input('addCombatFullInformationModalCHeroStarTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_hero_range', $request->input('addCombatFullInformationModalCHeroRangeTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_hero_pet', $request->input('addCombatFullInformationModalCHeroPetTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_hero_power', $request->input('addCombatFullInformationModalDHeroPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_hero_stars', $request->input('addCombatFullInformationModalDHeroStarTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_hero_range', $request->input('addCombatFullInformationModalDHeroRangeTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_hero_pet', $request->input('addCombatFullInformationModalDHeroPetTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_e_hero_power', $request->input('addCombatFullInformationModalEHeroPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_e_hero_stars', $request->input('addCombatFullInformationModalEHeroStarTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_e_hero_range', $request->input('addCombatFullInformationModalEHeroRangeTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_a_hero_pet', $request->input('addCombatFullInformationModalEHeroPetTeam' . $looser));

        $winnerPetId = (int)$request->input('addCombatFullInformationModalPetIdTeam' . $winner);

        if ( $winnerPetId )
        {
            $dataTeamWinner['winner_pet_id'] = $winnerPetId;
            $dataTeamWinner['winner_pet_power'] = (int)$request->input('addCombatFullInformationModalPetPowerTeam' . $winner);
            $dataTeamWinner['winner_pet_stars'] = (int)$request->input('addCombatFullInformationModalPetStarTeam' . $winner);
            $dataTeamWinner['winner_pet_range'] = (int)$request->input('addCombatFullInformationModalPetRangeTeam' . $winner);
        }

        $looserPetId = (int)$request->input('addCombatFullInformationModalPetIdTeam' . $looser);

        if ( $looserPetId )
        {
            $dataTeamLooser['looser_pet_id'] = $looserPetId;
            $dataTeamLooser['looser_pet_power'] = (int)$request->input('addCombatFullInformationModalPetPowerTeam' . $looser);
            $dataTeamLooser['looser_pet_stars'] = (int)$request->input('addCombatFullInformationModalPetStarTeam' . $looser);
            $dataTeamLooser['looser_pet_range'] = (int)$request->input('addCombatFullInformationModalPetRangeTeam' . $looser);
        }

        try
        {
            TeamHeroesFullInformationModel::create(array_merge($dataTeamWinner, $dataTeamLooser, ['created_at'=>date('Y-m-d')]));
            $request->session()->flash('successMsg', __('combat.success_insert_database'));
        }
        catch ( \Exception $e )
        {
            $request->session()->flash('errorMsg', __('general.error_insert_database'));
        }

        return redirect()->route('combats.heroes');
    }

    public function titansCombats()
    {
        $titans = TitanModel::all();
        $stars = TitanModel::getStars();

        $successMsg = session('successMsg') ?? '';
        $errorMsg = session('errorMsg') ?? '';

        return view('combats.titans')
            ->with('titans', $titans)
            ->with('stars', $stars)
            ->with('successMsg', $successMsg)
            ->with('errorMsg', $errorMsg);
    }

    public function storeTitansCombatFullPower ( Request $request )
    {
        $winner = strtoupper($request->input('addCombatModalWinner'));
        $looser = $winner === 'A' ? 'B' : 'A';

        $dataTeamWinner = [];

        $this->addValueToArray($dataTeamWinner, 'winner_a_titan_id', $request->input('addCombatModalATitanIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_titan_id', $request->input('addCombatModalBTitanIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_titan_id', $request->input('addCombatModalCTitanIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_titan_id', $request->input('addCombatModalDTitanIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_titan_id', $request->input('addCombatModalETitanIdTeam' . $winner));

        if ( count($dataTeamWinner) === 0 )
        {
            $request->session()->flash('errorMsg', __('combat.error_empty_titan_team'));
            return redirect()->route('combats.titans');
        }

        $dataTeamLooser = [];

        $this->addValueToArray($dataTeamLooser, 'looser_a_titan_id', $request->input('addCombatModalATitanIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_b_titan_id', $request->input('addCombatModalBTitanIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_titan_id', $request->input('addCombatModalCTitanIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_titan_id', $request->input('addCombatModalDTitanIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_e_titan_id', $request->input('addCombatModalETitanIdTeam' . $looser));

        if ( count($dataTeamLooser) === 0 )
        {
            $request->session()->flash('errorMsg', __('combat.error_empty_titan_team'));
            return redirect()->route('combats.titans');
        }

        try
        {

            TeamTitansFullPowerModel::create(array_merge($dataTeamWinner, $dataTeamLooser, ['created_at'=>date('Y-m-d')]));
            $request->session()->flash('successMsg', __('combat.success_insert_database'));
        }
        catch ( \Exception $e )
        {
            $request->session()->flash('errorMsg', __('general.error_insert_database'));
        }

        return redirect()->route('combats.titans');
    }

    public function storeTitansCombatWithPower ( Request $request )
    {
        $winner = strtoupper($request->input('addCombatWithPowerModalWinner'));
        $looser = $winner === 'A' ? 'B' : 'A';

        $dataTeamWinner = [];

        $this->addValueToArray($dataTeamWinner, 'winner_a_titan_id', $request->input('addCombatWithPowerModalATitanIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_titan_id', $request->input('addCombatWithPowerModalBTitanIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_titan_id', $request->input('addCombatWithPowerModalCTitanIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_titan_id', $request->input('addCombatWithPowerModalDTitanIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_titan_id', $request->input('addCombatWithPowerModalETitanIdTeam' . $winner));

        if ( count($dataTeamWinner) === 0 )
        {
            $request->session()->flash('errorMsg', __('combat.error_empty_titan_team'));
            return redirect()->route('combats.titans');
        }

        $this->addValueToArray($dataTeamWinner, 'winner_a_titan_power', $request->input('addCombatWithPowerModalATitanPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_titan_power', $request->input('addCombatWithPowerModalBTitanPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_titan_power', $request->input('addCombatWithPowerModalCTitanPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_titan_power', $request->input('addCombatWithPowerModalDTitanPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_titan_power', $request->input('addCombatWithPowerModalETitanPowerTeam' . $winner));

        $dataTeamLooser = [];

        $this->addValueToArray($dataTeamLooser, 'looser_a_titan_id', $request->input('addCombatWithPowerModalATitanIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_b_titan_id', $request->input('addCombatWithPowerModalBTitanIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_titan_id', $request->input('addCombatWithPowerModalCTitanIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_titan_id', $request->input('addCombatWithPowerModalDTitanIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_e_titan_id', $request->input('addCombatWithPowerModalETitanIdTeam' . $looser));

        if ( count($dataTeamLooser) === 0 )
        {
            $request->session()->flash('errorMsg', __('combat.error_empty_titan_team'));
            return redirect()->route('combats.titans');
        }

        $this->addValueToArray($dataTeamLooser, 'looser_a_titan_power', $request->input('addCombatWithPowerModalATitanPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_b_titan_power', $request->input('addCombatWithPowerModalBTitanPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_titan_power', $request->input('addCombatWithPowerModalCTitanPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_titan_power', $request->input('addCombatWithPowerModalDTitanPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_e_titan_power', $request->input('addCombatWithPowerModalETitanPowerTeam' . $looser));

        try
        {
            TeamTitansWithPowerModel::create(array_merge($dataTeamWinner, $dataTeamLooser, ['created_at'=>date('Y-m-d')]));
            $request->session()->flash('successMsg', __('combat.success_insert_database'));
        }
        catch ( \Exception $e )
        {
            $request->session()->flash('errorMsg', __('general.error_insert_database'));
        }

        return redirect()->route('combats.titans');
    }

    public function storeTitansCombatFullInformation ( Request $request )
    {
        $winner = strtoupper($request->input('addCombatFullInformationModalWinner'));
        $looser = $winner === 'A' ? 'B' : 'A';

        $dataTeamWinner = [];

        $this->addValueToArray($dataTeamWinner, 'winner_a_titan_id', $request->input('addCombatFullInformationModalATitanIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_titan_id', $request->input('addCombatFullInformationModalBTitanIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_titan_id', $request->input('addCombatFullInformationModalCTitanIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_titan_id', $request->input('addCombatFullInformationModalDTitanIdTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_titan_id', $request->input('addCombatFullInformationModalETitanIdTeam' . $winner));

        if ( count($dataTeamWinner) === 0 )
        {
            $request->session()->flash('errorMsg', __('combat.error_empty_titan_team'));
            return redirect()->route('combats.titans');
        }

        $this->addValueToArray($dataTeamWinner, 'winner_a_titan_power', $request->input('addCombatFullInformationModalATitanPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_a_titan_stars', $request->input('addCombatFullInformationModalATitanStarTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_titan_power', $request->input('addCombatFullInformationModalBTitanPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_b_titan_stars', $request->input('addCombatFullInformationModalBTitanStarTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_titan_power', $request->input('addCombatFullInformationModalCTitanPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_c_titan_stars', $request->input('addCombatFullInformationModalCTitanStarTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_titan_power', $request->input('addCombatFullInformationModalDTitanPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_d_titan_stars', $request->input('addCombatFullInformationModalDTitanStarTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_titan_power', $request->input('addCombatFullInformationModalETitanPowerTeam' . $winner));
        $this->addValueToArray($dataTeamWinner, 'winner_e_titan_stars', $request->input('addCombatFullInformationModalETitanStarTeam' . $winner));

        $dataTeamLooser = [];

        $this->addValueToArray($dataTeamLooser, 'looser_a_titan_id', $request->input('addCombatFullInformationModalATitanIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_b_titan_id', $request->input('addCombatFullInformationModalBTitanIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_titan_id', $request->input('addCombatFullInformationModalCTitanIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_titan_id', $request->input('addCombatFullInformationModalDTitanIdTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_e_titan_id', $request->input('addCombatFullInformationModalETitanIdTeam' . $looser));

        if ( count($dataTeamLooser) === 0 )
        {
            $request->session()->flash('errorMsg', __('combat.error_empty_titan_team'));
            return redirect()->route('combats.titans');
        }

        $this->addValueToArray($dataTeamLooser, 'looser_a_titan_power', $request->input('addCombatFullInformationModalATitanPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_a_titan_stars', $request->input('addCombatFullInformationModalATitanStarTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_b_titan_power', $request->input('addCombatFullInformationModalBTitanPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_b_titan_stars', $request->input('addCombatFullInformationModalBTitanStarTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_titan_power', $request->input('addCombatFullInformationModalCTitanPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_c_titan_stars', $request->input('addCombatFullInformationModalCTitanStarTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_titan_power', $request->input('addCombatFullInformationModalDTitanPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_d_titan_stars', $request->input('addCombatFullInformationModalDTitanStarTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_e_titan_power', $request->input('addCombatFullInformationModalETitanPowerTeam' . $looser));
        $this->addValueToArray($dataTeamLooser, 'looser_e_titan_stars', $request->input('addCombatFullInformationModalETitanStarTeam' . $looser));

        try
        {
            TeamTitansFullInformationModel::create(array_merge($dataTeamWinner, $dataTeamLooser, ['created_at'=>date('Y-m-d')]));
            $request->session()->flash('successMsg', __('combat.success_insert_database'));
        }
        catch ( \Exception $e )
        {
            $request->session()->flash('errorMsg', __('general.error_insert_database'));
        }

        return redirect()->route('combats.titans');
    }

    private function addValueToArray( & $array, $index, $value )
    {
        $value = intval($value);
        if ( $value )
            $array[$index] = $value;
    }
}
