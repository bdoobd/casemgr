<?php

namespace App\Models;

use App\Core\DBModel;

class Home extends DBModel
{
    public static function tableName(): string
    {
        return 'home';
    }
}
