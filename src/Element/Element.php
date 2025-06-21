<?php

namespace Beauty\Element;

class Element implements ElementInterface
{
    protected string $tag;
    protected bool $closingTag = false;
    private string $content = "";
    private array $attributes = [];
    private array $boolAttributes = [];

    public function __construct(string $tag, bool $closingTag)
    {
        $this->tag = $tag;
        $this->closingTag = $closingTag;
    }

    public function attributes (array $attributes) : void
    {
        foreach ($attributes as $name => $value) {
            if (is_numeric($name)) {
                $this->withAttribute($value);
            } else {
                $this->withAttribute($name, $value);
            }
        }
    }

    public function withAttribute(string $name, string|int|null $value = null): ElementInterface
    {
        if ($value === null) {
            $this->boolAttributes = array_merge($this->boolAttributes, [$name]);
        } else {
            $this->attributes[$name] = $value;
        }

        return $this;
    }

    public function withContent(string $content, bool $secure = true): ElementInterface
    {
        if ($secure) {
            $content = htmlspecialchars($content);
        }

        $this->content .= " $content";
        return $this;
    }

    private function writeAttributes(): string
    {
        $attributes = "";

        foreach ($this->attributes as $name => $value) {
            $attributes .= " $name='" . htmlspecialchars($value) . "'";
        }

        return $attributes . " " . implode(" ", $this->boolAttributes);
    }

    public function __toString(): string
    {
        $html = "<" . $this->tag . $this->writeAttributes();

        if ($this->closingTag) {
            return $html . " />";
        }

        $html = trim($html) . ">" . trim($this->content) . "</" . $this->tag . ">";
        return $html;
    }
}