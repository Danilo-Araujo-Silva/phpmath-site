<?php
register_shutdown_function('errorHandler');

function errorHandler() { 
    $erro = error_get_last();
    $tipo = $erro['type'];
    $mensagem = $erro['message'];
    if ($tipo = 64 && !empty($mensagem)) {
        echo "
            <strong>
              <font color=\"red\">
              Último erro capturado:
              </font>
            </strong>
        ";
        echo "<pre>";
        print_r($erro);
        echo "</pre>";
    }
}

$includes = array(
    'constant/server.php',
    'constant/core.php',
    'constant/database.php',
    'constant/template.php',
    'constant/vendor.php',
    'constant/mathematica.php',
    'constant/log.php'
);

foreach ($includes as $include) {
    require_once "$include";
}

unset($includes);