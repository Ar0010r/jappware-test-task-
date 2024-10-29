<?php

namespace App\Http\Request\Deposit;

use App\Dto\Query\Filter;
use App\Http\Request\Abstract\ListRequest;
use IndexZer0\EloquentFiltering\Filter\FilterType;


class GetDepositRequest extends ListRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'ids' => 'nullable|integer',
            'player_ids' => 'nullable|string',
            'player_name' => 'nullable|string',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date',
            'amount_from' => 'nullable|int',
            'amount_to' => 'nullable|int',
        ];

        return array_merge(parent::rules(), $rules);
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing(['date_from' => now()->subWeek()->startOfDay()->format('Y-m-d H:i')]);
        $this->mergeIfMissing(['date_to' => now()->addDay()->startOfDay()->format('Y-m-d H:i')]);
    }



    public function getFilters(): array
    {
        $filters = [];

        if ($ids = $this->validated('ids')) {
            $filters[] = new Filter('id', FilterType::IN, $ids);
        }

        if ($playerIds = $this->validated('player_ids')) {
            $playerIds = explode(',', $playerIds);
            $playerIds = array_map('intval', $playerIds);
            $playerIds = array_filter($playerIds, function ($id) {
                return $id > 0;
            });
            $filters[] = new Filter('player_id', FilterType::IN, $playerIds);
        }

        if ($name = $this->validated('player_name')) {
            $nameFilter = new Filter('name', FilterType::LIKE, $name);
            $filters[] = new Filter('player', FilterType::HAS, [$nameFilter]);
        }

        if ($dateFrom = $this->validated('date_from')) {
            $filters[] = new Filter('created_at', FilterType::GREATER_THAN_EQUAL_TO, $dateFrom);
        }

        if ($dateTo = $this->validated('date_to')) {
            $filters[] = new Filter('created_at', FilterType::LESS_THAN_EQUAL_TO, $dateTo);
        }

        if ($amount = $this->validated('amount_from')) {
            $filters[] = new Filter('amount', FilterType::GREATER_THAN_EQUAL_TO, $amount * 100);
        }

        if ($amount = $this->validated('amount_to')) {
            $filters[] = new Filter('amount', FilterType::LESS_THAN_EQUAL_TO, $amount * 100);
        }

        return $filters;
    }
}