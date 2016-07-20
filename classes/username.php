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

    protected $error;

    public function __construct(Database $database, ErrorHandler $error)
    {
        parent::__construct($database);
        $this->error    = $error;
        $this->username = $_POST['username'];
        $this->setUsernameErrors();
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getUsernameExists()
    {
        return parent::getExists('username', $this->username) === true;
    }

    protected function isValidLength()
    {
        return strlen($this->username) >= 3;
    }

    protected function isValidCharacters()
    {
        return ctype_alnum($this->username);
    }

    protected function setUsernameErrors()
    {
        if ($this->getUsernameExists() === true) {
            $this->error->logError('Username', 'Username already exists.');
        }
        if ($this->isValidLength() === false) {
            $this->error->logError('Username', 'Username must be at least 3 characters');
        }
        if ($this->isValidCharacters() === false) {
            $this->error->logError('Username', 'Username must contain only alphanumeric characters');
        }
    }

    public function isUsernameValid()
    {
        return $this->error->hasError('Username') === false;
    }

}