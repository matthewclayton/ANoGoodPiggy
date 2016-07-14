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

    //public function __construct(Database $database, Account $account, $emailAddress)
    public function __construct(Account $account, $emailAddress)
    {
        $this->emailAddress = $emailAddress;
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

    protected function getEmailExists()
    {
        return $this->account->getExists('email_address', $this->emailAddress);
    }


}