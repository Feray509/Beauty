<?php

//  TESTING MONITOR CLASSES;

use Beauty\Monitor\Renderer;
use Beauty\Monitor\Template;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . 'autoload.php';

Renderer::root("test", __DIR__ . DIRECTORY_SEPARATOR . "monitors_views_test/");
Renderer::global("oneGlobal", "Global param test live server");
echo Renderer::render("@test/test_layout", ['name' => "Jhon Doe"]);

$template = new Template();
$template
->withContent(element('p')->withContent('test template class'))
->pageTitle('Template tester');

echo $template;