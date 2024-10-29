<?php

namespace App\Services\Abstract;

use App\Dto\Query\OrderBy;
use App\Dto\Query\PageRequest;
use App\Dto\Query\SkipTake;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Str;


abstract class DataReader extends QueryBuilder implements IDataReader
{
    public function orderBy(?OrderBy $request): self
    {
        $field = $request->field;
        if ($request === null || !$field) {
            return $this;
        }

        if (Str::contains($field, '.')) {
            $relation = Str::before($field, '.');
            $column = Str::after($field, '.');
            $tableName = $this->model->$relation()->getRelated()->getTable();
            $field = "$tableName.$column";
            $this->query->addSelect($field)->leftJoinRelation($relation);
        }

        $this->query->orderBy($field, $request->direction->value);

        return $this;
    }

    public function select(?array $data): self
    {
      
        $data = $data == [] ? ['*'] : $data;

        if ($data) {
            $this->query->select($data);
        }
       
        return $this;
    }

    public function batch(?SkipTake $request): LengthAwarePaginator
    {
       $perPage = $request->take;
       $page = $request->skip / $perPage + 1;

       $request = new PageRequest(
           page: $page,
           perPage: $perPage
       );

         return $this->paginate($request);
    }

    public function paginate(?PageRequest $request): LengthAwarePaginator
    {
        $request = $request ?? new PageRequest();

        return $this->query->paginate(
            perPage:$request->perPage, 
            page:$request->page
        );
    }

    public function get(PageRequest|SkipTake $request): LengthAwarePaginator
    {
        return $request instanceof PageRequest
            ? $this->paginate($request)
            : $this->batch($request);
    }

    public function first(): Null|Model
    {
        return $this->query->first();
    }

    public function firstOrFail(): Model
    {
        return $this->query->firstOrFail();
    }

    public function count(): int
    {
        return $this->query->count();
    }

    public function all(): Collection
    {
        return $this->query->get();
    }
}