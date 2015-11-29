<?php
// Here you can initialize variables that will be available to your tests
require_once "src/Alpha1_501st/CodeceptionDataSelector/SqlBuilder.php";
require_once "src/Alpha1_501st/CodeceptionDataSelector/DatabaseSelector.php";

include __DIR__.'/../../vendor/autoload.php'; // composer autoload

$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'debug' => true,
    'includePaths' => [__DIR__.'/../../src']
]);
