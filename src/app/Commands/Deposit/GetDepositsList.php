<?php

namespace App\Commands\Deposit;

use App\Commands\Abstract\ListCommand;
use App\Dto\Query\IDataRequest;
use App\Services\Deposit\IDepositReader;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class GetDepositsList
 *
 * This class extends the ListCommand class and is responsible for retrieving a list of deposits.
 *
 * @package App\Commands\Deposit
 */
class GetDepositsList extends ListCommand
{
    public function __construct(IDepositReader $reader)
    {
        parent::__construct($reader);
    }

    public function execute(IDataRequest $request): LengthAwarePaginator
    {
        $result = parent::execute($request);
        $result->load('player');

        return $result;
    }
}