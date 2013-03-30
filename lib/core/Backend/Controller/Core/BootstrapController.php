<?php
namespace Backend\Controller\Core;

require_once $_SERVER["DOCUMENT_ROOT"]."/config/bootstrap.php";

$request = $_REQUEST;
$controller = "Backend\\Controller\\".$request["controller"];
$data = $request["data"];

$response = new $controller($data);

echo $response->output();
