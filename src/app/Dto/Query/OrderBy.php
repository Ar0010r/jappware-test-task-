<?php

namespace App\Dto\Query;

use App\Dto\Query\OrderDirection;

class OrderBy
{
    public readonly string $field;
    public readonly OrderDirection $direction;

    public function __construct(?string $field = 'id', ?OrderDirection $direction = OrderDirection::ASC)
    {
        $this->field = match (is_null($field)) {
            true => 'id',
            false => empty($field) ? 'id' : $field
        };

        $this->direction = $direction ?? OrderDirection::ASC;
    }
}