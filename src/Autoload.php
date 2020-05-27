<?php

namespace Horat1us\Yii\Package;

class Autoload
{
    public static function modify(): void
    {
        $autoloadPath = Path::vendor("autoload.php");
        $definePath = str_replace(dirname($autoloadPath), '', Path::bootstrap() . DIRECTORY_SEPARATOR . "define.php");

        $defineFilePath = str_replace("'", "\\'", $definePath);
        $autoloadPrefix = /** @lang PHP */
            "<?php require_once '$defineFilePath';";


        $autoloadPath = Path::vendor("autoload.php");
        $autoloadContent = file_get_contents($autoloadPath);
        $prefixedAutoload = str_replace(/** @lang PHP */ "<?php", $autoloadPrefix, $autoloadContent);
        file_put_contents($autoloadPath, $prefixedAutoload);
    }
}
