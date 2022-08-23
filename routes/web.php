<?php

use App\Http\Controllers\GuildController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TitanController;
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

Route::get('heroes', [HeroController::class, 'index'])->name('heroes');
Route::prefix('hero')->name('hero')->group(function(){
    Route::get('create', [HeroController::class, 'create'])->name('.create');
    Route::post('store', [HeroController::class, 'store'])->name('.store');
    Route::get('edit/{id}', [HeroController::class, 'edit'])->name('.edit');
    Route::post('update/{id}', [HeroController::class, 'update'])->name('.update');
    Route::post('delete/{id}', [HeroController::class, 'delete'])->name('.delete');
});

Route::get('titans', [TitanController::class, 'index'])->name('titans');
Route::prefix('titan')->name('titan')->group(function(){
    Route::get('create', [TitanController::class, 'create'])->name('.create');
    Route::post('store', [TitanController::class, 'store'])->name('.store');
    Route::get('edit/{id}', [TitanController::class, 'edit'])->name('.edit');
    Route::post('update/{id}', [TitanController::class, 'update'])->name('.update');
    Route::post('delete/{id}', [TitanController::class, 'delete'])->name('.delete');
});

Route::get('pets', [PetController::class, 'index'])->name('pets');
Route::prefix('pet')->name('pet')->group(function(){
    Route::get('create', [PetController::class, 'create'])->name('.create');
    Route::post('store', [PetController::class, 'store'])->name('.store');
    Route::get('edit/{id}', [PetController::class, 'edit'])->name('.edit');
    Route::post('update/{id}', [PetController::class, 'update'])->name('.update');
    Route::post('delete/{id}', [PetController::class, 'delete'])->name('.delete');
});

