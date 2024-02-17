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
    Route::post('/find_by_status', [PetstoreApiController::class, 'findByStatus'])->name('find_by_status');
    Route::post('/update/{id}', [PetstoreApiController::class, 'update'])->name('update');
    Route::post('/store', [PetstoreApiController::class, 'store'])->name('store');
    Route::get('/create', [PetstoreApiController::class, 'create'])->name('create');
    Route::get('/{id}', [PetstoreApiController::class, 'edit'])->name('edit');
    Route::delete('/{id}', [PetstoreApiController::class, 'delete'])->name('delete');
});
