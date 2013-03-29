<?php
namespace Backend\Model\Database;

use Backend\Model\Erro\Erro;

class Migration
{
    public $migration;
    private $mysqlCommandLine;
    private $log;
    
    public function __construct()
    {
        $this->migration = "";
        $this->mysqlCommandLine = "mysql ".DATABASE_DATABASE." < ";
        $this->log = " > ".LOG_MIGRATION;
    }
    
    public function run($migration)
    {
        $this->migration = $migration;
        try {
            echo shell_exec($this->mysqlCommandLine.$this->migration.$this->log);
        } catch (Exception $excecao) {
            
        }
    }
}