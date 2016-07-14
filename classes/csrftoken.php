<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/14/2016
 * Time: 4:41 PM
 */

class CsrfToken extends Session
{

    protected $token;

    protected function generateToken()
    {
        $this->token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    }

    public function getToken()
    {
        return $this->token;
    }

    protected function setSessionToken()
    {
        $_SESSION['token'] = $this->getToken();
    }

    public function compareToken()
    {
        return hash_equals($_POST['token'], $_SESSION['token']);
    }

}