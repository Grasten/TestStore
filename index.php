<?php
require 'bootstrap.php';

$path = $_GET['path'] ?? '';

$router = new \Framework\Router();
$action = $router->match($path);
$result = $action->execute();
$result->send();
