<?php

use App\Http\Controllers\API\BoxController;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\SearchController;
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

Route::get('user', function (Request $request){
    return new \App\Http\Resources\UserResource($request->user());
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

});
