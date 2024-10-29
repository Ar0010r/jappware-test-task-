<?php

namespace App\Commands\Abstract;

use App\Services\Abstract\IDataWriter;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Data;

abstract class CreateCommand
{
    protected IDataWriter $service;

    /**
     * Executes the command to create a new model.
     *
     * @param Data $data The data used to create the model.
     * @return Model The created model.
     */
    public function execute(Data $data): Model
    {
        $model = $this->service->make($data->toArray());
        $this->service->store($model);

        return $model;
    }
}