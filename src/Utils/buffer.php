<?php

if (!function_exists('buffer')) {
    function buffer(string $file, array $params = [])
    {
        if (!file_exists($file) || !is_readable($file)) {
            throw new InvalidArgumentException("No readable file found for $file");
        }

        ob_start();
        extract($params);
        require $file;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}