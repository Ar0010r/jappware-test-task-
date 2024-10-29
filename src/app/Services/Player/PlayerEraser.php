<?php

namespace App\Services\Player;

use App\Models\Player;
use App\Services\Abstract\DataEraser;
use App\Services\Abstract\IDataEraser;

interface IPlayerEraser extends IDataEraser
{
   
}

class PlayerEraser extends DataEraser implements IPlayerEraser
{
    use SearchHandler;

    public function __construct()
    {
        parent::__construct(new Player());
    }
}