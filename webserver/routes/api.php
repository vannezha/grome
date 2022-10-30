<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrometoolController;
use App\Http\Controllers\ArduinoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [ArduinoController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/{username}/{guid}', [ArduinoController::class, 'pool'])->name('pool');
    Route::post('/logout', [ArduinoController::class, 'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
