<?php

namespace Beauty\Monitor;

use Beauty\Element\ElementInterface;

class Template
{
    private array $stylesheets = [];
    private array $scripts = [];
    private array $customParams = [];
    private ?ElementInterface $title = null;
    private array $content = [];
    private ?string $layout = null;

    public function __construct(?string $base = null)
    {
        if (file_exists($base)) {
            $this->layout = $base;
        }
    }

    public function pageTitle (string $title)
    {
        $this->title = element('title')->withContent($title);
        return $this;
    }

    public function withStyle (string $css, array $attributes = [])
    {
        if (strpos($css, ".css") === false) {
            $css .= ".css";
        }

        $css = element('link', true)
        ->withAttribute('type', 'text/css')
        ->withAttribute('href', $css)
        ->attributes($attributes);

        $this->stylesheets[] = $css;
        return $this;
    }

    public function withContent (string|ElementInterface $content)
    {
        $this->content[] = $content;
        return $this;
    }

    public function withScript (string $js, array $attributes = [])
    {

        if (strpos($js, ".js") === false) {
            $js .= ".js";
        }

        $js = element('script')
        ->withAttribute('type', 'text/javascript')
        ->withAttribute('src', $js)
        ->attributes($attributes);

        $this->scripts[] = $js;
        return $this;
    }

    public function assign (string $name, mixed $value)
    {
        $this->customParams[$name] = $value;
        return $this;
    }

    public function __toString()
    {
        $params = [
            "layoutParams" => [
                "customParams" => $this->customParams,
                "stylesheets" => $this->stylesheets,
                "scripts" => $this->scripts,
                "pageTitle" => $this->title,
                "layoutBody" => $this->content
            ]
        ];

        if ($this->layout === null) {
            $default = dirname(__DIR__) . DIRECTORY_SEPARATOR . "Utils" . DIRECTORY_SEPARATOR . "base.php";
            return buffer($default, $params);
        }

        return buffer($this->layout, $params);
    }
}