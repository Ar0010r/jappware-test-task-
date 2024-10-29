<?php

namespace App\Services\Deposit;

use Illuminate\Database\Eloquent\Builder;

trait SearchHandler
{
    public function handleSearch(string $term, Builder $query):void
    {
        $query->whereHas('player', function (Builder $query) use ($term) {
            $query->where('name', 'ilike', "%$term%")
                ->orWhere('email', 'ilike', "%$term%")
                ->orWhere('phone', 'ilike', "%$term%");
        });
       
    }
}