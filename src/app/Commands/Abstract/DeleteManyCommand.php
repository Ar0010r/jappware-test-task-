<?php

namespace App\Commands\Abstract;

use App\Services\Abstract\IDataEraser;
use Illuminate\Support\Collection;

abstract class DeleteManyCommand
{
    protected IDataEraser $service;

    /**
     * Execute the delete command for multiple IDs.
     *
     * @param array|Collection $ids The IDs to be deleted. Can be an array or a Collection.
     * @return int The number of records deleted.
     */
    public function execute(array|Collection $ids): int
    {
        $ids = $ids instanceof Collection ? $ids : collect($ids);
        $ids = $ids->whereInstanceOf('int')->toArray();

        return $this->service
            ->filterIds($ids)
            ->delete();
    }
}