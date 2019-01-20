<?php

namespace Modules\Gallery\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Gallery\Entities\Category;
use Modules\Gallery\Http\Requests\CreateCategoryRequest;
use Modules\Gallery\Http\Requests\UpdateCategoryRequest;
use Modules\Gallery\Repositories\AlbumRepository;
use Modules\Gallery\Repositories\CategoryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CategoryController extends AdminBaseController
{
    /**
     * @var CategoryRepository
     */
    private $category;
    /**
     * @var AlbumRepository
     */
    private $album;

    public function __construct(CategoryRepository $category, AlbumRepository $album)
    {
        parent::__construct();

        $this->category = $category;
        $this->album = $album;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->category->all();

        return view('gallery::admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('gallery::admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCategoryRequest $request
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $this->category->create($request->all());

        return redirect()->route('admin.gallery.category.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('gallery::categories.title.categories')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('gallery::admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Category $category
     * @param  UpdateCategoryRequest $request
     * @return Response
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $this->category->update($category, $request->all());

        return redirect()->route('admin.gallery.category.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('gallery::categories.title.categories')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        $albums = $category->albums()->get();

        foreach ($albums as $album) {
            $this->album->destroy($album);
        }

        $this->category->destroy($category);

        return redirect()->route('admin.gallery.category.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('gallery::categories.title.categories')]));
    }
}
