<?php

namespace Modules\Gallery\Repositories\Cache;

use Modules\Gallery\Repositories\CategoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCategoryDecorator extends BaseCacheDecorator implements CategoryRepository
{
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->entityName = 'gallery.categories';
        $this->repository = $category;
    }
}
