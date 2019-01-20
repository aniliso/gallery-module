<?php

namespace Modules\Gallery\Repositories\Cache;

use Illuminate\Support\Collection;
use Modules\Gallery\Repositories\AlbumRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheAlbumDecorator extends BaseCacheDecorator implements AlbumRepository
{
    public function __construct(AlbumRepository $album)
    {
        parent::__construct();
        $this->entityName = 'gallery.albums';
        $this->repository = $album;
    }

    /**
     * Return the latest x blog posts
     * @param int $amount
     * @return Collection
     */
    public function latest($amount = 5)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.latest.{$amount}", $this->cacheTime,
                function () use ($amount) {
                    return $this->repository->latest($amount);
                }
            );
    }
}
