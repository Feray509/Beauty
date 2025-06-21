<?php

use Beauty\Element\Element;
use Beauty\Helpers\ElementWrapper;
use PHPUnit\Framework\TestCase;

class ElementWrapperTest extends TestCase
{
    public function testWrap ()
    {
        $wrapper = new ElementWrapper();
        $input = new Element('input', false);
        $input->withAttribute('name', 'test-wrapper');
        $paragraph = new Element('p', false);
        $paragraph->withContent("Snd child");
        $wrapper
        ->withChild($input)
        ->withChild($paragraph, false)
        ->attributes(['hidden', 'class' => "field-group"]);
        $expected = "<div class='field-group' hidden>" . $paragraph->__toString() . $input->__toString() . "</div>";
        $this->assertEquals($expected, $wrapper->__toString());
    }
}