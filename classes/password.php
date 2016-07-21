<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/13/2016
 * Time: 8:46 PM
 */

class Password extends Account
{

    protected $error;

    protected $userPassword;

    protected $userPasswordConfirm;

    public function __construct(Database $database, ErrorHandler $error)
    {
        parent::__construct($database);
        $this->error               = $error;
        $this->userPassword        = $_POST['user_password'];
        $this->userPasswordConfirm = $_POST['user_password_confirm'];
        $this->setPasswordErrors();
    }

    protected function getPassword()
    {
        return $this->userPassword;
    }

    protected function getUserPasswordConfirm()
    {
        return $this->userPasswordConfirm;
    }

    protected function isValidLength()
    {
        return (strlen($this->getUserPassword()) >= 7);
    }

    protected function isMixedCharacters()
    {
        return (ctype_alpha($this->getUserPassword()) !== true && ctype_digit($this->getUserPassword()) !== true);
    }

    public function isMatching()
    {
        if ($this->getUserPassword() === $this->getUserPasswordConfirm()) {
            return true;
        } else {
            return false;
        }
    }

    protected function setPasswordErrors()
    {
        if ($this->isValidLength() === false) {
            $this->error->logError('Password', 'Password must be at least 7 characters.');
        }
        if ($this->isMixedCharacters() === false) {
            $this->error->logError('Password', 'Password must contain at least one character, one number or symbol.');
        }
        if ($this->isMatching() === false) {
            $this->error->logError('Password', 'Passwords do not match.');
        }
    }

    public function isPasswordValid()
    {
        return $this->error->hasError('Password') === false;
    }



}