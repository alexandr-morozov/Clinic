<?php

class Patient extends Person
{
    private string $illness;

    function __construct()
    {
        parent::__construct();
        $this->illness = "None";
    }

    function inputElement()
    {
        parent::inputPerson();
        echo "Illness: ";
        $this->illness = readline();
    }

    function printElement()
    {
        parent::printPerson();
        echo "Illness: " . $this->illness . "\n";
    }

    function writeFileStatus($dataName)
    {
        fwrite($dataName, $this->illness. " ");
    }

}