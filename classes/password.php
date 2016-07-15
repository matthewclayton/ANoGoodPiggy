<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/13/2016
 * Time: 8:46 PM
 */

class Password extends Account
{

    protected $userPassword;

    protected $userPasswordConfirm;

    //public function __construct($userPassword, $userPasswordConfirm)
    public function __construct()
    {
        //$this->userPassword = $userPassword;
        //$this->userPasswordConfirm = $userPasswordConfirm;
        $this->userPassword = $_POST['user_password'];
        $this->userPasswordConfirm = $_POST['user_password_confirm'];
    }

    protected function isValidLength()
    {
        return strlen($this->userPassword) >= 7;
    }

    protected function isMixedCharacters()
    {
        if (ctype_alpha($this->userPassword) !== true && ctype_digit($this->userPassword) !== true) {
            return true;
        } else {
            return false;
        }
    }

    public function isMatching()
    {
        return ($this->userPassword === $this->userPasswordConfirm);
        /**if ($this->userPassword === $this->userPasswordConfirm) {
            return true;
        } else {
            return false;
        }**/
    }

    public function isValidPassword()
    {
        if ($this->isMixedCharacters() === true && $this->isValidLength() === true) {
            return true;
        } else {
            return false;
        }
    }



}