<?php

namespace Modules\Gallery\Repositories\Eloquent;

use Modules\Gallery\Events\CategoryWasCreated;
use Modules\Gallery\Events\CategoryWasDeleted;
use Modules\Gallery\Events\CategoryWasUpdated;
use Modules\Gallery\Repositories\CategoryRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCategoryRepository extends EloquentBaseRepository implements CategoryRepository
{
    public function create($data)
    {
        $model = $this->model->create($data);

        event(new CategoryWasCreated($model, $data));

        return $model;
    }

    public function update($model, $data)
    {
        $model->update($data);

        event(new CategoryWasUpdated($model, $data));
    }

    public function destroy($model)
    {
        event(new CategoryWasDeleted($model->id, get_class($model)));

        return $model->delete();
    }

}
