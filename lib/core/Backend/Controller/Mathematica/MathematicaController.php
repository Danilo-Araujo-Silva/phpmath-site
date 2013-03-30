<?php
namespace Backend\Controller\Mathematica;

use Backend\Model\Mathematica\Mathematica;

class MathematicaController extends \Backend\Controller\Core\MainController
{    
    public function __construct( $data)
    {
        $command = $data["command"];
        
        $mathematica = new Mathematica();
        if ($mathematica->test()) {
            $result = $mathematica->run($command);
        } else {
            $result = "PHPMath isn't correctly configured yet.";
        }
        
        $this->result = $result;
        
        return true;
    }
}