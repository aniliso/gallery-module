<?php

namespace Modules\Gallery\Events;

use Modules\Gallery\Entities\Album;
use Modules\Media\Contracts\StoringMedia;

class AlbumWasUpdated implements StoringMedia
{
    /**
     * @var Album
     */
    private $album;
    /**
     * @var array
     */
    private $data;

    public function __construct(Album $album, array $data)
    {

        $this->album = $album;
        $this->data = $data;
    }
    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->album;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
