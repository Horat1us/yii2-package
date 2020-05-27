<?php

namespace Horat1us\Yii\Package;

use Dotenv\Dotenv;

/**
 * Class Env
 * @package Horat1us\Yii\Package
 */
class Env
{
    public static function init(): void
    {
        $env = Path::join(".env");
        if (file_exists($env)) {
            return;
        }
        $example = Path::join(".env.example");
        if (file_exists($example)) {
            copy($example, $env);
        }
    }

    public static function load(): void
    {
        $dotenv = Dotenv::createImmutable(Path::root());
        $dotenv->load();
    }
}
