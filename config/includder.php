<?php

// Function to handler errors on shutdown.

//register_shutdown_function('errorHandler');

//function errorHandler() { 
//    $error = error_get_last();
//    $type = $erro['type'];
//    $message = $error['message'];
//    if ($type = 64 && !empty($message)) {
//        echo "
//            <strong>
//              <font color=\"red\">
//              Last error captured:
//              </font>
//            </strong>
//        ";
//        echo "<pre>";
//        print_r($error);
//        echo "</pre>";
//    }
//}

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