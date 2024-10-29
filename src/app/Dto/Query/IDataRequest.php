<?php

namespace App\Dto\Query;

interface IDataRequest
{
    public function getSelect(): array;
    public function getFilters(): array;
    public function getOrderBy(): ?OrderBy;
    public function getPageRequest(): PageRequest|SkipTake;
    public function getSearchTerm(): ?string;
}