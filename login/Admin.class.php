<?php
include_once "Login.class.php";
class Admin extends Login
{
    public $adminLoginID;
    private $reviews = array();
    public function __construct($loginID, $username, $email, $password){
        parent::__construct($loginID, $username, $email, $password);
        $this->adminLoginID = $loginID;
    }

    public function setReviews($reviews){
        $this->reviews = $reviews;
    }

    public function getReviews()
    {
        return $this->reviews;
    }

}