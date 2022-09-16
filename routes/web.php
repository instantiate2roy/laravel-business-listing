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

require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/configuration', function () {
    $sidebar = (object) array(
        'title' => 'Configuration Setup',
        'titleLevel2' => 'Menus',
        'items' => (object) array(
            ['name' => 'Lookup Value Setup', 'url' => '/lookups', 'active' => ''],
            ['name' => 'blank', 'url' => '#', 'active' => ''],
            ['name' => 'blank', 'url' => '#', 'active' => '']
        )
    );
    return view('configuration.configuration',compact('sidebar'));
})->name('configuration');

Route::get('/userManagement', function () {
    $sidebar = (object) array(
        'title' => 'User Management',
        'titleLevel2' => 'Menus',
        'items' => (object) array(
            ['name' => 'Users', 'url' => '/users', 'active' => ''],
            ['name' => 'Ranks', 'url' => '/ranks', 'active' => ''],
            ['name' => 'Roles', 'url' => 'roles', 'active' => ''],
            ['name' => 'Groups', 'url' => '/groups', 'active' => '']
        )
    );
    return view('userManagement.userManagement',compact('sidebar'));
})->name('userManagement');

Route::resource('/lookups', App\Http\Controllers\LookupsController::class);

Route::resource('/ranks', App\Http\Controllers\RanksController::class);

Route::resource('/groups', App\Http\Controllers\GroupsController::class);
