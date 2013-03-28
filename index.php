<?php
require_once 'config/includder.php';
require_once VENDOR.'autoload.php';

$twig = new \View\Engine\Engine();
//$twig = new \core\Twig\Twig();
echo "<pre>"; var_dump($twig); echo "<pre>";
$twig->c("<h1>Meu amor... eu te amo pucutchuka -)</h1>");

$teste = new \Teste\Teste();
var_dump($teste);
echo VENDOR;