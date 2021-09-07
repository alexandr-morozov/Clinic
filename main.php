<?php

spl_autoload_register(function ($className)
{
    include $className. '.php';
});

require('function.php');

function printMenu()
{
    echo "\n1. Add new patients\n";
    echo "2. Add new doctors\n";
    echo "3. Print info about all patients\n";
    echo "4. Print info about all doctors\n";
    echo "5. Exit\n";
    echo ">";
}

function menu($clinic)
{
    $chooseUser=0;
    while ($chooseUser != 5)
    {
        printMenu();
        $chooseUser = readline();
        switch($chooseUser)
        {
            case 1:
                $clinic -> inputListPAtient();
                break;
            case 2:
                $clinic -> inputListDoctor();
                break;
            case 3:
                $clinic -> printListPatient();
                break;
            case 4:
                $clinic -> printListDoctor();
                break;
        }
    }
    $clinic -> writingFile();

}

$factory = new Factory;
$clinic = $factory->build();
menu($clinic);
