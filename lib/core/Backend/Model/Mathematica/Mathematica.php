<?php
namespace Backend\Model\Mathematica;

use Backend\View\Twig\Twig;
use Backend\Model\Erro\Erro;

class Mathematica
{
    private $catch;
    private $twig;
    private $erro;
    
    public function getCatch($excecao)
    {
        if (empty($this->catch)) {
            $this->catch = new Erro($excecao);
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
        if ($this->test()) {
            return true;
        } else {
            try {
                $dados = array(
                    'caminhoMathematicaScript' => MATHEMATICA_SCRIPT_PATH,
                );
                $conteudo = $this->getTwig()->render('mathematica/shell.html', $dados);
                $script = fopen(MATHEMATICA_EXECUTAVEL, "w+");
                fwrite($script, $conteudo);               
                /*
                 * Permite o usuário ler, escrever e executar.
                 * Permite o grupo ler e executar.
                 * Permite os outros lerem e executarem.
                 */
                chmod(MATHEMATICA_EXECUTAVEL, 0755);
                fclose($script);
                echo "<br>O arquivo executável do Mathematica foi criado com sucesso.<br>";
                if ($this->test()) {
                    echo "<br>Cálculos usando o Mathematica estão funcionando.<br>";
                } else {
                    echo "
                        <br>
                        O cálculo de teste enviado ao Mathematica falhou.
                        <br>
                    ";
                     $this->getCatch($this->erro);
                        
                     return false;
                }
                
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
            $chamadaCompleta = MATHEMATICA_EXECUTAVEL." '$comando'";
            $retorno = shell_exec($chamadaCompleta);
            
            return $retorno;
        } catch (Exception $excecao) {
            $this->getCatch($excecao);
            
            return false;
        }
    }
    
    public function test()
    {
        $resultado = $this->run("Zeta[2]");
        
        if ($resultado == "Pi^2/6") {
            return true;
        } else {
            $this->erro = $resultado;
            return false;
        }
    }
}