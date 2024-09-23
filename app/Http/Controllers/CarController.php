<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CarController extends Controller
{


    /**
     * method to create a brand new car
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application |
     *  @since 1.0 release of branch/onCar-02
     * @autor nany huna
     */
    public function newCar(Request $request)
    {
        try{
            $car = new Car();
            # start db transaction
            DB::beginTransaction();
            $car->marca  = $request->input('marca');;
            $car->modelo = $request->input('modelo');
            $car->cor    = $request->input('cor');
            $car->save();
            DB::commit();
            return redirect('/getCars')->with('status','novo carro foi registado com sucesso!');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()>with('error','algo deu errado '.$e->getMessage());

        }

    }

    /**
     * Update an existing car
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @since elease feature/OnCarApp-02
     */
    public function updateCar(Request $request, int $id)
    {
        try {
            $car = Car::find($id);
            if(!$car){
                return redirect('/getCars')->with('warning','Car não encontrado!');
            }
            DB::beginTransaction();
            $car->marca  = !$request->input('marca') ? $car->marca  : $request->input('marca');
            $car->modelo = !$request->input('modelo')? $car->modelo : $request->input('modelo');
            $car->cor    = !$request->input('cor')   ? $car->cor    : $request->input('cor');
            $car->save();
            DB::commit();
            return redirect('/getCars')->with('status','Car editado com sucesso!');
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()>with('error','algo deu errado '.$e->getMessage());
        }

    }

    /**
     *
     * it's method return all cars we have
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse
     * @author nany huna
     * @since 1.0 release of branch feature/0nCar-02
     */
    public function getCars()
    {
        try{
            $cars = Car::all();
            $status   = '';
            return view('cars', compact('cars','status'));
        }catch (\Exception $e){
            return redirect()->back()>with('error','algo deu errado '.$e->getMessage());
        }
    }

    /**
     *
     *  Method to delete a car
     *
     * @param Request $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *@since 1.0 release of branch feature/onCar-02
     * /
     */
    public function deleteCar(Request $request)
    {
        try{
            $car =  Car::find($request->input('id'));
            if(!$car){
                return redirect('/getCars')->with('warning','Car '.$request->input('id').' inexistente na lista!');
            }
            $car->delete();
            return redirect('/getCars')->with('status','Car deletado com sucesso!');
        }catch (\Exception $e){
            return redirect('/getCars')->with('error', 'Erro ao elimnar o Car '.$e->getMessage());
        }

    }



}
