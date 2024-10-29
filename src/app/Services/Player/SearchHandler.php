<?php

namespace App\Services\Player;

use Illuminate\Database\Query\Builder;

trait SearchHandler
{
    public function handleSearch(string $term, Builder $query):void
    {
        $query->where('phone', 'ILIKE', "%{$term}%")
        ->orWhere('name', 'ILIKE', "%{$term}%")
        ->orWhere('email', 'ILIKE', "%{$term}%");
    }
}