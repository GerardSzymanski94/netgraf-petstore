<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetstoreApiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [PetstoreApiController::class, 'index'])->name('index');


Route::group(['prefix' => 'petstore', 'as' => 'petstore.'], function () {
    Route::post('/find', [PetstoreApiController::class, 'find'])->name('find');
    });
