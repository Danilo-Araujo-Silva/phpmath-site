<?php
namespace Backend\Model\Mathematica;

use Backend\View\Twig\Twig;
use Backend\Model\Erro\Erro;

class Mathematica
{
    private $catch;
    private $twig;
    private $error;
    
    public function getCatch($exception)
    {
        if (empty($this->catch)) {
            $this->catch = new Error($exception);
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
            echo "<br>Mathematica is working perfectly.<br>";
            return true;
        } else {
            try {
                $data = array(
                    'MathematicaScriptPath' => MATHEMATICA_SCRIPT_PATH,
                );
                $content = $this->getTwig()->render('mathematica/shell.html', $data);
                $script = fopen(MATHEMATICA_EXECUTAVEL, "w+");
                fwrite($script, $content);
                
                /*
                 * 0755 permission means:
                 * PHP user can read, write and execute;
                 * PHP group can read and execute;
                 * others can read and execute.
                 */
                chmod(MATHEMATICA_EXECUTAVEL, 0755);
                fclose($script);
                echo "<br>Mathematica executable was created sucessfully.<br>";
                if ($this->test()) {
                    echo "<br>Calculations with Mathematica are working.<br>";
                } else {
                    echo "
                        <br>
                        The test calculation send the Mathematica failed.
                        <br>
                    ";
                     $this->getCatch($this->error);
                        
                     return false;
                }
                
                return true;
            } catch (Exception $exception) {
                $this->getCatch($exception);
                
                return false;
            }
        }
        
        return true;
    }
    
    public function run($call)
    {
        try {
            $completeCall = MATHEMATICA_EXECUTAVEL." '$call'";
            $return = shell_exec($completeCall);
            
            return $return;
        } catch (Exception $exception) {
            $this->getCatch($exception);
            
            return false;
        }
    }
    
    public function test()
    {
        $result = $this->run("Zeta[2]");
        $correctAnswer =
"Pi^2/6
";
        $notFoundLicense = "Mathematica cannot find a valid password";
        
        if ($result === $correctAnswer) {
            return true;
        } elseif (strpos($result, $notFoundLicense)) {
            $this->error = "
                Was not possible the find the Mathematica license.
                <br>
                Copy the Mathematica license folder to the PHP user home
                (for example, /var/www/.Mathematica).
                <br>
                The Mathematica license usually can be found on a hidden folder
                at the licensed user home (for example, /home/user/.Mathematica).
                <br>
            ".$result;
            
            return false;
        } else {
            $this->error = $result;
            return false;
        }
    }
}