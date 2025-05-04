<?php
//This is the User class which inherits from the Login class.
include_once "Login.class.php";
class User extends Login
{
    private $profile;
 public function __construct($loginID, $username, $email, $password, $profile)
 {
     parent::__construct($loginID, $username, $email, $password);
     $this->profile = $profile;
 }


 public function setProfile($bio, $picture)
 {
    $this->profile = new userProfile($bio, $picture);
 }

 public function getProfile()
 {
     return $this->profile;
 }

}