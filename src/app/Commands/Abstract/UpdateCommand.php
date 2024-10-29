<?php

namespace App\Commands\Abstract;

use App\Services\Abstract\DataWriter;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Data;

abstract class UpdateCommand
{
    protected DataWriter $service;

    /**
     * Executes the update command.
     *
     * This method fills the original model with the provided data and updates it using the service.
     *
     * @param Model $original The original model to be updated.
     * @param Data $data The data to update the model with.
     * @return Model The updated model.
     */
    public function execute(Model $original, Data $data): Model
    {
        $original->fill($data->toArray());
        $this->service->update($original);

        return $original;
    }
}