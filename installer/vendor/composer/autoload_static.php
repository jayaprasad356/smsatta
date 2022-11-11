<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit568587a7ec15d6a486df37d897e26488
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Thamaraiselvam\\MysqlImport\\' => 27,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Thamaraiselvam\\MysqlImport\\' => 
        array (
            0 => __DIR__ . '/..' . '/thamaraiselvam/mysql-import',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit568587a7ec15d6a486df37d897e26488::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit568587a7ec15d6a486df37d897e26488::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
