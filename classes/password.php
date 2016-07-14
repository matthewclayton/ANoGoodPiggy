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

    public function __construct($userPassword, $userPasswordConfirm)
    {
        $this->userPassword = $userPassword;
        $this->userPasswordConfirm = $userPasswordConfirm;
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

    protected function isMatching()
    {
        return ($this->userPassword === $this->userPasswordConfirm);
        /**if ($this->userPassword === $this->userPasswordConfirm) {
            return true;
        } else {
            return false;
        }**/
    }



}