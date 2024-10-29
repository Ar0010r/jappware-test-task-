<?php

namespace App\Dto\Query;

class DataRequest implements IDataRequest
{
    public readonly ?array $select;
    public readonly PageRequest|SkipTake $amount;
    public readonly ?OrderBy $orderBy;
    public readonly ?array $filters;
    public readonly ?string $searchTerm;

    public function __construct(PageRequest|SkipTake $amount, ?OrderBy $orderBy = null, ?array $filters = null, ?array $select = null, ?string $searchTerm = null)
    {
        $this->amount = $amount;
        $this->orderBy = $orderBy;
        $this->filters = $filters;
        $this->select = $select;
        $this->searchTerm = $searchTerm;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getOrderBy(): ?OrderBy
    {
        return $this->orderBy;
    }

    public function getPageRequest(): PageRequest|SkipTake
    {
        return $this->amount;
    }

    public function getSearchTerm(): ?string
    {
        return $this->searchTerm;
    }
    
}