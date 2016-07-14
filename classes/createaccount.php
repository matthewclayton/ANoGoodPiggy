<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/13/2016
 * Time: 8:30 PM
 */

class CreateAccount
{

    protected $database;

    protected $username;

    protected $password;

    protected $email;

    public function __construct(Database $database, $username, $password, $email)
    {
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
        $this->email    = $email;
    }

    public function isNewUserValid()
    {
        if ($this->username->getUsernameExists() === true) {
            throw new Exception('That username already exists');
        }
        if ($this->username->isUsernameValid() === false) {
            throw new Exception('Usernames must be at least 3 characters long consisting of only numbers and letters');
        }
        if ($this->password->isMatching() === false) {
            throw new Exception('Passwords do not match');
        }
        if ($this->password->isValidPassword() === false) {
            throw new Exception('Password must be at least 7 characters, and contain at least one number, letter, or symbol');
        }
        return true;
    }

    protected function createUser()
    {

    }

    //encrpyt the password
    //check the email is valid, if so send out an email with a conf link
    //create the account

}

