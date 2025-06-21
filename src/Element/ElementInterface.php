<?php

namespace Beauty\Element;

interface ElementInterface
{
    public function withAttribute (string $name, string|int|null $value = null) : self;

    public function attributes (array $attributes): void;

    public function withContent (string $content, bool $secure = true): self;

    public function __toString() : string;
}