<?php

use App\Events\ArduinoEvent;
use App\Http\Controllers\CommunityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GrometoolController;
use App\Models\Grometool;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/ws', function(){
    return view('layouts.ws');
});
// Route::post('/ws', function(){
//     event(new ArduinoEvent("test pesan", "vannyezha","grome800000001"));
//     // return view('layouts.ws');
// });
Route::redirect('/', 'login');
// Route::post('/test/{aa}',[GrometoolController::class,'test']);

// Route::get('/vanny', [CommunityController::class, 'vanny']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::fallback(function() {
        return view('pages/utility/404');
    });

    Route::post('/guid/setpoint',[GrometoolController::class,'setpoint'])->name('guid.setpoint');
    // Route::post('/{username}/{guid}/{setpoint}/{value}',[GrometoolController::class,'setpoint']);
    // Route::get('/{username}/{guid}/{setpoint}/{value}',[GrometoolController::class,'getpoint']);
    Route::get('/{username}/{guid}',[GrometoolController::class,'guid']);
    Route::get('/{username}',[GrometoolController::class,'profile']);
});

