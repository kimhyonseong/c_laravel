<?php

use App\Http\Controllers\findPokeController;
use App\Http\Controllers\pokedexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jsonPaseTestController;

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

Route::get('/jsonParse', [jsonPaseTestController::class,'show'])->name('jsonParse');

Route::get('/pokedex', [pokedexController::class,'show'])->name('pokedex');
Route::get('/pokedex/{num}', [pokedexController::class,'showDetail'])->name('pokedexDetail');
Route::get('/poketAjax/{page}', [pokedexController::class,'showMore'])->name('poketAjax');

Route::get('/findPoke', [findPokeController::class, 'index'])->name('findPoke');
Route::get('/findPokeAjax', [findPokeController::class, 'find'])->name('findPokeAjax');

Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
