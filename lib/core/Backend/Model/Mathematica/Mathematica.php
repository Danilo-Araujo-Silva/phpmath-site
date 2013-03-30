<?php
namespace Backend\Model\Mathematica;

use Backend\View\Twig\Twig;
use Backend\Model\Error\Error;

class Mathematica
{
    private $catch = null;
    private $twig = null;
    private $error = null;
    private $message = "";
    
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
        if ($this->message = $this->test()) {
            return $this->message;
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
                $this->message .= "<br>Mathematica executable was created sucessfully.<br>";
                if ($this->test()) {
                    $this->message .= "<br>Calculations with Mathematica are working.<br>";
                } else {
                    $this->message .= "
                        <br>
                        The test calculation send the Mathematica failed.
                        <br>
                    ";
                     $this->message .= $this->getCatch($this->error);
                        
                     return $this->message;
                }
                
                return $this->message;
            } catch (Exception $exception) {
                $this->message .= $this->getCatch($exception);
                
                return $this->message;
            }
        }
        
        return $this->message;
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
        $call = "'Zeta[2]'";
        $correctAnswer =
"Pi^2/6
";
        $result = $this->run($call);
        $notFoundLicense = "Mathematica cannot find a valid password";
        
        if ($result === $correctAnswer) {
            $this->message .= "Correct: $call = $correctAnswer";
            
            return $this->message;
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