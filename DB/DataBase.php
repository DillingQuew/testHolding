<?php
namespace DB\DataBase;

use PDO;

class DataBase extends PDO {
    static protected $host = '127.0.0.1';
    static protected $db   = 'Employees';
    static protected $user = 'root';
    static protected $pass = '';
    static protected $charset = 'utf8';

    static function DB() {
        $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false];

        return $pdo = new PDO($dsn, self::$user, self::$pass, $opt);
    }

}