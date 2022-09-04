<?php

namespace App\Http\Controllers;

use App\Models\PlayerTitanModel;
use App\Models\TitanModel;
use App\Models\TeamTitansFullPowerModel;
use App\Models\TeamTitansWithPowerModel;
use App\Models\TeamTitansFullInformationModel;
use App\Models\WarDefenseTitanModel;
use Illuminate\Http\Request;

class TitanController extends Controller
{
    public function index ()
    {
        $titans = TitanModel::all();

        foreach ($titans as $titan)
        {
            $titan->vsa = $titan->getTitansVSA();
            $titan->sa = $titan->getTitansSA();
            $titan->vwa = $titan->getTitansVWA();
            $titan->wa = $titan->getTitansWA();
        }
//dd($titans);
        return view('titans.list')
            ->with('titans', $titans)
            ->with('elements', TitanModel::getElements());
    }

    public function create ()
    {
        $titans = TitanModel::all();

        return view('titans.create')
            ->with('titans', $titans)
            ->with('elements', TitanModel::getElements());
    }

    public function store (Request $request)
    {
        $res = ['err'=>true, 'msg'=>'', 'id'=>0];
        $statusCode = 200;
        $name = trim($request->input('name'));
        $element = intval($request->input('element'));
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
                $titan = new TitanModel();
                $titan->name = $name;
                $titan->element = $element;
                $titan->very_strong_against = implode(' ', $vsa);
                $titan->strong_against = implode(' ', $sa);
                $titan->very_weak_against = implode(' ', $vwa);
                $titan->weak_against = implode(' ', $wa);
                $titan->save();

                foreach ($vsa as $titanId)
                {
                    $titanAux = TitanModel::find($titanId);
                    $titanAux->very_weak_against = empty($titanAux->very_weak_against) ? $titan->id : ($titanAux->very_weak_against . ' ' . $titan->id);
                    $titanAux->save();
                }

                foreach ($sa as $titanId)
                {
                    $titanAux = TitanModel::find($titanId);
                    $titanAux->weak_against = empty($titanAux->weak_against) ? $titan->id : ($titanAux->weak_against . ' ' . $titan->id);
                    $titanAux->save();
                }

                foreach ($vwa as $titanId)
                {
                    $titanAux = TitanModel::find($titanId);
                    $titanAux->very_strong_against = empty($titanAux->very_strong_against) ? $titan->id : ($titanAux->very_strong_against . ' ' . $titan->id);
                    $titanAux->save();
                }

                foreach ($wa as $titanId)
                {
                    $titanAux = TitanModel::find($titanId);
                    $titanAux->strong_against = empty($titanAux->strong_against) ? $titan->id : ($titanAux->strong_against . ' ' . $titan->id);
                    $titanAux->save();
                }

                $res['id'] = $titan->id;
                $res['err'] = false;
                $res['msg'] = ucfirst(__('titan.titan_created'));
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
        $titans = TitanModel::where('id', '!=', $id)->get();

        $titan = TitanModel::where('id', '=', $id)->firstOrFail();

        $titan->vsa = $titan->getTitansVSA();
        $titan->sa = $titan->getTitansSA();
        $titan->vwa = $titan->getTitansVWA();
        $titan->wa = $titan->getTitansWA();

        return view('titans.edit')
            ->with('titans', $titans)
            ->with('titan', $titan)
            ->with('elements', TitanModel::getElements());
    }

    public function update ( Request $request, int $id )
    {
        $res = ['err'=>true, 'msg'=>''];
        $statusCode = 200;
        $name = trim($request->input('name'));
        $element = intval($request->input('element'));
        $vsa = (array) $request->input('vsa');
        $sa = (array) $request->input('sa');
        $vwa = (array) $request->input('vwa');
        $wa = (array) $request->input('wa');

        $elements = TitanModel::getElements();
        if ( ! isset($elements[$element]) )
            abort(404);

        if ( strlen($name) < 2 )
        {
            $res['msg'] = ucfirst(__('general.name_min_length_two'));
        }
        else
        {
            try
            {
                $titan = TitanModel::find($id);

                $titan->removeVSTitan();

                $titan->name = $name;
                $titan->element = $element;
                $titan->very_strong_against = implode(' ', $vsa);
                $titan->strong_against = implode(' ', $sa);
                $titan->very_weak_against = implode(' ', $vwa);
                $titan->weak_against = implode(' ', $wa);
                $titan->save();

                foreach ($vsa as $titanId)
                    $titan->addVSTitan($titanId, 'very_weak_against');

                foreach ($sa as $titanId)
                    $titan->addVSTitan($titanId, 'weak_against');

                foreach ($vwa as $titanId)
                    $titan->addVSTitan($titanId, 'very_strong_against');

                foreach ($wa as $titanId)
                    $titan->addVSTitan($titanId, 'strong_against');

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
        $titan = TitanModel::find($id);

        if ( $titan->id )
        {
            $titan->removeVSTitan();
            PlayerTitanModel::where('titan_id', '=', $titan->id)->delete();
            WarDefenseTitanModel::where('player_titan_id', '=', $titan->id)->delete();
            TeamTitansFullPowerModel::where('winner_a_titan_id', '=', $titan->id)
                ->orWhere('winner_b_titan_id', '=', $titan->id)
                ->orWhere('winner_c_titan_id', '=', $titan->id)
                ->orWhere('winner_d_titan_id', '=', $titan->id)
                ->orWhere('winner_e_titan_id', '=', $titan->id)
                ->orWhere('looser_a_titan_id', '=', $titan->id)
                ->orWhere('looser_b_titan_id', '=', $titan->id)
                ->orWhere('looser_c_titan_id', '=', $titan->id)
                ->orWhere('looser_d_titan_id', '=', $titan->id)
                ->orWhere('looser_e_titan_id', '=', $titan->id)
                ->delete();
            TeamTitansWithPowerModel::where('winner_a_titan_id', '=', $titan->id)
                ->orWhere('winner_b_titan_id', '=', $titan->id)
                ->orWhere('winner_c_titan_id', '=', $titan->id)
                ->orWhere('winner_d_titan_id', '=', $titan->id)
                ->orWhere('winner_e_titan_id', '=', $titan->id)
                ->orWhere('looser_a_titan_id', '=', $titan->id)
                ->orWhere('looser_b_titan_id', '=', $titan->id)
                ->orWhere('looser_c_titan_id', '=', $titan->id)
                ->orWhere('looser_d_titan_id', '=', $titan->id)
                ->orWhere('looser_e_titan_id', '=', $titan->id)
                ->delete();
            TeamTitansFullInformationModel::where('winner_a_titan_id', '=', $titan->id)
                ->orWhere('winner_b_titan_id', '=', $titan->id)
                ->orWhere('winner_c_titan_id', '=', $titan->id)
                ->orWhere('winner_d_titan_id', '=', $titan->id)
                ->orWhere('winner_e_titan_id', '=', $titan->id)
                ->orWhere('looser_a_titan_id', '=', $titan->id)
                ->orWhere('looser_b_titan_id', '=', $titan->id)
                ->orWhere('looser_c_titan_id', '=', $titan->id)
                ->orWhere('looser_d_titan_id', '=', $titan->id)
                ->orWhere('looser_e_titan_id', '=', $titan->id)
                ->delete();
            $titan->delete();
        }

        return redirect()->route('titans');
    }
}
