<?php

namespace Modules\Gallery\Presenters;

use Modules\Core\Presenters\BasePresenter;

class CategoryPresenter extends BasePresenter
{
    protected $zone     = 'galleryImage';
    protected $slug     = 'slug';
    protected $transKey = 'gallery::routes.category';
    protected $routeKey = 'gallery.category';
}
