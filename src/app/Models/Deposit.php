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

/**
 * Class Deposit
 *
 * This class represents a Deposit model and implements the IsFilterable interface.
 * It is located at /var/www/html/app/Models/Deposit.php.
 * 
 * PLEASE MOTE: amount is specified in cents as integer type.
 *
 * @package App\Models
 */
class Deposit extends Model implements IsFilterable
{
    /** @use HasFactory<\Database\Factories\DepositFactory> */
    use HasFactory, Notifiable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * PLEASE MOTE: amount is specified in cents as integer type.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'player_id',
        'amount'
    ];

    public function allowedFilters(): AllowedFilterList
    {
        return Filter::only(
            Filter::field('player_id', [FilterType::EQUAL, FilterType::IN, FilterType::NOT_IN]),
            Filter::field('amount', [FilterType::GREATER_THAN_EQUAL_TO, FilterType::LESS_THAN_EQUAL_TO]),
            Filter::field('created_at', [FilterType::GREATER_THAN_EQUAL_TO, FilterType::LESS_THAN_EQUAL_TO]),
            Filter::relation('player', [FilterType::HAS],
            Filter::only(
                Filter::field('name', [FilterType::LIKE])
                )
            )
        );
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * Get the formatted amount attribute.
     *
     * This method formats the amount attribute by dividing it by 100 and 
     * formatting it to six decimal places. If the amount is null or zero, 
     * it returns "0.00".
     *
     * @return string The formatted amount.
     */
    public function getFormattedAmountAttribute(): string
    {
        if ($this->amount == null || $this->amount == 0) {
            return "0.00";
        }
        return number_format($this->amount / 100, 2);
    }
}
