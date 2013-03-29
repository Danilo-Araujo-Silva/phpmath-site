<?php
if (!empty($_SERVER["DOCUMENT_ROOT"])) {
    define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/");
} else {
    define("ROOT", getcwd()."/");
}