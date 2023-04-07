<?php

spl_autoload_register(function ($class) {

    // Auto load paths
    $paths = [
        // Include all database files
        __DIR__ . '\\' . lcfirst($class . '.php'),
        __DIR__ . '\\..' . '\\database\\' . lcfirst($class . '.php'),
        __DIR__ . '\\..' . '\\database\\models\\' . lcfirst($class . '.php'),
        __DIR__ . '\\..' . '\\database\\services\\' . lcfirst($class . '.php'),
        __DIR__ . '\\..' . '\\database\\repositories\\' . lcfirst($class . '.php'),
        __DIR__ . '\\..' . '\\database\\controllers\\' . lcfirst($class . '.php'),
        __DIR__ . '\\..' . '\\database\\middleware\\' . lcfirst($class . '.php'),
    ];

    // Include paths files if file exists
    foreach ($paths as $path) {
        if (file_exists($path)) {
            include $path;
        }
    }
});
