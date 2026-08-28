<?php

namespace App\Core;

use PDO;
use PDOStatement;

/**
 * DB connector class
 * 
 * @author bdoobd
 * @created (c) 2026
 */
class DBC
{
    // private string $db_host;
    // private string $db_name;
    // private string $db_port;
    // private string $db_charset;
    // private string $db_user;
    // private string $db_pwd;
    protected PDO $pdo;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};port={$_ENV['DB_PORT']};charset={$_ENV['DB_CHARSET']}";
        $this->pdo = new PDO($dsn,  $_ENV['DB_USER'], $_ENV['DB_PWD']);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    /**
     * Создание подготовленного запроса
     * 
     * @param string $sql SQL строка запроса
     * 
     * @return bool|PDOStatement
     */
    public function prepare(string $sql): bool|PDOStatement
    {
        return $this->pdo->prepare($sql);
    }
    /**
     * Подотовка и запуск запроса без placeholder
     * Использовать только в выборке без передачи внешних параметров
     * 
     * @param string $sql SQL сторка запроса
     * 
     * @return bool|PDOStatement
     */
    public function query(string $sql): bool|PDOStatement
    {
        return $this->pdo->query($sql);
    }
}
