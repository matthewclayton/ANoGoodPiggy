<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/14/2016
 * Time: 3:26 PM
 */

class Account
{

    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getExists($field, $value)
    {
        $queryArray = array(
            "$field" => $value,
        );
        $this->database->setTableName('user_accounts');
        $this->database->setQueryData($queryArray);
        $this->database->select();
        echo 'trueU1' . $this->database->getNumRows();
        if ($this->database->getNumRows() == 0) {
            return false;
        } else {
            echo 'trueU' . $this->database->getNumRows();
            return true;
        }
    }

}