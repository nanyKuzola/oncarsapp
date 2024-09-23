<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SimulationRequest;
use App\Models\Simulation;
use Illuminate\Support\Facades\DB;


class SimulationController extends Controller
{
    //

    public function store(SimulationRequest $request)
    {

        DB::beginTransaction();

        try{
            $simulationInfo = Simulation::checkFinance();
            $simulation = new Simulation();
            $simulation->nome      = $request->input('nome');
            $simulation->sobrenome = $request->input('sobrenome');
            $simulation->endereco  = $request->input('endereco');
            $simulation->cidade    = $request->input('cidade');
            $simulation->estado    = $request->input('estado');
            $simulation->cep       = $request->input('cep');
            $simulation->score     = $simulationInfo['score'];
            $simulation->status    = $simulationInfo['credito'];
            $simulation->car_id    = $request->input('car_id');
            $simulation->save();
            #store in db
            DB::commit();
            return response()->json(['status'=>'simulation created','data'=>$simulation], 201);

        }catch (Exception $exception){
            # undo the commit
            DB::rollBack();
            return response()->json(['status'=> false, 'message'=>'something went wrong'.$exception->getMessage()],400);
        }

    }



}
