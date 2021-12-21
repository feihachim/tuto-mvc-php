<?php

namespace OpenClassrooms\Blog\Model;

class Manager
{
    protected function dbConnect()
    {
        $dbHost = "localhost";
        $dbName = "test";
        $dbUser = "root";
        $dbPassword = "";
        $dbCharset = 'utf8';
        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=$dbCharset";
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $pdo = new \PDO($dsn, $dbUser, $dbPassword, $options);
        return $pdo;
    }
}
