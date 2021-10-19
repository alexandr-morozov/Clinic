<?php


function printMenu()
{
    echo "\n1. Add new patients\n";
    echo "2. Add new doctors\n";
    echo "3. Print info about all patients\n";
    echo "4. Print info about all doctors\n";
    echo "5. Print info about one patient\n";
    echo "6. Print info about one doctor\n";
    echo "7. Exit\n";
    echo ">";
}

function menu($clinic)
{
    $chooseUser=0;
    while ($chooseUser != 7)
    {
        printMenu();
        $chooseUser = setNumber();
        if ($chooseUser>7 or $chooseUser<1)
        {
            echo"Error input, try again: ";
        }
        switch($chooseUser)
        {
            case 1:
                $clinic -> inputListPatient();
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
            case 5:
                $clinic -> getInfoPatientByName();
                break;
            case 6:
                $clinic -> getInfoDoctorByName();
                break;
        }
    }
    $clinic -> writingFile();

}

function setNumber()
{
    $flag = false;
    while ($flag == false) {
        $number = readline();
        if (ctype_digit($number)) {
            $flag  = true;
            return $number;
        } else {
            echo "\nError Input, try again: \n";
        }
    }
}

function getInfoByName($listElements, $countElements)
{
    echo"Input name: ";
    $keyName = readline();
    $countEqual = 0;
    for ($i = 0; $i < $countElements; $i++)
    {
        if ($keyName == $listElements[$i]->name)
        {
            $countEqual++;
            $listElements[$i]->printElement();
        }
    }
    if ($countEqual == 0)
    {
        echo"Not found info by this name";
    }
}