<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/20/2016
 * Time: 4:05 PM
 */

class ErrorHandler
{
    public $error = array();

    const DEFAULT_SOURCE = 'Unknown';

    public function logError($errorSource = self::DEFAULT_SOURCE, $error)
    {
        $this->error[$errorSource][] = $error;
    }

    public function hasError($errorSource = self::DEFAULT_SOURCE)
    {
        return array_key_exists($errorSource, $this->error);
    }

    public function getError()
    {
        return $this->error;
    }

}