<?php
namespace Backend\Model\Erro;

class Erro
{
    private $excecao;
    
    public function __construct($excecao=null)
    {
        echo "
            <strong>
                <font color=\"red\">
                    Foi capturada a seguinte exceção:
                </font>
            </strong>
            <pre>
        ";
        print_r($excecao);
        echo "
            </pre>
        ";
    }
}