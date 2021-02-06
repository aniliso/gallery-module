<?php

namespace Modules\Gallery\Widgets;


use Modules\Gallery\Repositories\AlbumRepository;
use Modules\Gallery\Repositories\CategoryRepository;

class GalleryWidgets
{
    /**
     * @var AlbumRepository
     */
    private $album;
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(AlbumRepository $album, CategoryRepository $category)
    {
        $this->album = $album;
        $this->category = $category;
    }

    public function latest($limit=6, $view='latest')
    {
        $albums = $this->album->latest($limit);
        if($albums->count()>0) {
            return view('gallery::widgets.'.$view, compact('albums'));
        }
        return null;
    }

    public function latestByCategory($slug="", $limit=6, $view="latest-category")
    {
        $category = $this->category->findBySlug($slug);
        if($category->albums()->count() > 0) {
            $albums = $category->albums()->active()->take($limit)->get();
            return view('gallery::widgets.'.$view, compact('albums', 'category'));
        }
        return null;
    }

    public function categories($limit=10, $view='category')
    {
        $categories = $this->category->all()->take($limit);
        if($categories->count() > 0) {
            return view('gallery::widgets.'.$view, compact('categories'));
        }
        return null;
    }
}
