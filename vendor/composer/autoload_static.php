<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb281cab353c6fb61e41a8c0fdc8ab766
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'App\\Controller\\UserController' => __DIR__ . '/../..' . '/app/Controller/UserController.php',
        'App\\Model\\Database' => __DIR__ . '/../..' . '/app/Model/Database.php',
        'App\\Model\\User' => __DIR__ . '/../..' . '/app/Model/User.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb281cab353c6fb61e41a8c0fdc8ab766::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb281cab353c6fb61e41a8c0fdc8ab766::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb281cab353c6fb61e41a8c0fdc8ab766::$classMap;

        }, null, ClassLoader::class);
    }
}
