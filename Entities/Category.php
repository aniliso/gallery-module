<?php

namespace Modules\Gallery\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Gallery\Presenters\CategoryPresenter;
use Modules\Media\Support\Traits\MediaRelation;

class Category extends Model
{
    use Translatable, MediaRelation, PresentableTrait;

    protected $table = 'gallery__categories';

    public $translatedAttributes = [
        'title',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_type'
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_type',
        'status',
        'sorting',
        'meta_robot_no_index',
        'meta_robot_no_follow',
        'sitemap_include',
        'sitemap_priority',
        'sitemap_frequency'
    ];

    protected $presenter = CategoryPresenter::class;

    public function albums()
    {
        return $this->hasMany(Album::class)->with(['translations']);
    }

    public function getUrlAttribute()
    {
        return route('gallery.category', [$this->slug]);
    }
}
