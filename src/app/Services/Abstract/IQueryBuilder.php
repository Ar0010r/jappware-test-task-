<?php

namespace App\Services\Abstract;

use Illuminate\Database\Eloquent\Builder as DatabaseQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface IQueryBuilder
{
    public function setQuery(Builder $query): self;
    public function filterId(int $id): self;
    public function filterIds(array $ids): self;
    public function filter(array|Collection $filters): self;
    public function search(?string $term): self;
    public function handleSearch(string $term, DatabaseQueryBuilder $builder): void;
}