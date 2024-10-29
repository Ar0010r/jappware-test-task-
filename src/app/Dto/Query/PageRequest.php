<?php

namespace App\Dto\Query;

class PageRequest implements ToSkipTake
{
    public readonly int $page;
    public readonly int $perPage;

    public function __construct(?int $page = 1, ?int $perPage = 20)
    {
        $this->page = $page ?? 1;
        $this->perPage = $perPage ?? 20;
    }

    public function toSkipTake(): SkipTake
    {
        return new SkipTake(($this->page - 1) * $this->perPage, $this->perPage);
    }
}