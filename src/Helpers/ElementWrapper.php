<?php

namespace Beauty\Helpers;

use Beauty\Element\Element;
use Beauty\Element\ElementInterface;

class ElementWrapper
{
    private ElementInterface $wrapper;
    private string $tag;
    /** @var Beauty\Element\ElementInterface[] */
    private array $children = [];

    public function __construct(string $tag = "div")
    {
        $this->wrapper = new Element($tag, false);
        $this->tag = $tag;
    }

    public function attributes (array $attributes) : self
    {
        $this->wrapper->attributes($attributes);
        return $this;
    }

    public function withChild (ElementInterface $child, bool $lastChild = true) : self
    {
        if (!$lastChild) {
            $this->children = array_merge([$child], $this->children);
        } else {
            $this->children[] = $child;
        }

        return $this;
    }

    public function __toString(): string
    {
        $html = $this->wrapper->__toString();
        $end = "</" . $this->tag . ">";
        $targetEnd = mb_strpos($html, $end);
        return mb_substr($html, 0, $targetEnd) . implode("", $this->children) . $end;
    }
}