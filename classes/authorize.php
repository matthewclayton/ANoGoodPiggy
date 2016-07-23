<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/22/2016
 * Time: 7:51 PM
 */

class Authorize
{

    protected $database;

    protected $passwordCrypt;

    private $username;

    private $userPassword;

    private $authorizeArray;

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->setUsername();
        $this->setUserPassword();
        $this->passwordCrypt = new PasswordCrypt($this->getUserPassword());
        $this->setAuthorizeArray();
    }

    protected function setUsername()
    {
        $this->username = $_POST['username'];
    }

    protected function setUserPassword()
    {
        $this->userPassword = $_POST['user_password'];
    }

    protected function getUsername()
    {
        return $this->username;
    }

    protected function getUserPassword()
    {
        return $this->userPassword;
    }

    protected function setAuthorizeArray()
    {
        $this->authorizeArray = array(
            'username'      => $this->getUsername(),
            'user_password' => $this->passwordCrypt->getHash(),
        );
    }

    protected function getAuthorizeArray()
    {
        return $this->authorizeArray;
    }

    public function isValidCredentials()
    {
        $this->database->setTableName('user_accounts');
        $this->database->setQueryData($this->getAuthorizeArray());
        $this->database->select();
        if ($this->database->getNumRows() == 1) {
            return false;
        } else {
            return true;
        }
    }

}