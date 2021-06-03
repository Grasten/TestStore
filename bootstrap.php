<?php
// enables reporting of all errors
error_reporting(E_ALL);

spl_autoload_register(function ($name) {
    require str_replace('\\', '/', "$name.php");
});

session_start();
define('BP', __DIR__);
