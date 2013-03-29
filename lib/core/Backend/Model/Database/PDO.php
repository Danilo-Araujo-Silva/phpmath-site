<?php
namespace Backend\Model\Database;

class PDO
{
    private $pdo;
    private $user;
    private $password;
    private $host;
    private $database;
    private $options;
    private $dsn;
    
    public function __construct()
    {
        $this->user = DATABASE_USER;
        $this->password = DATABASE_PASSWORD;
        $this->host = DATABASE_HOST;
        $this->database = DATABASE_DATABASE;
        $this->options = null;
        $this->dsn = 'mysql:host='.DATABASE_HOST.';dbname='.DATABASE_DATABASE;
    }
    
    public function getPDO()
    {
        if(!$this->pdo) {
            $this->pdo = new \PDO($this->dsn, $this->user, $this->password, $this->options);
        }
        
        return $this->pdo;
    }
}