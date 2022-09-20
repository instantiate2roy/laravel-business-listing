<?php

use App\CustomClasses\NavMenu;
use App\CustomClasses\UserChecking;
use App\Models\NavigationMenu;
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
    $navBar  = new stdClass;
    $navBar->right = NavMenu::get('TOP_RIGHT_NAV_BAR', 'ACTV');
    if (UserChecking::hasRole(['SU_ADMIN', 'SU_ADMIN'])) {
        $navBar->left = NavMenu::get('TOP_LEFT_NAV_BAR', 'ACTV');
    }
    return view('dashboard', compact('navBar'));
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['isSecurityAdmin'])->group(function () {
    Route::get('/configuration', function () {
        $sidebar = NavMenu::get('SYS_CONFIG_LEFT_SIDE_BAR', 'ACTV');
        $navBar  = new stdClass;
        $navBar->right = NavMenu::get('TOP_RIGHT_NAV_BAR', 'ACTV');
        if (UserChecking::hasRole(['SU_ADMIN', 'SU_ADMIN'])) {
            $navBar->left = NavMenu::get('TOP_LEFT_NAV_BAR', 'ACTV');
        }

        return view('configuration.configuration', compact('sidebar', 'navBar'));
    })->name('configuration');

    Route::get('/userManagement', function () {
        $sidebar = NavMenu::get('USER_CONFIG_LEFT_SIDE_BAR', 'ACTV');
        $navBar  = new stdClass;
        $navBar->right = NavMenu::get('TOP_RIGHT_NAV_BAR', 'ACTV');
        if (UserChecking::hasRole(['SU_ADMIN', 'SU_ADMIN'])) {
            $navBar->left = NavMenu::get('TOP_LEFT_NAV_BAR', 'ACTV');
        }

        return view('userManagement.userManagement', compact('sidebar', 'navBar'));
    })->name('userManagement');

    Route::resource('/lookups', App\Http\Controllers\LookupsController::class);

    Route::resource('/ranks', App\Http\Controllers\RanksController::class);

    Route::resource('/groups', App\Http\Controllers\GroupsController::class);

    Route::resource('/roles', App\Http\Controllers\RolesController::class);

    Route::resource('/userRoles', App\Http\Controllers\UserRolesController::class);

    Route::resource('/navigationMenus', App\Http\Controllers\NavigationMenusController::class);

    Route::resource('/navigationItems', App\Http\Controllers\NavigationItemsController::class);
});
