<?php

namespace App\Services\Abstract;

interface IDataEraser extends IQueryBuilder
{
     public function delete(): int;
}

abstract class DataEraser extends QueryBuilder implements IDataEraser
{
    public function delete(): int
    {
        return $this->query->delete();
    }
}