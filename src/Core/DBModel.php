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

        $stmt = self::prepare($sql);
        foreach ($filter as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        $stmt->execute();

        return $stmt->fetch();
    }

    public static function save(array $data)
    {
        $table = static::tableName();

        $fields = '';
        $palceholders = '';
        foreach ($data as $key => $value) {
            $fields .= "{$key},";
            $palceholders .= ":{$key},";
        }

        $fields = rtrim($fields, ',');
        $palceholders = rtrim($palceholders, ',');

        $sql = "INSERT INTO {$table}({$fields}) VALUES({$palceholders})";

        $stmt = self::prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo '<pre>';
            var_dump($e);
            echo '</pre>';
        }

        return true;
    }
}
