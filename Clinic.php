
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

    private function __construct(Patient $newPatient, Doctor $newDoctor)
    {
        $this->listPatients[] = $newPatient;
        $this->countPatient = START_COUNT_ELEMENTS;
        $this->listDoctors[] = $newDoctor;
        $this->countDoctor = START_COUNT_ELEMENTS;
    }

    private static $instance = null;
    public static function getInstance(Patient $newPatient, Doctor $newDoctor)
    {
        if (is_null(self::$instance))
            self::$instance = new self($newPatient, $newDoctor);
        return self::$instance;
    }

    function inputListPatient()
    {
        echo "Count of patients: ";
        $newCountPatient = setNumber();
        for ($i = $this->countPatient; $i < ($this->countPatient+$newCountPatient); $i++)
        {
            echo"-------------------------";
            echo "\nInput patient №". ($i+1). "\n";
            $newPatient = new Patient;
            $newPatient->inputElement();
            $this->listPatients[$i] = $newPatient;
        }
        $this->countPatient = $newCountPatient + $this->countPatient;
    }

    function inputListDoctor()
    {
        echo "Count of doctors: ";
        $newCountDoctor = setNumber();
        for ($i = $this->countDoctor; $i < ($newCountDoctor+$this->countDoctor); $i++)
        {
            echo"-------------------------";
            echo "\nInput doctor №". ($i+1). "\n";
            $newDoctor = new Doctor;
            $newDoctor->inputElement();
            $this->listDoctors[$i] = $newDoctor;
        }
        $this->countDoctor = $newCountDoctor + $this->countDoctor;
    }

    function printListPatient()
    {
        echo"-------------------------";
        echo"\nInfo about patients for ";
        echo date('r');
        echo"\n";
        for ($i = 0; $i < $this->countPatient; $i++)
        {
            echo"-------------------------";
            echo"\nPatient №". ($i+1). "\n";
            $this->listPatients[$i]->printElement();
        }
    }

    function printListDoctor()
    {
        echo"-------------------------";
        echo"\nInfo about doctors";
        echo date('r');
        echo"\n";
        for ($i = 0; $i < $this->countDoctor; $i++)
        {
            echo"-------------------------";
            echo "\nDoctor №". ($i+1). "\n";
            $this->listDoctors[$i]->printElement();
        }
    }
    function writingFile()
    {
        $dataPatient = fopen("listPatient.txt", "a");
        for ($i = 0; $i < $this->countPatient; $i++)
        {
            $this->listPatients[$i]->writeFilePerson($dataPatient);
            $this->listPatients[$i]->writeFileStatus($dataPatient);
            fwrite($dataPatient, "\n");
        }
        fclose($dataPatient);

        $dataDoctor = fopen("listDoctor.txt", "a");
        for ($i = 0; $i < $this->countDoctor; $i++)
        {
            $this->listDoctors[$i]->writeFilePerson($dataDoctor);
            $this->listDoctors[$i]->writeFileStatus($dataDoctor);
            fwrite($dataDoctor, "\n");
        }
        fclose($dataDoctor);
    }
}