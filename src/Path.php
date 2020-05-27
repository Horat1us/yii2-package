<?php

namespace Horat1us\Yii\Package;

/**
 * Class Path
 * @package Horat1us\Yii\Package
 */
class Path
{
    private static string $root;

    public static function root(): string
    {
        if (isset(static::$root)) {
            return static::$root;
        }
        foreach ([dirname(__DIR__), dirname(__DIR__, 4)] as $root) {
            if (is_dir($root . DIRECTORY_SEPARATOR . 'vendor')) {
                return static::$root = $root;
            }
        }
        throw new \RuntimeException("Unable to detect root.");
    }

    /**
     * @param string[]|string $parts
     * @param string|null $root
     * @return string
     */
    public static function join($parts, string $root = null): string
    {
        $pieces = [$root ?? static::root()];
        array_push($pieces, ...(array)$parts);
        return join(DIRECTORY_SEPARATOR, $pieces);
    }

    public static function src(...$args)
    {
        return static::join(["src", ...$args]);
    }

    public static function vendor(...$args)
    {
        return static::join(["vendor", ...$args]);
    }

    public static function bootstrap(): string
    {
        return static::join("bootstrap", dirname(__DIR__, 1));
    }
}
