<?php

namespace App\Models;

use App\Core\DBModel;

class Role extends DBModel
{
    public int $id;
    public string $role;

    public static function tableName(): string
    {
        return 'roles';
    }
}
