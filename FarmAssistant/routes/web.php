<?php

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('farm', 'App\Http\Controllers\FarmController');
Route::resource('farm/{idFarm}/field', 'App\Http\Controllers\FieldController');
Route::resource('farm/{idFarm}/field/{idField}/parcel', 'App\Http\Controllers\CadastralParcelController');

require __DIR__.'/auth.php';
