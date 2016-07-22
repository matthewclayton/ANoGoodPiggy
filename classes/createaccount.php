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

    protected $passwordCrypt;

    protected $account;

    protected $error;

    protected $newUser = array();

    public function __construct(Database $database, Username $username,
                                Password $password, EmailAddress $email,
                                PasswordCrypt $passwordCrypt, ErrorHandler $error)
    {
        $this->database      = $database;
        $this->username      = $username;
        $this->password      = $password;
        $this->email         = $email;
        $this->passwordCrypt = $passwordCrypt;
        $this->error         = $error;
        $this->setNewUser();
    }

    public function isUserValid()
    {
        return $this->username->isUsernameValid() === true &&
               $this->password->isPasswordValid() === true &&
               $this->email->isEmailValid()       === true;
    }

    public function saveUser()
    {
        $this->database->setTableName('user_accounts');
        $this->database->setQueryData($this->getNewUser());
        $this->database->insertMultiple();
    }

    protected function getNewUser()
    {
        return $this->newUser;
    }

    protected function setNewUser()
    {
        $this->newUser[] = array(
            'username' => $this->username->getUsername(),
            'user_password' => $this->passwordCrypt->getHash(),
            'email_address' => $this->email->getEmailAddress(),
        );
    }

    //check the email is valid, if so send out an email with a conf link

}

