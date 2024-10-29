<?php

namespace App\Services\Deposit;

use App\Models\Deposit;
use App\Services\Abstract\DataEraser;
use App\Services\Abstract\IDataEraser;

interface IDepositEraser extends IDataEraser
{
   
}

class DepositEraser extends DataEraser implements IDepositEraser
{
    use SearchHandler;

    public function __construct()
    {
        parent::__construct(new Deposit());
    }
}