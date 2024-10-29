<?php

namespace App\Dto\Query;

interface ToSkipTake
{
    public function toSkipTake(): SkipTake;
}