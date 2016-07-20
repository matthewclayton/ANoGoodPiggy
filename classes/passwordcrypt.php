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

    const COST_FACTOR = 9;

    protected $hashOptions = array();

    protected $passwordText;

    protected $passwordHash;

    public function __construct($userPassword)
    {
        $this->passwordText = $userPassword;
        $this->setHashOptions();
        $this->setHash();
    }

    public function getCost()
    {
        return self::COST_FACTOR;
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

    public function getHash()
    {
        return $this->passwordHash;
    }


}


?>