<?php
namespace Backend\Controller\Core;

class MainController
{   
    protected $result;
    
    public function output ()
    {
        $result = $this->result;
        echo $result;
    }
}