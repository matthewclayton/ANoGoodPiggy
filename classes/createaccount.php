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

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    protected function createUser()
    {

    }


    //check the username does not exist
    //check teh username is valid
    //validated the passwords match/correct length
    //encrpyt the password
    //check the email is valid, if so send out an email with a conf link
    //create the account

}

