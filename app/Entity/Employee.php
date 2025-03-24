<?php

use PhpParser\Node\VariadicPlaceholder;
use Ramsey\Uuid\Type\Integer;
use App\Enum\EmployementStatus;

class Employee{
    private $id;
    private $username;
    private $password;
    private $employeeId;
    private $employeeName;
    private $dateOfBirth;
    private $employeePhone;
    private $employeeAddress;
    private $employeeEmail;
    private $profilePicture;
    private $position;
    private $department;
    private $hireDate;
    private $terminationDate;


    //--------------Constructor--------------------//
    public function __construct($employeeId, $username, $password, $employeeName, $dateOfBirth, $employeePhone, $employeeEmail, $profilePicture, $position, $departement, $hireDate, $terminationDate){
        $this->employeeId = $employeeId;
        $this->username = $username;
        $this->password = $password;
        $this->employeeName = $employeeName;
        $this->dateOfBirth = $dateOfBirth;
        $this->employeePhone = $employeePhone;
        $this->employeeEmail = $employeeEmail;
        $this->profilePicture = $profilePicture;
        $this->position = $position;
        $this->department = $departement;
        $this->hireDate = $hireDate;
        $this->terminationDate = $terminationDate;
    }

    public function calculateAgeOfPerson(){

    }



    //--------------------Getter-------------------//
    public function getEmployeeId(): int{
        return $this->employeeId;
    }
    public function getName(): string{
        return $this->employeeName;
    }
    public function getPhone(): int{
        return $this->employeePhone;
    }
    public function getEmail(): string{
        return $this->employeeEmail;
    }
    public function getPositon(): string{
        return $this->position;
    }
    public function getDepartment(): string{
        return $this->department;
    }
    public function getAddres(): string{
        return $this->employeeAddress;
    }
    public function getProfilePicture(): string{
        return $this->profilePicture;
    }

    //---------------------Setter---------------------//
    public function setEmployeeId(int $employeeId): void{
        $this->employeeId = $employeeId;
    }
    public function setName(string $name): void{
        $this->name = $name;
    }
    public function setPhone(int $phone): void{
        $this->phone = $phone;
    }
    public function setEmail(string $email): void{
        $this->email = $email;
    }
    public function setPosition(string $position): void{
        $this->position = $position;
    }
    public function setDepartment(string $departement): void{
        $this->department = $departement;
    }
    public function setAddres(string $address): void{
        $this->address = $address;
    }
    public function setProfPic(string $profilePicture): void{
        $this->profilePicture = $profilePicture;
    }
}
?>
