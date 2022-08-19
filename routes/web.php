<?php

use App\Http\Controllers\GuildController;
use App\Http\Controllers\PlayerController;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('guilds', [GuildController::class, 'index']);
Route::prefix('guild')->name('guild')->group(function(){
    Route::get('{id}', [GuildController::class, 'show']);
    Route::post('store', [GuildController::class, 'store'])->name('.store');
    Route::post('update', [GuildController::class, 'update'])->name('.update');
    Route::post('delete/{id}', [GuildController::class, 'delete'])->name('.delete');
});

Route::get('players', [PlayerController::class, 'index']);
Route::prefix('player')->name('player')->group(function(){
    Route::get('{id}', [PlayerController::class, 'show']);
    Route::post('update', [PlayerController::class, 'update'])->name('.update');
    Route::post('store', [PlayerController::class, 'store'])->name('.store');
    Route::post('delete/{id}', [PlayerController::class, 'delete'])->name('.delete');
    Route::post('add/hero/{playerId}', [PlayerController::class, 'addHero'])->name('.add.hero');
    Route::post('add/titan/{playerId}', [PlayerController::class, 'addTitan'])->name('.add.titan');
    Route::post('add/pet/{playerId}', [PlayerController::class, 'addPet'])->name('.add.pet');
    Route::post('update/hero/{playerId}', [PlayerController::class, 'updateHero'])->name('.update.hero');
    Route::post('update/titan/{playerId}', [PlayerController::class, 'updateTitan'])->name('.update.titan');
    Route::post('update/pet/{playerId}', [PlayerController::class, 'updatePet'])->name('.update.pet');
    Route::post('remove/hero/{playerId}/{heroId}', [PlayerController::class, 'removeHero'])->name('.remove.hero');
    Route::post('remove/titan/{playerId}/{titanId}', [PlayerController::class, 'removeTitan'])->name('.remove.titan');
    Route::post('remove/pet/{playerId}/{petId}', [PlayerController::class, 'removePet'])->name('.remove.pet');
});



