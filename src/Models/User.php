<?php

namespace App\Models;

use App\Core\DBModel;
use DateTimeImmutable;

class User extends DBModel
{
    public ?int $id;
    public string $username = '';
    public string $password_hash = '';
    public ?DateTimeImmutable $created;
    public ?DateTimeImmutable $modified;
    // TODO: Хотелось бы по умолчанию сделать значение user
    public int $role_id = 0;

    public static function tableName(): string
    {
        return 'users';
    }

    public static function fetchAllUsersWithRile()
    {
        $table = self::tableName();

        $sql = 'SELECT u.*, r.role FROM 
                users as u JOIN
                roles as r ON 
                u.role_id = r.id';

        return self::query($sql)->fetchAll();
    }
}
