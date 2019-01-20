<?php

namespace Modules\Gallery\Events;

use Modules\Media\Contracts\DeletingMedia;

class AlbumWasDeleted implements DeletingMedia
{
    private $albumId;
    private $albumClass;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($albumId, $albumClass)
    {
        //
        $this->albumId = $albumId;
        $this->albumClass = $albumClass;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->albumId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->albumClass;
    }
}
