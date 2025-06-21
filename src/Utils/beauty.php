<?php

use Beauty\Element\Element;
use Beauty\Element\ElementInterface;
use Beauty\Helpers\ElementWrapper;

if (!function_exists('element')) {
    function element (string $tag, bool $closingTag = false) : ElementInterface
    {
        return new Element($tag, $closingTag);
    }
}

if (!function_exists('wrapper')) {
    function wrapper (string $tag = 'div') : ElementWrapper
    {
        return new ElementWrapper($tag);
    }
}