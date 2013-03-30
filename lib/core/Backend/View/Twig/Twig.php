<?php
namespace Backend\View\Twig;

class Twig extends \Twig_Environment
{
    private $templateDir;  

    public function __construct(Twig_LoaderInterface $loader = null, $options = array())
    {
        $this->templateDir = TEMPLATE_PATH;
        $loader = new \Twig_Loader_Filesystem($this->templateDir);
        parent::__construct($loader);
    }
}