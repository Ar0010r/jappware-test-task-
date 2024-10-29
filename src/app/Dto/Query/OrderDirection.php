<?php

namespace App\Dto\Query;

enum OrderDirection: string
{
    case ASC = 'asc';
    case DESC = 'desc';
}