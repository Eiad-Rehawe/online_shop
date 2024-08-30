<?php 

class User {
    private $id;
    private $firstname;
    private $lastname;
    private $birthdate;
    private $email;
    private $password;

    public function __construct($id, $firstname, $lastname, $birthdate, $email, $password) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->birthdate = $birthdate;
        $this->email = $email;
        $this->password = $password;
    }

    // getter 
    public function getId(){
        return $this->id;
    }
    public function getFirstname(){
        return $this->firstname;
    }
    public function getLastname(){
        return $this->lastname;
    }
    public function getBirthdate(){
        return $this->birthdate;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }

    // setter
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }
    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }
    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setPassword($password) {
        $this->password = $password;
    }

}