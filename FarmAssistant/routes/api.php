<?php

use App\Http\Resources\AgriculturalPractiseCollection;
use App\Models\AgriculturalPractise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
Route::get('farm/{idFarm}/practise', [App\Http\Controllers\AgriculturalPractiseApiController::class, 'list']);
Route::get('farm/{idFarm}/practise/{id}', [App\Http\Controllers\AgriculturalPractiseApiController::class, 'find']);

Route::get('farms{', function () {
    return new AgriculturalPractiseCollection(AgriculturalPractise::all());
});
Route::get('/farm/{idFarm}/events', [App\Http\Controllers\AgriculturalPractiseApiController::class, 'events']);

Route::get('farms/{idFarm}/practises', function ($idFarm = 4) {
    return new AgriculturalPractiseCollection(AgriculturalPractise::all());
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
