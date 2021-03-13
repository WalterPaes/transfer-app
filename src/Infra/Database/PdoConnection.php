<?php

namespace App\Infra\Database;

use PDO;
use PDOException;

class PdoConnection
{
    private static $pdo;

    private function __construct()
    {
    }

    public static function getConnection()
    {
        if (!isset(self::$pdo)) {
            try {
                $dbHost = $_ENV['DB_HOST'];
                $dbName = $_ENV['DB_NAME'];
                $dbUser = $_ENV['DB_USER'];
                $dbPass = $_ENV['DB_PASS'];

                self::$pdo = new PDO("mysql:host={$dbHost}; dbname={$dbName}; charset=utf8;", $dbUser, $dbPass, [
                    PDO::ATTR_PERSISTENT => true
                ]);
            } catch (PDOException $ex) {
                echo "Erro: " . $ex->getMessage();
            }
        }
        return self::$pdo;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}