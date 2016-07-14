<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/13/2016
 * Time: 9:58 PM
 */

/**mod idea
 * customize the cost factor from admin panel
 * */


class PasswordCrypt
{
    protected $hashOptions = array();

    protected $passwordText;

    protected $passwordHash;

    public function __construct($userPassword)
    {
        $this->passwordText = $userPassword;
    }

    public function getCost()
    {
        return 9;
    }

    protected function setHashOptions()
    {
        $this->hashOptions['cost'] = $this->getCost();
    }

    protected function getHashOptions()
    {
        return $this->hashOptions;
    }

    protected function setHash()
    {
        $this->passwordHash = password_hash($this->passwordText, PASSWORD_BCRYPT, $this->getHashOptions());
    }

    protected function getHash()
    {
        return $this->passwordHash;
    }


}


?>