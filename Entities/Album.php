<?php

namespace Modules\Gallery\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Gallery\Presenters\AlbumPresenter;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Tag\Contracts\TaggableInterface;
use Modules\Tag\Traits\TaggableTrait;

class Album extends Model implements TaggableInterface
{
    use Translatable, TaggableTrait, MediaRelation, NamespacedEntity, PresentableTrait;

    protected $table = 'gallery__albums';

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
        'category_id',
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

    protected static $entityNamespace = 'asgardcms/gallery';
    protected $presenter = AlbumPresenter::class;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getUrlAttribute()
    {
        return route('gallery.album.show', [$this->slug]);
    }

    /**
     * @return string
     */
    public function getRobotsAttribute()
    {
        return $this->meta_robot_no_index.', '.$this->meta_robot_no_follow;
    }
}
