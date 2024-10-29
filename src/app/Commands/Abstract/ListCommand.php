<?php

namespace App\Commands\Abstract;

use App\Dto\Query\IDataRequest;
use App\Services\Abstract\IDataReader;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class ListCommand
{
    protected IDataReader $service;
    
    public function __construct(IDataReader $service)
    {
        $this->service = $service;
    }

    /**
     * Executes the list command with the provided data request.
     *
     * @param IDataRequest $request The data request containing select, filters, search term, order by, and page request.
     * @return LengthAwarePaginator The paginated result set.
     */
    public function execute(IDataRequest $request): LengthAwarePaginator
    {
        return $this->service
            ->select($request->getSelect())
            ->filter($request->getFilters())
            ->search($request->getSearchTerm())
            ->orderBy($request->getOrderBy())
            ->get($request->getPageRequest());
    }
}