<?php

class userProfile
{

    private $bio;
    private $picture;
    public function __construct($bio, $picture)
    {
        $this->bio = $bio;
        $this->picture = $picture;
    }
    /*---------------------------Getters-----------------------------*/

    public function getBio() {
        return $this->bio;
    }
    public function getPicture() {
        return $this->picture;
    }
}