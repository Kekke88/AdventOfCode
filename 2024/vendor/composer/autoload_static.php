<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita8efd98a83e170931531fa997f60b2c0
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kekke\\2024\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kekke\\2024\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita8efd98a83e170931531fa997f60b2c0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita8efd98a83e170931531fa997f60b2c0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita8efd98a83e170931531fa997f60b2c0::$classMap;

        }, null, ClassLoader::class);
    }
}
