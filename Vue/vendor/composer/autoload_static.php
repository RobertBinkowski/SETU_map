<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9c2b1d0a966d026886a67d9c20574a77
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Test\\DevCoder\\' => 14,
        ),
        'D' => 
        array (
            'DevCoder\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Test\\DevCoder\\' => 
        array (
            0 => __DIR__ . '/..' . '/devcoder-xyz/php-dotenv/tests',
        ),
        'DevCoder\\' => 
        array (
            0 => __DIR__ . '/..' . '/devcoder-xyz/php-dotenv/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9c2b1d0a966d026886a67d9c20574a77::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9c2b1d0a966d026886a67d9c20574a77::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9c2b1d0a966d026886a67d9c20574a77::$classMap;

        }, null, ClassLoader::class);
    }
}