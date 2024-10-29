<?php

namespace App\Dto\Query;

class SkipTake implements ToSkipTake
{
    public readonly int $skip;
    public readonly int $take;

    public function __construct(?int $skip = 0, ?int $take = 20)
    {
        $this->skip = $skip ?? 0;
        $this->take = $take ?? 20;
    }

    public function toSkipTake(): SkipTake
    {
        return $this;
    }
}