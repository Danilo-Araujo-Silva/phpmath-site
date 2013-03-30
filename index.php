<?php
require_once 'config/includder.php';
require_once VENDOR.'autoload.php';

use Backend\Model\Mathematica\Mathematica;
use Backend\View\Twig\Twig;

$twig = new Twig;
$data = array();
$content = $twig->render("phpmath/index.html", $data);
echo $content;

$mathematica = new Mathematica;
$mathematica->configure();

echo "Fibonacci[200] = <pre>"; print_r($mathematica->run("Fibonacci[200]")); echo "</pre>";