<?php

return [
    'gallery.categories' => [
        'index' => 'gallery::categories.list resource',
        'create' => 'gallery::categories.create resource',
        'edit' => 'gallery::categories.edit resource',
        'destroy' => 'gallery::categories.destroy resource',
        'sitemap' => 'gallery::categories.sitemap resource',
    ],
    'gallery.albums' => [
        'index' => 'gallery::albums.list resource',
        'create' => 'gallery::albums.create resource',
        'edit' => 'gallery::albums.edit resource',
        'destroy' => 'gallery::albums.destroy resource',
        'sitemap' => 'gallery::albums.sitemap resource'
    ],
// append


];
