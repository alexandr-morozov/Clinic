
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
        echo"\nInfo about doctors for ";
        echo date('r');
        echo"\n";
        for ($i = 0; $i < $this->countDoctor; $i++)
        {
            echo"-------------------------";
            echo "\nDoctor №". ($i+1). "\n";
            $this->listDoctors[$i]->printElement();
        }
    }

    function getInfoPatientByName()
    {
        getInfoByName($this->listPatients, $this->countPatient);
    }

    function getInfoDoctorByName()
    {
        getInfoByName($this->listDoctors, $this->countDoctor);
    }

    function writingFile()
    {
        $dataPatient = fopen("listPatient.txt", "a");
        $oldFilePatient = file("listPatient.txt");
        $oldCountPatient = count($oldFilePatient);
        if ($oldCountPatient != $this->countPatient)
        {
            if($oldCountPatient != 0)         ///Check for first entry
            {
                fwrite($dataPatient, "\n");
            }
            for ($i = $oldCountPatient; $i < $this->countPatient - 1; $i++) {
                $this->listPatients[$i]->writeFilePerson($dataPatient);
                $this->listPatients[$i]->writeFileStatus($dataPatient);
                fwrite($dataPatient, "\n");
            }
            $this->listPatients[$this->countPatient - 1]->writeFilePerson($dataPatient);
            $this->listPatients[$this->countPatient - 1]->writeFileStatus($dataPatient);     // write last element without "\n"
        }
        fclose($dataPatient);

        $dataDoctor = fopen("listDoctor.txt", "a");
        $oldFileDoctor = file("listDoctor.txt");
        $oldCountDoctor = count($oldFileDoctor);
        if ($oldCountDoctor != $this->countDoctor)
        {
            if ($oldCountDoctor != 0)         ///Check for first entry
            {
                fwrite($dataDoctor, "\n");
            }
            for ($i = $oldCountDoctor; $i < $this->countDoctor - 1; $i++)
            {
                $this->listDoctors[$i]->writeFilePerson($dataDoctor);
                $this->listDoctors[$i]->writeFileStatus($dataDoctor);
                fwrite($dataDoctor, "\n");
            }
            $this->listDoctors[$this->countDoctor - 1]->writeFilePerson($dataDoctor);
            $this->listDoctors[$this->countDoctor - 1]->writeFileStatus($dataDoctor);
        }
        fclose($dataDoctor);
    }

    function readFile()
    {
        if (!file_exists("listPatient.txt"))
        {
            echo "Data of patients is empty\n";
        } else {
            $dataPatient = fopen("listPatient.txt", "r");
            $this->countPatient = START_COUNT_ELEMENTS;
            while (!feof($dataPatient)) {
                $this->listPatients[$this->countPatient] = new Patient;
                $getFilePatient = fgets($dataPatient);
                $getFilePatient = explode(" ", $getFilePatient);
                $this->listPatients[$this->countPatient]->readFilePerson($getFilePatient[0], $getFilePatient[1]);
                $this->listPatients[$this->countPatient]->readFileStatus($getFilePatient[2]);
                $this->countPatient++;
            }
        }
        if (!file_exists("listDoctor.txt"))
        {
            echo "\nData of doctors is empty";
        } else {
            $dataDoctor = fopen("listDoctor.txt", "r");
            $this->countDoctor = START_COUNT_ELEMENTS;
            while (!feof($dataDoctor)) {
                $this->listDoctors[$this->countDoctor] = new Doctor;
                $getFileDoctor = fgets($dataDoctor);
                $getFileDoctor = explode(" ", $getFileDoctor);
                $this->listDoctors[$this->countDoctor]->readFilePerson($getFileDoctor[0], $getFileDoctor[1]);
                $this->listDoctors[$this->countDoctor]->readFileStatus($getFileDoctor[2]);
                $this->countDoctor++;
            }
        }
    }
}
