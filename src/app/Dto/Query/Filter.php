<?php

namespace App\Dto\Query;
use IndexZer0\EloquentFiltering\Filter\FilterType;

class Filter
{
    public readonly string $target;
    public readonly FilterType $type;
    public readonly mixed $value;

    public function __construct(string $target, FilterType $operator, mixed $value)
    {
        $this->target = $target;
        $this->type = $operator;
        $this->value = $value;
    }

    public function toArray(): array
    {
        $value = $this->value;

        if (is_array($value) && !empty($value) && $value[0] instanceof Filter) {
            $value = array_map(fn($filter) => $filter->toArray(), $value);
        }
        return [
            'target' => $this->target,
            'type' => $this->type->value,
            'value' => $value
        ];
    }
}