<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\HostelController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('register','register');

});
Route::group(["middleware" => 'auth:sanctum'], function () {
  
    Route::resource('hostel', HostelController::class);
    Route::resource('room', RoomController::class);
    Route::resource('seat', SeatController::class);
});
