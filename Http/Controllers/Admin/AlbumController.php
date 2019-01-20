<?php

namespace Modules\Gallery\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Gallery\Entities\Album;
use Modules\Gallery\Http\Requests\CreateAlbumRequest;
use Modules\Gallery\Http\Requests\UpdateAlbumRequest;
use Modules\Gallery\Repositories\AlbumRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Gallery\Repositories\CategoryRepository;
use Datatables;

class AlbumController extends AdminBaseController
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
        parent::__construct();

        $this->album = $album;
        $this->category = $category;

        view()->share('selectCategories', $this->category->all()->pluck('title', 'id')->toArray());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $albums = $this->album->allWithBuilder()->with(['translations', 'category', 'category.translations']);
        if(request()->ajax()) {
            return Datatables::eloquent($albums)
                ->editColumn('status', function ($album){
                    return $album->status ? 'Yayında' : 'Taslak';
                })
                ->addColumn('title', function($album){
                    return $album->translate($this->locale)->title;
                })
                ->addColumn('slug', function($album){
                    return $album->translate($this->locale)->slug;
                })
                ->addColumn('category', function ($album) {
                    return $album->category->translate($this->locale)->title ?? null;
                })
                ->addColumn('image', function($album){
                    return $album->files()->count();
                })
                ->addColumn('action', function ($album) {
                    $action_buttons =   \Html::decode(link_to(
                        route('admin.gallery.album.edit',
                            [$album->id]),
                        '<i class="fa fa-pencil"></i>',
                        ['class'=>'btn btn-default btn-flat']
                    ));
                    $action_buttons .=  \Html::decode(\Form::button(
                        '<i class="fa fa-trash"></i>',
                        ["data-toggle" => "modal",
                         "data-action-target" => route("admin.gallery.album.destroy", [$album->id]),
                         "data-target" => "#modal-delete-confirmation",
                         "class"=>"btn btn-danger btn-flat"]
                    ));
                    return $action_buttons;
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('gallery::admin.albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('gallery::admin.albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAlbumRequest $request
     * @return Response
     */
    public function store(CreateAlbumRequest $request)
    {
        $this->album->create($request->all());

        return redirect()->route('admin.gallery.album.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('gallery::albums.title.albums')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Album $album
     * @return Response
     */
    public function edit(Album $album)
    {
        return view('gallery::admin.albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Album $album
     * @param  UpdateAlbumRequest $request
     * @return Response
     */
    public function update(Album $album, UpdateAlbumRequest $request)
    {
        $this->album->update($album, $request->all());

        return redirect()->route('admin.gallery.album.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('gallery::albums.title.albums')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Album $album
     * @return Response
     */
    public function destroy(Album $album)
    {
        $this->album->destroy($album);

        return redirect()->route('admin.gallery.album.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('gallery::albums.title.albums')]));
    }
}
