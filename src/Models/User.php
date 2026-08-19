<?php  

namespace App\Models;

class User {
    public int $id = 0;
    public string $username = '';
    public string $password_hash = '';
    public string $created;
    public datetime $modified;
    public int $role_id = 0;

    public static function table_name(): string {
        return 'users';
    }
}