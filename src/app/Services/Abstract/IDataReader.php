<?php

namespace App\Services\Abstract;

use App\Dto\Query\OrderBy;
use App\Dto\Query\PageRequest;
use App\Dto\Query\SkipTake;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IDataReader extends IQueryBuilder
{
    public function orderBy(?OrderBy $request): self;
    public function select(?array $data): self;
    public function batch(?SkipTake $request): LengthAwarePaginator;
    public function paginate(?PageRequest $request): LengthAwarePaginator;
    public function get(PageRequest|SkipTake $request): LengthAwarePaginator;
    public function first(): Null|Model;
    public function firstOrFail(): Model;
    public function count(): int;
    public function all(): Collection;
}