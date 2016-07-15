<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/13/2016
 * Time: 8:50 PM
 */

class EmailAddress extends Account
{

    protected $emailAddress;

    public function __construct($database)
    {
        parent::__construct($database);
        $this->emailAddress = $_POST['email_address'];
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
        try {
            if (parent::getExists('email_address', $this->emailAddress) === true) {
                return true;
            } else {
                throw new Exception('This email address is already registered with another account.');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function isValidEmailAddress()
    {
        try {
            if ($this->validEmailFormat() === true && $this->validEmailDomain === true) {
                return true;
            } else {
                throw new Exception('Email address is invalid.');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


}