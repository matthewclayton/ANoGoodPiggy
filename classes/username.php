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

    public function __construct($database)
    {
        parent::__construct($database);
        $this->username = $_POST['username'];
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getUsernameExists()
    {
        if (parent::getExists('username', $this->username) === true) {
            return true;
        } else {
            throw new Exception('Username already exists!');
        }
    }

    public function isUsernameValid()
    {
        if ($this->isValidLength() === true && $this->isValidCharacters() === true) {
            return true;
        } else {
            throw new Exception('Username must be at least 3 alpha-numeric characters long.');
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