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

    private function __clone()
    {
    }

    public static function getConnection()
    {
        if (!isset(self::$pdo)) {
            try {
                $dbHost = getenv('DB_HOST');
                $dbName = getenv('DB_NAME');
                $dbUser = getenv('DB_USER');
                $dbPass = getenv('DB_PASS');

                self::$pdo = new PDO("mysql:host={$dbHost}; dbname={$dbName}; charset=utf8;", $dbUser, $dbPass, [
                    PDO::ATTR_PERSISTENT => true
                ]);
            } catch (PDOException $ex) {
                echo "Erro: " . $ex->getMessage();
            }
        }
        return self::$pdo;
    }
}