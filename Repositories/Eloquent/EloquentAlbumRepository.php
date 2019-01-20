<?php

namespace Modules\Gallery\Repositories\Eloquent;

use Modules\Gallery\Events\AlbumWasCreated;
use Modules\Gallery\Events\AlbumWasDeleted;
use Modules\Gallery\Events\AlbumWasUpdated;
use Modules\Gallery\Repositories\AlbumRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentAlbumRepository extends EloquentBaseRepository implements AlbumRepository
{
    public function create($data)
    {
        $model = $this->model->create($data);

        event(new AlbumWasCreated($model, $data));

        return $model;
    }

    public function update($model, $data)
    {
        $model->update($data);

        event(new AlbumWasUpdated($model, $data));

        return $model;
    }

    public function destroy($model)
    {
        event(new AlbumWasDeleted($model->id, get_class($model)));

        return $model->delete();
    }

    public function paginate($perPage = 15)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with(['translations', 'category'])->active()->orderBy('created_at', 'DESC')->paginate($perPage);
        }

        return $this->model->orderBy('created_at', 'DESC')->active()->paginate($perPage);
    }

    public function latest($amount = 6)
    {
        return $this->model->whereStatus(1)->orderBy('created_at', 'desc')->with(['translations', 'category'])->take($amount)->get();
    }
}
