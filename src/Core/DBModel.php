<?php

namespace App\Core;

use PDOStatement;

class DBModel
{
    public static function query(string $sql): PDOStatement
    {
        return App::$app->db->query($sql);
    }

    public static function prepare(string $sql): PDOStatement
    {
        return App::$app->db->prepare($sql);
    }
}
