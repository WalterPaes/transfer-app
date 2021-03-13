<?php

namespace App\Infra\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

class CapsuleConnection
{
    public static function getConnection()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'db_transfers',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $capsule->setAsGlobal();
    }
}