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

    public function checkUsername()
    {
        try {
            if ($this->username->getUsernameExists() === true) {
                throw new Exception('Username already exists!');
            }
            if ($this->username->isUsernameValid() === false) {
                throw new Exception('Username must be at least 3 alpha-numeric characters long.');
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function checkPassword()
    {
        try {
            if ($this->password->isMatching() === false) {
                throw new Exception('Passwords do not match.');
            }
            if ($this->password->isValidPassword() === false) {
                throw new Exception('Password must be at least 7 characters, containing one number/letter/symbol.');
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function checkEmail()
    {
        try {
            if ($this->email->isValidEmailAddress() === false) {
                throw new Exception('Email address is invalid.');
            }
            if ($this->email->getEmailExists() === true) {
                throw new Exception('This email address is already registered with another account.');
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }


    protected function createUser()
    {
        if ($this->checkUsername() === true && $this->checkPassword() === true && $this->checkEmail() === true) {
            $this->database->setTableName('user_accounts');
            $this->database->setQueryData($this->getNewUser());
            $this->database->insertMultiple();
        } else {

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

