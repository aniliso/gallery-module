<?php

namespace Modules\Gallery\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Gallery\Events\Handlers\RegisterGallerySidebar;

class GalleryServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

        $this->app->extend('asgard.ModulesList', function($app) {
            array_push($app, 'gallery');
            return $app;
        });

        $this->registerWidgets();

        $this->app['events']->listen(
            BuildingSidebar::class,
            $this->getSidebarClassForModule('Gallery', RegisterGallerySidebar::class)
        );
    }

    public function boot()
    {
        $this->publishConfig('gallery', 'config');
        $this->publishConfig('gallery', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');


    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Gallery\Repositories\CategoryRepository',
            function () {
                $repository = new \Modules\Gallery\Repositories\Eloquent\EloquentCategoryRepository(new \Modules\Gallery\Entities\Category());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Gallery\Repositories\Cache\CacheCategoryDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Gallery\Repositories\AlbumRepository',
            function () {
                $repository = new \Modules\Gallery\Repositories\Eloquent\EloquentAlbumRepository(new \Modules\Gallery\Entities\Album());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Gallery\Repositories\Cache\CacheAlbumDecorator($repository);
            }
        );
// add bindings


    }

    private function registerWidgets()
    {
        \Widget::register('galleryLatest', '\Modules\Gallery\Widgets\GalleryWidgets@latest');
        \Widget::register('galleryByCategory', '\Modules\Gallery\Widgets\GalleryWidgets@latestByCategory');
        \Widget::register('galleryCategories', '\Modules\Gallery\Widgets\GalleryWidgets@categories');
    }
}
