<?php

use App\Http\Controllers\API\BoxController;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\SearchController;
use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function (){
    Route::get('/', function (){
        return view('dashboard');
    });

    Route::get('boxes', [BoxController::class, 'index']);
    Route::get('boxes/{box}', [BoxController::class, 'show']);
    Route::post('boxes', [BoxController::class, 'store']);
    Route::put('boxes/{box}', [BoxController::class, 'update']);
    Route::delete('boxes/{box}', [BoxController::class, 'destroy']);

    Route::get('locations', [LocationController::class, 'index']);
    Route::get('groups', [GroupController::class, 'index']);

    Route::get('items', [ItemController::class, 'index']);
    Route::post('items', [ItemController::class, 'store']);
    Route::put('items/{item}', [ItemController::class, 'update']);

    Route::get('search', [SearchController::class, 'index']);
});
