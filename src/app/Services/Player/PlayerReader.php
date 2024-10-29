<?php

namespace App\Services\Player;

use App\Models\Player;
use App\Services\Abstract\DataReader;
use App\Services\Abstract\IDataReader;


interface IPlayerReader extends IDataReader
{

}

class PlayerReader extends DataReader implements IPlayerReader
{
    use SearchHandler;

    public function __construct()
    {
        parent::__construct(new Player());
    }
}