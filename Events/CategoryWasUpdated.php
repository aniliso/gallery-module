<?php

namespace Modules\Gallery\Events;

use Modules\Gallery\Entities\Category;
use Modules\Media\Contracts\StoringMedia;

class CategoryWasUpdated implements StoringMedia
{
    /**
     * @var Category
     */
    private $category;
    /**
     * @var array
     */
    private $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Category $category, array $data)
    {
        //
        $this->category = $category;
        $this->data = $data;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->category;
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
