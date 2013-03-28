<?php
namespace lib\vendor\phpmath\Twig\Twig;

class Twig
{
    private $templateDir = TEMPLATE_PATH;
    
    private $twig;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem($this->templateDir);
        $this->twig = new Twig_Environment($loader);
    }
}