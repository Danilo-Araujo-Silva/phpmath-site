<?php
require_once "config/bootstrap.php";

use Backend\Controller;
use Backend\Model;
use Backend\View;

$mathematica = new Model\Mathematica\Mathematica;
$configure = $mathematica->configure();

$twig = new View\Twig\Twig;
$data = array(
    "controller" => RELATIVE_CONTROLLER,
    "css" => RELATIVE_CSS,
    "javascript" => RELATIVE_JAVASCRIPT,
    "image" => RELATIVE_IMAGE,
    "configurationResult" => $configure,
);
$content = $twig->render("phpmath/index.html", $data);
echo $content;