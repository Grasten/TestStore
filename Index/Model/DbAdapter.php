<?php

namespace Index\Model;

class DbAdapter
{
    private static $pdo;

    public static function getPDO():\PDO
    {
        if (null === self::$pdo) {
            $config = require BP . '/etc/env.php';
            $dsn = "mysql:dbname={$config['db']['dbname']};host={$config['db']['host']}";
            self::$pdo = new \PDO($dsn, $config['db']['username'], $config['db']['password']);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE,  \PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }
}