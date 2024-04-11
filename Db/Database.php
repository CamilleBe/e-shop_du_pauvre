<?php

namespace Db;

use PDO;
use PDOException;

class Database extends PDO
{
    private static $instance;

    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPWD = 'root';
    private const DBNAME = 'demo_sql';

    private function __construct()
    {
        $dsn = "mysql:dbname=" . self::DBNAME . ";host=" . self::DBHOST;

        try {
            parent::__construct($dsn, self::DBUSER, self::DBPWD);

            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    public function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database;
        }
        return self::$instance;
    }
}