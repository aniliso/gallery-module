<?php

namespace Modules\Gallery\Http\Controllers;

use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Gallery\Repositories\AlbumRepository;
use Breadcrumbs;
use Modules\Gallery\Repositories\CategoryRepository;

class PublicController extends BasePublicController
{
    /**
     * @var AlbumRepository
     */
    private $album;
    private $perPage;
    /**
     * @var CategoryRepository
     */
    private $category;

    /**
     * PublicController constructor.
     */
    public function __construct(AlbumRepository $album, CategoryRepository $category)
    {
        parent::__construct();
        $this->album = $album;
        $this->category = $category;

        $this->perPage = setting('gallery::per-page') ? setting('gallery::per-page') : 6;

        Breadcrumbs::register('gallery.index', function ($breadcrumbs) {
            $breadcrumbs->push(trans('themes::gallery.meta.title'), route('gallery.album.index'));
        });

    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $albums = $this->album->paginate($this->perPage);

        $this->setTitle(trans('themes::gallery.meta.title'))
            ->setDescription(trans('themes::gallery.meta.desc'));

        $this->setUrl(route('gallery.album.index'))
            ->addMeta('robots', 'index, follow');

        return view('gallery::index', compact('albums'));
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function show($slug)
    {
        $album = $this->album->findBySlug($slug);

        $this->setTitle($album->present()->meta_title)
            ->setDescription($album->present()->meta_description);

        $this->setUrl($album->url)
            ->addMeta('robots', $album->robots);

        /* Start Breadcrumbs */
        Breadcrumbs::register('gallery.show', function ($breadcrumbs) use ($album) {
            $breadcrumbs->parent('gallery.index');
            $breadcrumbs->push($album->present()->meta_title, $album->url);
        });
        /* End Breadcrumbs */

        return view('gallery::show', compact('album'));
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function category($slug)
    {
        $category = $this->category->findBySlug($slug);
        $albums   = $category->albums()->paginate($this->perPage);

        $this->setTitle($category->present()->meta_title)
            ->setDescription($category->present()->meta_description);

        $this->setUrl($category->url)
            ->addMeta('robots', $category->robots);

        /* Start Breadcrumbs */
        Breadcrumbs::register('gallery.category', function ($breadcrumbs) use ($category) {
            $breadcrumbs->parent('gallery.index');
            $breadcrumbs->push($category->present()->meta_title, $category->url);
        });
        /* End Breadcrumbs */

        return view('gallery::category', compact('category', 'albums'));
    }
}
