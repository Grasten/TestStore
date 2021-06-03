<?php


namespace Framework;


class Router
{
    public function match(string $path):ActionInterface
    {
        $parts = array_filter(explode('/', $path));

        $moduleName = ucfirst($parts[0] ?? 'index');
        $controllerName = ucfirst($parts[1] ?? 'index');
        $actionName = ucfirst($parts[2] ?? 'index');

        $className = "$moduleName\\Controller\\$controllerName\\$actionName";

        return new $className();
    }
}