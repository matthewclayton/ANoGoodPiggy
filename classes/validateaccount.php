<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/22/2016
 * Time: 6:50 PM
 */

/**class ValidateAccount extends Create
{


    public function isUserValid()
    {
        return $this->username->isUsernameValid() === true &&
        $this->password->isPasswordValid() === true &&
        $this->email->isEmailValid()       === true;
    }
}**/