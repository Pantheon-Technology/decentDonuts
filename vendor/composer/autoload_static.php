<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6b243a07f548a2a8d7cd281ac675a121
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6b243a07f548a2a8d7cd281ac675a121::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6b243a07f548a2a8d7cd281ac675a121::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6b243a07f548a2a8d7cd281ac675a121::$classMap;

        }, null, ClassLoader::class);
    }
}
