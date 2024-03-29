<?php

namespace catira\Util;

use PDO;

class Conexao {

    private static $instancia;

    private function __construct() {
        
    }

    public static function getInstancia() {
        if (self::$instancia)
            return self::$instancia;
        $dsn = 'mysql:host=localhost;dbname=catira';
        $username = 'root';
        $password = '170895';
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
        ];

        self::$instancia = new PDO($dsn, $username, $password, $options);
        return self::$instancia;
    }

}
