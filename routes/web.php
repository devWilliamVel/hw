<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CombatsController;
use App\Http\Controllers\GuildController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TitanController;
use App\Http\Controllers\UserController;
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

//Auth::routes();

/*Route::get('/home', 'HomeController@index')->name('home');*/


Route::post('logout', [LoginController::class,'logout'])->name('logout');

Route::middleware('guest')->group(function () {

    /** LOGIN */
    Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
    Route::post('login', [UserController::class,'login']);
});

Route::middleware('auth:web')->group(function () {
    /** HOME */
    Route::get('/home', function () {
        return redirect('/');
    })->name('home');
    Route::get('/', [HomeController::class,'index'])->name('home');

    /** ADMIN */
    Route::any("admin/rolesAndPermissions", [AdminController::class,'rolesAndPermissions'])->name('admin.rolesAndPermissions');
    Route::any("admin/createPermission", [AdminController::class,'createPermission'])->name('admin.createPermission');
    Route::any("admin/deletePermission", [AdminController::class,'deletePermission'])->name('admin.deletePermission');
    Route::any("admin/createRole", [AdminController::class,'createRole'])->name('admin.createRole');
    Route::any("admin/deleteRole", [AdminController::class,'deleteRole'])->name('admin.deleteRole');
    Route::any("admin/givePermissionToRole", [AdminController::class,'givePermissionToRole'])->name('admin.givePermissionToRole');
    Route::any("admin/revokePermissionToRole", [AdminController::class,'revokePermissionToRole'])->name('admin.revokePermissionToRole');
    Route::any("admin/assignRoleToUser", [AdminController::class,'assignRoleToUser'])->name('admin.assignRoleToUser');
    Route::any("admin/removeRoleToUser", [AdminController::class,'removeRoleToUser'])->name('admin.removeRoleToUser');
    Route::any("admin/getUserRoles/{idUser}", [AdminController::class,'getUserRoles'])->name('admin.getUserRoles');
    Route::any("admin/getRolePermissions/{idRole}", [AdminController::class,'getRolePermissions'])->name('admin.getRolePermissions');

    /** USERS */
    Route::get('users', [UserController::class,'index'])->name('users.list');
    Route::post('users/enable-disable', [UserController::class,'enableDisableUser'])->name('users.enableDisable');
    Route::get('user/register', [RegisterController::class,'showRegistrationForm'])->name('register');
    Route::post('user/register', [UserController::class,'register']);
    Route::get('user/edit/{id}', [UserController::class,'edit'])->name('user.edit');
    Route::post('user/update/{id}', [UserController::class,'updateUser'])->name('user.update');
    Route::post('user/update-password/{id}', [UserController::class,'updatePassword'])->name('user.updatePassword');
    Route::get('user/profile', [UserController::class,'profile'])->name('user.profile');
    Route::post('user/update-data', [UserController::class,'updateUserProfile'])->name('user.update.profile');
    Route::post('user/update-password', [UserController::class,'updateUserPassword'])->name('user.updatePassword.profile');

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

    Route::prefix('combats')->name('combats')->group(function(){
        Route::get('heroes', [CombatsController::class, 'heroesCombats'])->name('.heroes');
        Route::post('heroes/store', [CombatsController::class, 'storeHeroesCombatFullPower'])->name('.heroes.store');
        Route::post('heroes/store-with-power', [CombatsController::class, 'storeHeroesCombatWithPower'])->name('.heroes.storeWithPower');
        Route::post('heroes/store-full-information', [CombatsController::class, 'storeHeroesCombatFullInformation'])->name('.heroes.storeFullInformation');

        Route::get('titans', [CombatsController::class, 'titansCombats'])->name('.titans');
        Route::post('titans/store', [CombatsController::class, 'storeTitansCombatFullPower'])->name('.titans.store');
        Route::post('titans/store-with-power', [CombatsController::class, 'storeTitansCombatWithPower'])->name('.titans.storeWithPower');
        Route::post('titans/store-full-information', [CombatsController::class, 'storeTitansCombatFullInformation'])->name('.titans.storeFullInformation');
    });
//Route::prefix('pet')->name('pet')->group(function(){});
});