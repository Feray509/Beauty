<?php

use Beauty\Element\Element;
use PHPUnit\Framework\TestCase;

class ElementTest extends TestCase
{
    public function testSimpleTag ()
    {
        $expected = "<div class='test phpunit beauty' id='phpunit' hidden>test on php8.3.6</div>";
        $element = new Element('div', false);
        $element
        ->withAttribute('class', 'test phpunit beauty')
        ->withAttribute('id', 'phpunit')
        ->withAttribute('hidden')
        ->withContent('test on php8.3.6');
        $this->assertEquals($expected, $element->__toString());
    }

    public function testClosingTag ()
    {
        $expected = "<input name='test' type='password' value='escaping values'  />";
        $input = new Element('input', true);
        $input
        ->withAttribute('name', 'test')
        ->withAttribute('type', 'password')
        ->withAttribute('value', 'escaping values')
        ->withContent("Test if content will display on closing element");

        $this->assertEquals($expected, $input->__toString());
    }
}