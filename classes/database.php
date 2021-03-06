<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/8/2016
 * Time: 11:23 PM
 */

class Database
{
    private $dbHost = 'localhost';

    private $dbUser = 'dev';

    private $dbPass = '*{Hj5X>@4Vbrp}tbR($a.:fk2dK85m,!_Z<k!fh$#h^T?[1)b#';

    private $dbName = 'dev';

    protected $db;

    protected $tableName;

    protected $queryData;

    protected $dbFields;

    protected $dbValues;

    protected $placeHolders;

    protected $numRows = 0;

    public $queryResult;

    public $lastInsertId;

    public function __construct()
    {
        $this->connect();
        if ($this->db->connect_error) {
            die('Error Connecting to Database');
        }
    }

    private function connect()
    {
        $this->db = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
    }

    public function close()
    {
        return $this->db->close();
    }

    public function setTableName($tableName)
    {
        if (empty($tableName)) {
            return false;
        }
        $this->tableName = $tableName;
    }

    public function setQueryData($queryData)
    {
        if (empty($queryData) || is_array($queryData) === false) {
            return false;
        }
        $this->queryData = $queryData;
    }

    private function getQueryTypes()
    {
        $type = '';
        foreach ($this->queryData AS $valueType) {
            if (is_string($valueType)) {
                $type .= 's';
            }
            else if (is_numeric($valueType)) {
                $type .= 'i';
            }
            else if (is_float($valueType)) {
                $type .= 'd';
            }
            else {
                $type .= 'b';
            }
        }
        return $type;
    }

    private function setPlaceholders()
    {
        $this->placeHolders = array_fill(0, count($this->queryData), '?');
    }

    private function setQueryParams()
    {
        $this->dbFields = array();
        $this->dbValues = array();
        foreach ($this->queryData AS $field => $value) {
            $this->dbFields[] = $field;
            if (empty($value)) {
                $this->dbValues[] = null;
            }
            else {
                $this->dbValues[] = $value;
            }
        }
    }

    private function setBindParms()
    {
        $params = array();
        foreach ($this->dbValues AS &$value) {
            $params[] = &$value;
        }
        array_unshift($params, $this->getQueryTypes());
        return $params;
    }

    public function insert()
    {
        $this->setPlaceholders();
        $this->setQueryParams();
        $insertStmt = "INSERT INTO $this->tableName (" .
            implode(',', $this->dbFields) . ") VALUES (" .
            implode(',', $this->placeHolders) . ");";

        $prepareStmt = $this->db->prepare($insertStmt);

        call_user_func_array(array($prepareStmt, 'bind_param'), $this->setBindParms());

        $success = $prepareStmt->execute();

        if ($success === true) {
            $this->numRows++;
        }
    }

    public function getLastInsertId()
    {
        return $this->db->insert_id;
    }

    public function insertMultiple()
    {
        foreach ($this->queryData AS $key => $valueArray) {
            $this->queryData = $valueArray;
            $this->insert();
        }
    }

    public function getNumRows()
    {
        return $this->numRows;
    }

    public function setNumRows($rowCount)
    {
        $this->numRows = $rowCount;
    }

    public function select()
    {
        $this->setPlaceholders();
        $this->setQueryParams();
        $insertStmt = "SELECT * FROM $this->tableName WHERE " .
            implode(',', $this->dbFields) . " = " .
            implode(',', $this->placeHolders) . ";";

        $prepareStmt = $this->db->prepare($insertStmt);

        call_user_func_array(array($prepareStmt, 'bind_param'), $this->setBindParms());

        $prepareStmt->execute();

        $prepareStmt->store_result();

        $this->setNumRows($prepareStmt->num_rows);

        return $prepareStmt->get_result();
    }

    public function joinSelect($joinTable, $joinKey)
    {
        $this->setPlaceholders();
        $this->setQueryParams();

        $insertStmt = "SELECT * FROM $this->tableName 
			INNER JOIN $joinTable 
			ON " . implode(',', $this->dbFields) . " = $joinTable.$joinKey
			WHERE " . implode(',', $this->dbFields) . " = " .
            implode(',', $this->placeHolders) . ";";

        $prepareStmt = $this->db->prepare($insertStmt);

        call_user_func_array(array($prepareStmt, 'bind_param'), $this->setBindParms());

        $prepareStmt->execute();

        $prepareStmt->store_result();

        $this->setNumRows($prepareStmt->num_rows);

        return $prepareStmt->get_result();
    }
}

?>