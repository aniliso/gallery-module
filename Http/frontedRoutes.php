<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group([], function (Router $router) {
    $router->get(LaravelLocalization::transRoute('gallery::routes.category'), [
        'uses' => 'PublicController@category',
        'as'   => 'gallery.category'
    ]);
    $router->get(LaravelLocalization::transRoute('gallery::routes.album.show'), [
        'uses' => 'PublicController@show',
        'as'   => 'gallery.album.show'
    ]);
    $router->get(LaravelLocalization::transRoute('gallery::routes.album.index'), [
        'uses' => 'PublicController@index',
        'as'   => 'gallery.album.index'
    ]);
});
