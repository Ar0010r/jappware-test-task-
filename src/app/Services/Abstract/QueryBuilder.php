<?php

namespace App\Services\Abstract;

use App\Dto\Query\Filter;
use Illuminate\Database\Eloquent\Builder as DatabaseQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use IndexZer0\EloquentFiltering\Contracts\IsFilterable;

abstract class QueryBuilder implements IQueryBuilder
{
    protected Builder $query;
    protected readonly IsFilterable $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->query = $model::query();
    }

    public function setQuery(Builder $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function filterId(int $id): self
    {
        $this->query->where('id', $id);

        return $this;       
    }

    public function filterIds(array $ids): self
    {
        $count = count($ids);
        $ids = collect($ids)->whereInstanceOf('int')->toArray();
        $count > 1 && $this->query->whereIn('id', $ids);
        $count === 1 && $this->query->where('id', $ids[0]);

        return $this;
    }

    public function filter(array|Collection $filters): self
    {
        $filters = $filters instanceof Collection ? $filters : collect($filters);
        $filters = $filters->whereInstanceOf(Filter::class);
        $filters = $filters ->map(fn (Filter $f) => $f->toArray());
        $allowed = $this->model->allowedFilters();

        $this->model->scopeFilter(
            $this->query,
            $filters->toArray(),
            $allowed
        );

        return $this;
    }

    function search(?string $term): self
    {
        if (!$term) {
            return $this;
        }
        
        $this->query->where(function (DatabaseQueryBuilder $query) use ($term) {
            $this->handleSearch($term, $query);
        });

        return $this;
    }

    abstract function handleSearch(string $term, DatabaseQueryBuilder $builder): void;
}