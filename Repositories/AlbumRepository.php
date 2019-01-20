<?php

namespace Modules\Gallery\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface AlbumRepository extends BaseRepository
{
    public function latest($amount=6);
}
