<?php

namespace App\Http\Controllers;


use App\Models\Simulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SimulationController extends Controller
{
    //

    /**
     * Get information of credit car
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|null
     */
    public function finance(Request $request){

        $simulationInfo    = Simulation::checkFinance();

        $simuluation = new Simulation();
        try {
            #begin transaction
            DB::beginTransaction();
            $simuluation->nome      = $request->input('nome');
            $simuluation->sobrenome = $request->input('sobrenome');
            $simuluation->endereco  = $request->input('endereco');
            $simuluation->cidade    = $request->input('cidade');
            $simuluation->cep       = $request->input('cep');
            $simuluation->estado    = $request->input('estado');
            $simuluation->car_id    = $request->input('car_id');
            $simuluation->score     = $simulationInfo['score'];
            $simuluation->status    = $simulationInfo['credito'];

            $simuluation->save();
            DB::commit();
            return redirect('/getCars')->with('status', $request->input('nome')." Com base o teu  score de ".$simulationInfo['score'].' o seu credito será '.$simulationInfo['credito']);

        }catch (\Exception $e){
            DB::rollBack();
            return redirect('/getCars')->with('error', 'Erro ao registrar uma nova simulação de financiamento para  o Car '.$e->getMessage());
        }
    }
}
