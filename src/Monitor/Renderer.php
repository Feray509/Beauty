<?php

namespace Beauty\Monitor;

use Exception;
use InvalidArgumentException;

class Renderer
{
    private static $paths = [];
    private static $globals = [];

    public static function root (string $namespace, string $directory)
    {
        self::$paths[$namespace] = $directory;
    }

    public static function global (string $name, mixed $value)
    {
        self::$globals[$name] = $value;
    }

    public static function render(string $file, array $params = [])
    {
        $mark = strpos($file, "@");

        if (strpos($file, ".php") === false) {
            $file .= ".php";
        }

        if ($mark === 0) {
            $endOfNamespace = strpos($file, "/", $mark + 1);

            if ($endOfNamespace === false) {
                throw new Exception("Invalid namespace format in $file");
            }

            $namespace = substr($file, $mark + 1, $endOfNamespace - $mark - 1);

            if (!array_key_exists($namespace, self::$paths)) {
                throw new Exception("No namespace found for $namespace");
            }

            $filePath = self::$paths[$namespace] . substr($file, $endOfNamespace);

            if (!file_exists($filePath)) {
                throw new Exception("File not found: $filePath");
            }

            return buffer($filePath, array_merge(self::$globals, $params));
        }

        if (file_exists($file)) {
            return buffer($file, array_merge(self::$globals, $params));
        }

        return "";
    }

}