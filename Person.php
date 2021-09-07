<?php


// Basic class
class Person{
    protected int $age;
    protected string $name;

    function __construct() {
        $this->age = 0;
        $this->name = "None";
    }

    function inputPerson()
    {
        echo "Age: ";
        $this->age = setNumber();
        echo "Name: ";
        $this->name = readline();
    }
    function printPerson()
    {
        echo "Age: " . $this->age . "\n";
        echo "Name: " . $this->name . "\n";
    }

    function writeFilePerson($dataName)
    {
        fwrite($dataName, $this->name. " ". $this->age. " ");
    }

}