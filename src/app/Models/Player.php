<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use IndexZer0\EloquentFiltering\Contracts\IsFilterable;
use IndexZer0\EloquentFiltering\Filter\Contracts\AllowedFilterList;
use IndexZer0\EloquentFiltering\Filter\Filterable\Filter;
use IndexZer0\EloquentFiltering\Filter\FilterType;
use IndexZer0\EloquentFiltering\Filter\Traits\Filterable;

class Player extends Model implements IsFilterable
{
    /** @use HasFactory<\Database\Factories\PlayerFactory> */
    use HasFactory, Notifiable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone'
    ];

    public function allowedFilters(): AllowedFilterList
    {
        return Filter::only(
            Filter::field('name', [FilterType::EQUAL, FilterType::LIKE]),
            Filter::field('email', [FilterType::EQUAL, FilterType::LIKE]),
            Filter::field('phone', [FilterType::EQUAL, FilterType::LIKE]),
        );
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
}
