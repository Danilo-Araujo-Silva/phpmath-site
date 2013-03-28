<?php
namespace lib\vendor\phpmath\Mathematica;

//use lib\vendor\phpmath\Twig\Twig;
//use lib\vendor\phpmath\Erro\Erro;

class Mathematica
{
    private $catch;
    
    public function getCatch()
    {
        if (empty($this->catch)) {
            $this->catch = new Erro;
        }
        
        return $this->catch;
    }
    
    public function configure()
    {
        if (!file_exists(MATHEMATICA_EXECUTAVEL)) {
            $dados = array(
                'caminhoMathematicaScript' => MATHEMATICA_SCRIPT_PATH,
            );
            $script = $this->twig->render('mathematica/shell.mathematica', $dados);
            fwrite(MATHEMATICA_EXECUTAVEL, $script);
        }
    }
    
    public function run($comando)
    {
        try {
            shell_exec(MATHEMATICA_EXECUTAVEL." $comando");
        } catch (Exception $excecao) {
            $this->getCatch($excecao);
        }
    }
}

?>
