<?php

namespace App\Commands\Abstract;

use App\Services\Abstract\IDataEraser;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Data;

abstract class DeleteCommand
{
    protected IDataEraser $service;

    /**
     * Executes the delete command for the given ID.
     *
     * @param int $id The ID of the entity to be deleted.
     * @return int The result of the delete operation.
     */
    public function execute(int $id): int
    {
        return $this->service
            ->filterId($id)
            ->delete();

    }
}