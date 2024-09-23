<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\SimulationController;



Route::get('/',[CarController::class,'getCars']);
Route::post('newCar',[CarController::class,'newCar'])->name('newCar');
Route::post('/finance',[SimulationController::class,'finance'])->name('finance');
Route::get('/getCars',[CarController::class,'getCars']);
#Route::get('/getCar/{id}',[CarController::class,'getCar']);
Route::delete('/deleteCar',[CarController::class,'deleteCar'])->name('deleteCar');
Route::put('/updateCar/{Car}',[CarController::class,'updateCar'])->name('updateCar');
