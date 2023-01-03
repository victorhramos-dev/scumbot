<?php

use App\Jobs\FetchLogs;
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
    FetchLogs::fetchOnce();

    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin'], function() use($router) {

    // Authentication Routes...
    $router->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $router->post('login', 'Auth\LoginController@login')->name('login');
    $router->get('logout', 'Auth\LoginController@logout')->name('logout');

    // Password Reset Routes...
    $router->group([
        'prefix' => 'password',
        'as'     => 'password.'
    ], function() use($router) {
        $router
            ->get('email', 'Auth\ForgotPasswordController@showLinkRequestForm')
            ->name('email');

        $router
            ->post('request', 'Auth\ForgotPasswordController@sendResetLinkEmail')
            ->name('request');

        $router
            ->get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')
            ->name('reset');

        $router
            ->post('save', 'Auth\ResetPasswordController@reset')
            ->name('save');
    });

    // Authenticated Middlewares
    $middleware = [
        'admin',
        'viewShareLoggedUser:administrator',
    ];

    // Authenticated Routes
    $router->group(['middleware' => $middleware], function() use($router) {

        // Dashboard
        $router->get('/', 'DashboardController@index')->name('dashboard');

        // Profile
        $router->get('profile', 'ProfileController@index')->name('profile');
        $router->post('profile', 'ProfileController@update')->name('profile.store');


        // Business Group
        $router->group(['prefix' => 'business'], function() use($router) {

            // Players
            $router->group([
                'prefix' => 'players',
                'as'     => 'players.'
            ], function() use($router) {
                $router
                    ->get('', 'Business\PlayersController@index')
                    ->name('index')
                    ->middleware('needsPermission:player.index');

                $router
                    ->get('create', 'Business\PlayersController@create')
                    ->name('create')
                    ->middleware('needsPermission:player.create');

                $router
                    ->get('{player}/edit', 'Business\PlayersController@edit')
                    ->name('edit')
                    ->middleware('needsPermission:player.edit');

                $router
                    ->post('store', 'Business\PlayersController@store')
                    ->name('store')
                    ->middleware('needsPermission:player.create');

                $router
                    ->put('{player}/update', 'Business\PlayersController@update')
                    ->name('update')
                    ->middleware('needsPermission:player.edit');

                $router
                    ->delete('{player}/destroy', 'Business\PlayersController@destroy')
                    ->name('destroy')
                    ->middleware('needsPermission:player.destroy');
            });

            // Drones
            $router->group([
                'prefix' => 'drones',
                'as'     => 'drones.'
            ], function() use($router) {
                $router
                    ->get('', 'Business\DronesController@index')
                    ->name('index')
                    ->middleware('needsPermission:drone.index');

                $router
                    ->get('create', 'Business\DronesController@create')
                    ->name('create')
                    ->middleware('needsPermission:drone.create');

                $router
                    ->get('{drone}/edit', 'Business\DronesController@edit')
                    ->name('edit')
                    ->middleware('needsPermission:drone.edit');

                $router
                    ->post('store', 'Business\DronesController@store')
                    ->name('store')
                    ->middleware('needsPermission:drone.create');

                $router
                    ->put('{drone}/update', 'Business\DronesController@update')
                    ->name('update')
                    ->middleware('needsPermission:drone.edit');

                $router
                    ->delete('{drone}/destroy', 'Business\DronesController@destroy')
                    ->name('destroy')
                    ->middleware('needsPermission:drone.destroy');
            });
        });

        // Administrators
        $router->group([
            'prefix' => 'system/management/administrators',
            'as'     => 'administrators.'
        ], function() use($router) {
            $router
                ->get('', 'System\Management\AdministratorsController@index')
                ->name('index')
                ->middleware('needsPermission:administrator.index');

            $router
                ->get('create', 'System\Management\AdministratorsController@create')
                ->name('create')
                ->middleware('needsPermission:administrator.create');

            $router
                ->get('{administrator}/edit', 'System\Management\AdministratorsController@edit')
                ->name('edit')
                ->middleware('needsPermission:administrator.edit');

            $router
                ->post('store', 'System\Management\AdministratorsController@store')
                ->name('store')
                ->middleware('needsPermission:administrator.create');

            $router
                ->put('{administrator}/update', 'System\Management\AdministratorsController@update')
                ->name('update')
                ->middleware('needsPermission:administrator.edit');

            $router
                ->delete('{administrator}/destroy', 'System\Management\AdministratorsController@destroy')
                ->name('destroy')
                ->middleware('needsPermission:administrator.destroy');
        });

        // Settings
        $router->group([
            'prefix' => 'system/settings',
            'as'     => 'settings.'
        ], function() use($router) {
            $router
                ->get('', 'System\SettingsController@index')
                ->name('index')
                ->middleware('needsPermission:settings.general');

            $router
                ->post('store', 'System\SettingsController@store')
                ->name('store')
                ->middleware('needsPermission:settings.general');
        });
    });
});


/*
|--------------------------------------------------------------------------
| Player Dashboard Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'player', 'as' => 'player.', 'namespace' => 'App\Http\Controllers\Player'], function() use($router) {

    // Authentication Routes...
    $router->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $router->post('login', 'Auth\LoginController@login')->name('login');
    $router->get('logout', 'Auth\LoginController@logout')->name('logout');

    // Password Reset Routes...
    $router->group([
        'prefix' => 'password',
        'as'     => 'password.'
    ], function() use($router) {
        $router
            ->get('email', 'Auth\ForgotPasswordController@showLinkRequestForm')
            ->name('email');

        $router
            ->post('request', 'Auth\ForgotPasswordController@sendResetLinkEmail')
            ->name('request');

        $router
            ->get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')
            ->name('reset');

        $router
            ->post('save', 'Auth\ResetPasswordController@reset')
            ->name('save');
    });

    // Password Reset Routes...
    $router->group([
        'prefix' => 'password',
        'as'     => 'password.'
    ], function() use($router) {
        $router
            ->get('email', 'Auth\ForgotPasswordController@showLinkRequestForm')
            ->name('email');

        $router
            ->post('request', 'Auth\ForgotPasswordController@sendResetLinkEmail')
            ->name('request');

        $router
            ->get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')
            ->name('reset');

        $router
            ->post('save', 'Auth\ResetPasswordController@reset')
            ->name('save');
    });

    // Authenticated Middlewares
    $middleware = [
        'player',
        'viewShareLoggedUser:player',
    ];

    // Authenticated routes
    $router->group(['middleware' => $middleware], function() use($router) {

        // Dashboard
        $router->get('/', 'DashboardController@index')->name('dashboard');

        // Profile
        $router->get('profile', 'ProfileController@index')->name('profile');
        $router->post('profile', 'ProfileController@update')->name('profile.store');
    });
});