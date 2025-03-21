<?php

use PhpParser\Node\VariadicPlaceholder;
use Ramsey\Uuid\Type\Integer;
class Employee{
    private $id;
    private $employeeId;
    private $name;
    private $email;
    private $position;
    private $department;
    private $phone;
    private $address;
    private $profilePicture;

    //--------------------Getter-------------------//
    public function getEmployeeId(): int{
        return $this->employeeId;
    }
    public function getName(): string{
        return $this->name;
    }
    public function getPhone(): int{
        return $this->phone;
    }
    public function getEmail(): string{
        return $this->email;
    }
    public function getPositon(): string{
        return $this->position;
    }
    public function getDepartment(): string{
        return $this->department;
    }
    public function getAddres(): string{
        return $this->address;
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
