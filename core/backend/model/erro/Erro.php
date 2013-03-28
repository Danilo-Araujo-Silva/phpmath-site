<?php
namespace model\erro;

class Erro
{
    public function __construct($excecao)
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