<?php

namespace App\Services\Deposit;

use App\Models\Deposit;
use App\Services\Abstract\DataReader;
use App\Services\Abstract\IDataReader;


interface IDepositReader extends IDataReader
{

}

class DepositReader extends DataReader implements IDepositReader
{
    use SearchHandler;

    public function __construct()
    {
        parent::__construct(new Deposit());
    }
}