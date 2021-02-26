<?php

class Database
{
    private static $dbHost = "localhost";
    private static $dbName = 'burger_code';
    private static $userName = 'root';
    private static $pass = '';
    private static $connection = null;

    public static function connect()
    {
        try {
            self::$connection = new PDO('mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName, self::$userName, self::$pass);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return self::$connection;
    }

    public static function disconnect()
    {
        self::$connection = null;
    }
}
