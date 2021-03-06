<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('login');
});

Route::middleware('auth')->group(function (){
    Route::get('/home', function(){
        return view('home');
    });
    Route::get('/responsible', function(){
        return view('responsible');
    });
    Route::get('/control', function(){
        return view('inspector');
    });
    Route::get('/direction', function(){
        return view('direction');
    });
    Route::get('/cashier', function(){
        return view('cashier');
    });
});
//Route::post('login',[UserController::class,'authentication'])->name('login');