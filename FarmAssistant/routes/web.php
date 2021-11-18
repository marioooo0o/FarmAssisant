<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MagazineController;
use App\Models\User;
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
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () { return view('dashboard');})->middleware(['auth'])->name('dashboard');
//Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
//Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
//Route::resource('dashboard', 'App\Http\Controllers\DashboardController')->middleware(['auth']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');
Route::get('/home/{idFarm}', [App\Http\Controllers\HomeController::class, 'show'])->middleware('auth');
Route::resource('farm/{idFarm}/practise', 'App\Http\Controllers\AgriculturalPractiseController')->middleware('auth');
Route::resource('home/{idFarm}/magazine', 'App\Http\Controllers\MagazineController')->middleware('auth');

Route::resource('farm', 'App\Http\Controllers\FarmController');
Route::resource('farm/{idFarm}/field', 'App\Http\Controllers\FieldController')->middleware('auth');
Route::resource('farm/{idFarm}/field/{idField}/parcel', 'App\Http\Controllers\CadastralParcelController');

require __DIR__.'/auth.php';
