<?php
namespace Backend\Model\Database;

class PDO
{
    private $pdo;
    private $user;
    private $password;
    private $host;
    private $database;
    private $sgbd;
    private $dsn;
    private $options;
    
    public function __construct()
    {
        $this->user = DATABASE_USER;
        $this->password = DATABASE_PASSWORD;
        $this->host = DATABASE_HOST;
        $this->database = DATABASE_DATABASE;
        $this->sgbd = DATABASE_SGBD;
        $this->dsn = "{$this->sgbd}:host={$this->host};dbname={$this->database}";
        $this->options = null;
    }
    
    public function getPDO()
    {
        if(!$this->pdo) {
            $this->pdo = new \PDO($this->dsn, $this->user, $this->password, $this->options);
        }
        
        return $this->pdo;
    }
}