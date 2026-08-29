<?php

namespace App\Core;

use PDOStatement;

abstract class DBModel
{
    abstract public static function tableName(): string;
    public static function query(string $sql): PDOStatement
    {
        return App::$app->db->query($sql);
    }

    public static function prepare(string $sql): PDOStatement
    {
        return App::$app->db->prepare($sql);
    }

    public static function findAll(): array {
        $table = static::tableName();

        $sql = "SELECT * FROM {$table} ORDER BY id ASC";
        return self::query($sql)->fetchAll();
    }
    
}
