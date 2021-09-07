<?php
class Doctor extends Person
{
    private string $speciality;

    function __construct()
    {
        parent::__construct();
        $this->speciality = "None";
    }

    function inputElement()
    {
        parent::inputPerson();
        echo "Speciality: ";
        $this->speciality = readline();
    }

    function printElement()
    {
        parent::printPerson();
        echo "Speciality: " . $this->speciality . "\n";
    }

    function writeFileStatus($dataName)
    {
        fwrite($dataName, $this->speciality. " ");
    }
}