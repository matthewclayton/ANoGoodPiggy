<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/13/2016
 * Time: 8:50 PM
 */

class Usernames
{

    protected $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    //does the username exist
    public function getUsernameExists()
    {

    }

    //is the username valid
    public function isUsernameValid()
    {
        
    }

    //is it at least 3 characters long
    protected function isValidLength()
    {

    }

    //does it contain only numbers and letters
    protected function isValidCharacters()
    {

    }
}