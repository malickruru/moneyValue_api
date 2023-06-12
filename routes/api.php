<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\CurrenciesController;
use App\Http\Controllers\PairController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// route public
Route::get("/ping",[ApiController::class,'ping']);
Route::post("/login",[UserController::class,'login']);
Route::get("/logout",[UserController::class,'logout']);

//route privés
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('/currencies', CurrenciesController::class);
    Route::resource('/pairs', PairController::class);
    Route::post('/convert',[ConversionController::class,'convert']);
    Route::get('/conversion/sum',[ConversionController::class,'sum']);
    Route::get('/conversion/{id}',[ConversionController::class,'show']);

});