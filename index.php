<?php
require_once 'config/includder.php';
require_once VENDOR.'autoload.php';

use Backend\Model\Mathematica\Mathematica as Model;
use Backend\View\Twig\Twig as View;
use Backend\Controller\Mathematica\Mathematica as Controller;

$mathematica = new Model;
$configure = $mathematica->configure();

$twig = new View;
$data = array(
    "controller" => RELATIVE_CONTROLLER,
    "css" => RELATIVE_CSS,
    "javascript" => RELATIVE_JAVASCRIPT,
    "image" => RELATIVE_IMAGE,
    "configurationResult" => $configure,
);
$content = $twig->render("phpmath/index.html", $data);
echo $content;