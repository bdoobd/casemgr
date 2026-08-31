<?php

namespace App\Core;

use Exception;
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

    public static function findAll(): array
    {
        $table = static::tableName();

        $sql = "SELECT * FROM {$table} ORDER BY id ASC";
        return self::query($sql)->fetchAll();
    }

    public static function findOne(array $filter)
    {
        $table = static::tableName();

        $attrs = array_keys($filter);
        foreach ($attrs as $attr) {
            if (!property_exists(static::class, $attr)) {
                throw new Exception('Property not found');
            }
        }

        $clause = implode(' AND ', array_map(fn($item) => "$item = :$item", $attrs));

        $sql = "SELECT * FROM {$table} WHERE {$clause}";

        return $sql;
    }
}
