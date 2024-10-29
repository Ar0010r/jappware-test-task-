<?php

namespace App\Services\Abstract;

use Illuminate\Database\Eloquent\Model;

abstract class DataWriter implements IDataWriter
{
    public readonly Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function store(Model $model): bool
    {
        return $model->saveOrFail();
    }

    public function update(Model $model): bool
    {
        if (empty($model->getOriginal())) {
            $freshValues = $model->getAttributes();
            $model->exists = true;
            $model->refresh()->fill($freshValues);
        }

        return $model->updateOrFail();
    }

    public function insert(array $data): bool
    {
        return $this->model::insert($data);
    }

    public function insertOrIgnore(array $data): bool
    {
        return $this->model::insertOrIgnore($data);
    }

    public function upsert(array $data, array $uniqueKeys): bool
    {
        return $this->model::upsert($data, $uniqueKeys);
    }

    public function make(array $data): Model
    {
        return $this->model::make($data);
    }
}