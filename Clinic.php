<?php
const START_COUNT_ELEMENTS = 0;

class Clinic
{
    /**
     * @var Patient[]
     * @var Doctor[]
     */

    private array $listPatients = [];
    private array $listDoctors = [];
    private int $countPatient;
    private int $countDoctor;

    public function __construct(Patient $newPatient, Doctor $newDoctor)
    {
        $this->listPatients[] = $newPatient;
        $this->countPatient = START_COUNT_ELEMENTS;
        $this->listDoctors[] = $newDoctor;
        $this->countDoctor = START_COUNT_ELEMENTS;
    }

    function inputListPatient() {
        echo "Count of patients: ";
        $this->countPatient = readline();
        for ($i = 0; $i < $this->countPatient; $i++) {
            echo"-------------------------";
            echo "\nInput patient №". ($i+1). "\n";
            $newPatient = new Patient;
            $newPatient->inputElement();
            $this->listPatients[$i] = $newPatient;
        }
    }

    function inputListDoctor() {
        echo "Count of doctors: ";
        $this->countDoctor = readline();
        for ($i = 0; $i < $this->countDoctor; $i++) {
            echo"-------------------------";
            echo "\nInput doctor №". ($i+1). "\n";
            $newDoctor = new Doctor;
            $newDoctor->inputElement();
            $this->listDoctors[$i] = $newDoctor;
        }
    }

    function printListPatient() {
        echo"-------------------------";
        echo"\nInfo about patients\n";
        for ($i = 0; $i < $this->countPatient; $i++) {
            echo"-------------------------";
            echo"\nPatient №". ($i+1). "\n";
            $this->listPatients[$i]->printElement();
        }
    }

    function printListDoctor() {
        echo"-------------------------";
        echo"\nInfo about doctors\n";
        for ($i = 0; $i < $this->countDoctor; $i++)
        {
            echo"-------------------------";
            echo "\nDoctor №". ($i+1). "\n";
            $this->listDoctors[$i]->printElement();
        }
    }
}