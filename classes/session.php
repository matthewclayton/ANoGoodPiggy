<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/14/2016
 * Time: 4:41 PM
 */

class Session
{
    public function __construct()
    {
        echo 'all in';
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}