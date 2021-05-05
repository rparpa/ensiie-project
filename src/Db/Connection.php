<?php

namespace Db;

use PDO;

class Connection
{
    private static ?PDO $pdo;

    public static function get(): PDO {
        if (!isset(self::$pdo)) {
            //postgres
            $dbName = getenv('DB_NAME');
            $dbUser = getenv('DB_USER');
            $dbPassword = getenv('DB_PASSWORD');

            self::$pdo = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
        }

        return self::$pdo;
    }
}
