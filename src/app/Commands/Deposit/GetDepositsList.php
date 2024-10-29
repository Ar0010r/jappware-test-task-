<?php

namespace App\Commands\Deposit;

use App\Commands\Abstract\ListCommand;
use App\Services\Deposit\IDepositReader;

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
}