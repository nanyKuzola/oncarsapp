<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{


    /**
     * method to create a brand new car
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application |
     *  @since 1.0 release of branch/onCar-01
     * @autor nany huna
     * @since elease feature/OnCarApp-02
     */
    public function newCar(Request $request)
    {
        try{
            $car = new Car();
            $car->marca  = $request->input('marca');;
            $car->modelo = $request->input('modelo');
            $car->cor    = $request->input('cor');
            $car->save();
            return redirect('/getCars')->with('status','novo carro foi registado com sucesso!');
        }catch (\Exception $e){
            return redirect()->back();

        }

    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @since elease feature/OnCarApp-02
     */
    public function updateCar(Request $request, int $id)
    {

        $car = Car::find($id);
        if(!$car){
            return redirect('/getCars')->with('warning','Car não encontrado!');
        }
        $car->marca  = !$request->input('marca') ? $car->marca  : $request->input('marca');
        $car->modelo = !$request->input('modelo')? $car->modelo : $request->input('modelo');
        $car->cor    = !$request->input('cor')   ? $car->cor    : $request->input('cor');
        $car->save();
        return redirect('/getCars')->with('status','Car editado com sucesso!');

    }

    /**
     *
     *   it's method return all cars we have
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
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     *
     * It's method get a single Car
     *
     * @since 1.0 release of branch feature/onCar-02
     * @author Nany Huna
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCar(int $id){
        $car = New Car();
        try {
            return response()->json($car->find($id));
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }

    }


    /**
     * Method to delete a car
     *
     *  @param int $idCar
     * @return \Illuminate\Http\RedirectResponse|
     *@since 1.0 release of branch feature/onCar-02
     */
    public function deleteCar(Request $request)
    {
        $car =  Car::find($request->input('id'));
        try{
            if(!$car){
                return redirect('/getCars')->with('warning','Car '.$request->input('id').' inexistente na lista!');
            }
            $car->delete();
            return redirect('/getCars')->with('status','Car deletado com sucesso!');
        }catch (\Exception $e){
            return redirect('/getCars')->with('error', 'Erro ao elimnar o Car '.$e->getMessage());
        }

    }

    /**
     * Get information of credit car
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|null
     */
    public function finance(Request $request){
        $simulacao    = Car::checkFinance();
        return redirect('/getCars')->with('status', $request->input('cliNome')." Com base o teu  score de ".$simulacao['score'].' o seu credito será '.$simulacao['credito']);
    }


}
