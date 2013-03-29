<?php
namespace Backend\View\Twig;

class Twig extends \Twig_Environment
{
    private $templateDir;  
    public $twig;

    public function __construct()
    {
        $this->templateDir = TEMPLATE_PATH;
        $loader = new \Twig_Loader_Filesystem($this->templateDir);
        $this->twig = new \Twig_Environment($loader);
    }
    
    public function render($template, $dados)
    {
        return $this->twig->render($template, $dados);
    }
}