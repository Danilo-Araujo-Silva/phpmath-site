<?php
namespace Backend\Controller\Mathematica;

require_once dirname(__FILE__).'/../../../../../config/includder.php';
require_once VENDOR.'autoload.php';
use Backend\Model\Mathematica\Mathematica;
use Backend\View\Twig\Twig;

$data = $_POST;
$command = $_POST["command"];

$mathematica = new Mathematica();
if ($mathematica->test()) {
    $result = $mathematica->run($command);
} else {
    $result = "PHPMath isn't correctly configured yet.";
}

echo $result;