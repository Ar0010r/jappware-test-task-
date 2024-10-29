<?php

namespace App\Services\Deposit;

use App\Models\Deposit;
use App\Services\Abstract\DataWriter;
use App\Services\Abstract\IDataWriter;

interface IDepositWriter extends IDataWriter
{
    
}

class DepositWriter extends DataWriter implements IDepositWriter
{
    public function __construct()
    {
        parent::__construct(new Deposit());
    }
}