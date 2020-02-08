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

$versions = [1, 2];

foreach ($versions as $version)
{
    Route::group([
        'prefix' => "v{$version}",
        'middleware' => [
            'xss_protection',
            'x_api_key',
        ],
    ], function() use ($version) {
        // General Endpoint
        Route::get("test", function() use ($version) {
            return "Solo Wrestling v{$version} is Ready !";
        });

        Route::post("login", "v{$version}\LoginController@login");
        
        // Logged In Enpoints
        Route::group([
            'middleware' => [
                'auth:api',
                'db_transaction',
                'localization',
            ],
        ], function () use ($version) {
            
            // Me
            Route::get("me", "v{$version}\UserController@getMe");
            
            Route::post("me/logout", "v{$version}\LoginController@logout");
        });
    });
}

