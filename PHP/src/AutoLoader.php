<?php

spl_autoload_register(function ($class) {

    $path = __DIR__ . '\\..' . '\\database\\' . lcfirst($class . '.php');
    if (file_exists($path)) {
        include $path;
    }
    $path = __DIR__ . '\\' . lcfirst($class . '.php');
    if (file_exists($path)) {
        include $path;
    }
    $path = __DIR__ . '\\..' . '\\database\\repositories\\' . lcfirst($class . '.php');
    if (file_exists($path)) {
        include $path;
    }
    $path = __DIR__ . '\\..' . '\\database\\controllers\\' . lcfirst($class . '.php');
    if (file_exists($path)) {
        include $path;
    }
    $path = __DIR__ . '\\..' . '\\database\\models\\' . lcfirst($class . '.php');
    if (file_exists($path)) {
        include $path;
    }
    $path = __DIR__ . '\\..' . '\\database\\middleware\\' . lcfirst($class . '.php');
    if (file_exists($path)) {
        include $path;
    }
});
