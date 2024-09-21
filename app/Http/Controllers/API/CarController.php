<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class CarController extends Controller
{
    /**
     * it's methods is set to list all cars
     * @since release feature/OnCarApp-01
     * @return JsonResponse
     */
    public function index():JsonResponse
    {
        //
        $cars = Car::all();
        return response()->json(['status'=>true,'data'=>$cars], 200);
    }

    /**
     *
     * Store a newly created resource in storage.
     * @since release feature/OnCarApp-01
     * @return JsonResponse
     */
    public function store(CarRequest $request):jsonResponse
    {   # starts store transaction
        DB::beginTransaction();

        try{
            $car = new Car();
            $car->modelo = $request->input('modelo');
            $car->marca  = $request->input('marca');
            $car->cor    = $request->input('cor');
            $car->save();
            #store in db
            DB::commit();
            return response()->json(['status'=>'car created','data'=>$car], 201);

        }catch (Exception $exception){
            # undo the commit
            DB::rollBack();
            return response()->json(['status'=> false, 'message'=>'something went wrong'],400);
        }
    }

    /**
     *
     * Display the specified resource.
     * @since release feature/OnCarApp-01
     * @return JsonResponse
     */
    public function show(Car $car):JsonResponse
    {
        //
        try{
            return response()->json(['status'=>'deleoping','data'=>$car], 200);
        }catch (Exception $exception){
            return response()->json(['status'=> false, 'message'=>'something went wrong'],400);
        }

    }

    /**
     * Update the specified resource in storage.
     * @since elease feature/OnCarApp-01
     * @return JsonResponse
     */
    public function update(CarRequest $request,Car $car):JsonResponse
    {

        # starts store transaction
       DB::beginTransaction();
        try{

            $car->update([
                'modelo' => $request->modelo,
                'marca'  => $request->marca,
                'cor'    => $request->cor
            ]);
            DB::commit();
            return response()->json(['status'=>true,'data'=>$car,'message'=>'car edited with sucess'], 200);
        }catch (Exception $exception){
            DB::rollBack();
            return response()->json(['status'=> false, 'message'=>'something went wrong'],400);
        }

    }

    /**
     * Remove the specified resource from storage.
     * @since elease feature/OnCarApp-01
     * @return JsonResponse
     */
    public function destroy(Car $car):JsonResponse
    {
        try{
            $car->delete();
            return response()->json(['status'=>true,'data'=>$car,'message'=>'car deleted  with sucess'], 200);

        }catch (Exception $exception){
            return response()->json(['status'=> false, 'message'=>'something went wrong'],400);
        }
    }
}
