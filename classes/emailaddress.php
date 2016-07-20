<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/13/2016
 * Time: 8:50 PM
 */

class EmailAddress extends Account
{

    protected $error;

    protected $emailAddress;

    public function __construct(Database $database, ErrorHandler $error)
    {
        parent::__construct($database);
        $this->error        = $error;
        $this->emailAddress = $_POST['email_address'];
        $this->setEmailErrors();
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    protected function validEmailFormat()
    {
        return filter_var($this->emailAddress, FILTER_VALIDATE_EMAIL);
    }

    protected function getDomain()
    {
        return substr(strrchr($this->emailAddress, '@'), 1);
    }

    protected function validEmailDomain()
    {
        return checkdnsrr($this->getDomain(), 'MX');
    }

    public function getEmailExists()
    {
        return parent::getExists('email_address', $this->emailAddress) === true;
    }

    protected function setEmailErrors()
    {
        if ($this->getEmailExists() === true) {
            $this->error->logError('Email', 'Email address is already in use.');
        }
        if ($this->validEmailDomain() === false) {
            $this->error->logError('Email', 'Invalid email domain.');
        }
        if ($this->validEmailFormat() === false) {
            $this->error->logError('Email', 'Invalid email address format.');
        }
    }

    public function isEmailValid()
    {
        return $this->error->hasError('Email') === false;
    }


}