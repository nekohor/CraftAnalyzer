<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('users', UserController::class);

    $router->get('unstables','UnstablesController@index');

    $router->get('chartjs', 'ChartjsController@index');
    $router->get('review', 'HotRollReviewController@index');

    $router->get('pond', "PondReviewController@index");

});
