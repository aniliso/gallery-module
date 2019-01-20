<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/gallery'], function (Router $router) {
    $router->bind('galeryCategory', function ($id) {
        return app('Modules\Gallery\Repositories\CategoryRepository')->find($id);
    });
    $router->get('categories', [
        'as' => 'admin.gallery.category.index',
        'uses' => 'CategoryController@index',
        'middleware' => 'can:gallery.categories.index'
    ]);
    $router->get('categories/create', [
        'as' => 'admin.gallery.category.create',
        'uses' => 'CategoryController@create',
        'middleware' => 'can:gallery.categories.create'
    ]);
    $router->post('categories', [
        'as' => 'admin.gallery.category.store',
        'uses' => 'CategoryController@store',
        'middleware' => 'can:gallery.categories.create'
    ]);
    $router->get('categories/{galeryCategory}/edit', [
        'as' => 'admin.gallery.category.edit',
        'uses' => 'CategoryController@edit',
        'middleware' => 'can:gallery.categories.edit'
    ]);
    $router->put('categories/{galeryCategory}', [
        'as' => 'admin.gallery.category.update',
        'uses' => 'CategoryController@update',
        'middleware' => 'can:gallery.categories.edit'
    ]);
    $router->delete('categories/{galeryCategory}', [
        'as' => 'admin.gallery.category.destroy',
        'uses' => 'CategoryController@destroy',
        'middleware' => 'can:gallery.categories.destroy'
    ]);
    $router->bind('album', function ($id) {
        return app('Modules\Gallery\Repositories\AlbumRepository')->find($id);
    });
    $router->get('albums', [
        'as' => 'admin.gallery.album.index',
        'uses' => 'AlbumController@index',
        'middleware' => 'can:gallery.albums.index'
    ]);
    $router->get('albums/create', [
        'as' => 'admin.gallery.album.create',
        'uses' => 'AlbumController@create',
        'middleware' => 'can:gallery.albums.create'
    ]);
    $router->post('albums', [
        'as' => 'admin.gallery.album.store',
        'uses' => 'AlbumController@store',
        'middleware' => 'can:gallery.albums.create'
    ]);
    $router->get('albums/{album}/edit', [
        'as' => 'admin.gallery.album.edit',
        'uses' => 'AlbumController@edit',
        'middleware' => 'can:gallery.albums.edit'
    ]);
    $router->put('albums/{album}', [
        'as' => 'admin.gallery.album.update',
        'uses' => 'AlbumController@update',
        'middleware' => 'can:gallery.albums.edit'
    ]);
    $router->delete('albums/{album}', [
        'as' => 'admin.gallery.album.destroy',
        'uses' => 'AlbumController@destroy',
        'middleware' => 'can:gallery.albums.destroy'
    ]);
// append


});
