<?php

use Illuminate\Http\Request;

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

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function($api){
    $api->group(['middleware' => 'auth.jwt'], function ($api) {
        $api->DELETE('logout', 'App\Http\Controllers\AuthController@logout');
        $api->GET('me', 'App\Http\Controllers\AuthController@show');
        $api->GET('index', 'App\Http\Controllers\subjectController@index');
        $api->POST('store', 'App\Http\Controllers\subjectController@store');
        $api->PATCH('update/{id}', 'App\Http\Controllers\subjectController@update');
        $api->DELETE('destroy/{id}', 'App\Http\Controllers\subjectController@destroy');
    });
    $api->POST('register', 'App\Http\Controllers\AuthController@register');
    $api->POST('login', 'App\Http\Controllers\AuthController@login');
});
