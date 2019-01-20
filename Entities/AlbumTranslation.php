<?php

namespace Modules\Gallery\Entities;

use Illuminate\Database\Eloquent\Model;

class AlbumTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_type'
    ];
    protected $table = 'gallery__album_translations';
}
