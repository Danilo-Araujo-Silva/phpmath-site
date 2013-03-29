<?php
namespace Backend\Model\Mathematica;

use Backend\View\Twig\Twig;
use Backend\Model\Erro\Erro;

class Mathematica
{
    private $catch;
    private $twig;
    
    public function getCatch()
    {
        if (empty($this->catch)) {
            $this->catch = new Erro;
        }
        
        return $this->catch;
    }
    
    public function getTwig()
    {
        if (empty($this->twig)) {
            $this->twig = new Twig;
        }
        
        return $this->twig;
    }
    
    public function configure()
    {
        if (
            !file_exists(MATHEMATICA_EXECUTAVEL)
            || filesize(MATHEMATICA_EXECUTAVEL) == 0
        ) {
            try {
                $dados = array(
                    'caminhoMathematicaScript' => MATHEMATICA_SCRIPT_PATH,
                );
                $conteudo = $this->getTwig()->render('mathematica/shell.html', $dados);
                $script = fopen(MATHEMATICA_EXECUTAVEL, "w+");
                fwrite($script, $conteudo);
                fclose($script);
                echo "Arquivo executável do Mathematica criado com sucesso.";
                
                return true;
            } catch (Exception $excecao) {
                $this->getCatch($excecao);
                
                return false;
            }
        }
        
        return true;
    }
    
    public function run($comando)
    {
        try {
            
        } catch (Exception $excecao) {
            $this->getCatch($excecao);
        }
    }
}