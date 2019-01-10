<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    echo 'fuck you';
//    return $router->app->version();
});


//1005获取号码
$router->get('/genid/{type}', 'Api\V1\GetNumsController@getGenid');