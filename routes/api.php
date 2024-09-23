<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\CarController as CarApi;
use \App\Http\Controllers\API\SimulationController as SimulationApi;




Route::get('/cars', [CarApi::class,'index']);
Route::post('/cars', [CarApi::class,'store']);            #store api endpoint
Route::get('/cars/{car}', [CarApi::class,'show']);        #show api endpoint
Route::put('/cars/{car}', [CarApi::class,'update']);      #update api endpoint
Route::delete('/cars/{car}', [CarApi::class,'destroy']);  #delete api endpoint
Route::post('/car/simulation', [SimulationApi::class,'store']);
