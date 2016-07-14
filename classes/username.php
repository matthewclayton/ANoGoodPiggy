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

   //protected $database;

    //protected $account;

    protected $username;

    //public function __construct(Database $database, Account $account, $username)
    //public function __construct(Account $account, $username)
    public function __construct()
    {
        //$this->database = $database;
        //$this->account = $account;
        $this->username = $_POST['username'];
    }

    //does the username exist
    protected function getUsernameExists()
    {
        parent::getExists('username', $this->username);
        //return $this->account->getExists('username', $this->username);
        /**$queryArray = array(
            'username' => $this->username,
        );
        $this->database->setTableName('user_accounts');
        $this->database->setQueryData($queryArray);
        $this->database->select();
        if ($this->database->getNumRows() == 0) {
            return false;
        } else {
            return true;
        }**/
    }

    //is the username valid
    protected function isUsernameValid()
    {
        if ($this->isValidLength() === true && $this->isValidCharacters() === true) {
            return true;
        } else {
            return false;
        }
    }

    //is it at least 3 characters long
    protected function isValidLength()
    {
        return strlen($this->username) >= 3;
        /**if (strlen($this->username) < 3) {
            return false;
        } else {
            return true;
        } **/
    }

    //does it contain only numbers and letters
    protected function isValidCharacters()
    {
        return ctype_alnum($this->username);
    }
}