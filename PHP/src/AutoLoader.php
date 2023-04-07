<?php

spl_autoload_register(function ($class) {

    // Auto load paths
    $path = [
        // Include all database files
        __DIR__ . '\\' . lcfirst($class . '.php'),
        __DIR__ . '\\..' . '\\database\\' . lcfirst($class . '.php'),
        __DIR__ . '\\..' . '\\database\\models\\' . lcfirst($class . '.php'),
        __DIR__ . '\\..' . '\\database\\services\\' . lcfirst($class . '.php'),
        __DIR__ . '\\..' . '\\database\\repositories\\' . lcfirst($class . '.php'),
        __DIR__ . '\\..' . '\\database\\controllers\\' . lcfirst($class . '.php'),
        __DIR__ . '\\..' . '\\database\\middleware\\' . lcfirst($class . '.php'),
    ];

    // Include path files if file exists
    foreach ($path as $p) {
        if (file_exists($p)) {
            include $p;
        }
    }
});
