<?php
namespace Backend\View\Twig;

class Twig extends \Twig_Environment
{
    private $templateDir;  

    public function __construct(Twig_LoaderInterface $loader = null, $options = array())
    {
        $this->templateDir = TEMPLATE_PATH;
        $loader = new \Twig_Loader_Filesystem($this->templateDir);
        
        /*
         * To allow this object to bring the method render (among others), 
         *  without middlemen, the construct of the original class had to be 
         *  copied below. Was necessary put '\' in the instantiation of other 
         *  objects needed.
         */
        
        if (null !== $loader) {
            $this->setLoader($loader);
        }

        $options = array_merge(array(
            'debug'               => false,
            'charset'             => 'UTF-8',
            'base_template_class' => 'Twig_Template',
            'strict_variables'    => false,
            'autoescape'          => 'html',
            'cache'               => false,
            'auto_reload'         => null,
            'optimizations'       => -1,
        ), $options);

        $this->debug              = (bool) $options['debug'];
        $this->charset            = $options['charset'];
        $this->baseTemplateClass  = $options['base_template_class'];
        $this->autoReload         = null === $options['auto_reload'] ? $this->debug : (bool) $options['auto_reload'];
        $this->strictVariables    = (bool) $options['strict_variables'];
        $this->runtimeInitialized = false;
        $this->setCache($options['cache']);
        $this->functionCallbacks = array();
        $this->filterCallbacks = array();

        $this->addExtension(new \Twig_Extension_Core());
        $this->addExtension(new \Twig_Extension_Escaper($options['autoescape']));
        $this->addExtension(new \Twig_Extension_Optimizer($options['optimizations']));
        $this->extensionInitialized = false;
        $this->staging = new \Twig_Extension_Staging();
    }
}