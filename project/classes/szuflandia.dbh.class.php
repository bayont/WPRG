<?php

class Dbh
{
    private $host = "127.0.0.1";
    private $port = 3306;
    private $user = "s29606";
    private $pwd = "Fab.Fett";
    private $dbName = "s29606";
    protected function connect()
    {
        $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
