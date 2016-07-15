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

    protected $newUser = array();

    public function __construct(Database $database, Username $username,
                                Password $password, EmailAddress $email,
                                PasswordCrypt $passwordCrypt)
    {
        $this->database      = $database;
        $this->username      = $username;
        $this->password      = $password;
        $this->email         = $email;
        $this->passwordCrypt = $passwordCrypt;
        $this->setNewUser();
        $this->createUser();
    }

    public function isNewUserValid()
    {
        try {
            $this->username->isUsernameValid();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    protected function createUser()
    {
        if ($this->isNewUserValid() === true) {
            $this->database->setTableName('user_accounts');
            $this->database->setQueryData($this->getNewUser());
            $this->database->insertMultiple();
        }
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

    //encrpyt the password
    //check the email is valid, if so send out an email with a conf link
    //create the account

}

