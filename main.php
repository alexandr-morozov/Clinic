<?php

spl_autoload_register(function ($className)
{
    include $className. '.php';
});

require('function.php');

$factory = new Factory;
$clinic = $factory->build();
$clinic->readFile();
menu($clinic);