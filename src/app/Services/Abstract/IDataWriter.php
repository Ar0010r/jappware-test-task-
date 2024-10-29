<?php

namespace App\Services\Abstract;

use Illuminate\Database\Eloquent\Model;

interface IDataWriter
{
    public function store(Model $model): bool;

    public function update(Model $model): bool;

    public function insert(array $data): bool;

    public function insertOrIgnore(array $data): bool;

    public function upsert(array $data, array $uniqueKeys): bool;

    public function make(array $data): Model;
}