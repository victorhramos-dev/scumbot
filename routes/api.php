<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*
|--------------------------------------------------------------------------
| Drone Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'drone', 'as' => 'drone.', 'namespace' => 'App\Http\Controllers\Api\Drone'], function() use($router) {

    // Authentication Routes...
    $router->post('login', 'Auth\LoginController@login')->name('login');

    // Auth middlewares
    $middleware = [
        'drone.hwid',
        'auth:api_drone',
    ];

    // Authenticated Routes
    $router->group(['middleware' => $middleware], function() use ($router) {

        // Commands
        $router->group([
            'prefix' => 'commands',
            'as'     => 'commands.'
        ], function() use($router) {
            $router
                ->get('', 'CommandsController@index')
                ->name('index');
        });
    });
});