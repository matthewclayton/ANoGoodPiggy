<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/13/2016
 * Time: 8:50 PM
 */

/** Modification ideas:
 * Allow username length to be settable in an admin page, not hard-coded.
 * Turn on/off alpha/numeric only (e.g. allow certain symbols)
 */

class Username extends Account
{

    protected $username;

    public function __construct()
    {
        $this->username = $_POST['username'];
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getUsernameExists()
    {
        parent::getExists('username', $this->username);
    }

    public function isUsernameValid()
    {
        if ($this->isValidLength() === true && $this->isValidCharacters() === true) {
            return true;
        } else {
            //return false;
            throw new Exception('Username must be at least 3 characters containing only numbers and letters.');
            return false;
        }
    }

    protected function isValidLength()
    {
        return strlen($this->username) >= 3;
    }

    protected function isValidCharacters()
    {
        return ctype_alnum($this->username);
    }
}