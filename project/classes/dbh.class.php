<?php

class Dbh
{
    private $host = "mysql";
    private $port = 3306;
    private $user = "root";
    private $pwd = "password";
    private $dbName = "quizconst";
    protected function connect()
    {
        $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
