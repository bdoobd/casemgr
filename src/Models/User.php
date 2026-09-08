<?php

namespace App\Models;

use App\Core\DBModel;
use DateTimeImmutable;

class User extends DBModel
{
    public int $id = 0;
    public string $username = '';
    public string $password_hash = '';
    public DateTimeImmutable $created;
    public ?DateTimeImmutable $modified;
    public int $role_id = 0;

    public static function tableName(): string
    {
        return 'users';
    }
}
