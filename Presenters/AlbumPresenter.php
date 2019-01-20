<?php

namespace Modules\Gallery\Presenters;

use Modules\Core\Presenters\BasePresenter;

class AlbumPresenter extends BasePresenter
{
    protected $zone = 'albumImage';
    protected $slug = 'slug';
    protected $transKey = 'gallery::routes.album.show';
    protected $routeKey = 'gallery.album.show';
    protected $descriptionKey = 'description';
}
