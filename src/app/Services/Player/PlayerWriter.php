<?php

namespace App\Services\Player;

use App\Models\Player;
use App\Services\Abstract\DataWriter;
use App\Services\Abstract\IDataWriter;

interface IPlayerWriter extends IDataWriter
{
    
}

class PlayerWriter extends DataWriter implements IPlayerWriter
{
    public function __construct()
    {
        parent::__construct(new Player());
    }
}