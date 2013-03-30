<?php
require_once 'config/includder.php';
require_once VENDOR.'autoload.php';

use Backend\Model\Mathematica\Mathematica;
use Backend\View\Twig\Twig;

$mathematica = new Mathematica;
$configure = $mathematica->configure();

$twig = new Twig;
$data = array(
    "controller" => RELATIVE_CONTROLLER,
    "configurationResult" => $configure,
);
$content = $twig->render("phpmath/index.html", $data);
echo $content;