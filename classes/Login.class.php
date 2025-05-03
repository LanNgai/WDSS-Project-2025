<?php

class Login
{
    private $loginID;
    private $username;
    private $email;
    private $password;

    function __construct($loginID, $username, $email, $password)
    {
        $this->loginID = $loginID;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function getLoginID()
    {
        return $this->loginID;
    }
    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
}