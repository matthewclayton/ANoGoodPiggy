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

    protected $userToken;

    public function __construct()
    {
        parent::__construct();
        if (isset($_POST['token']) === true) {
            $this->setUserToken();
        }
    }

    protected function getUserToken()
    {
        return $this->userToken;
    }

    protected function setUserToken()
    {
        $this->userToken = $_POST['token'];
    }

    public function generateToken()
    {
        $this->token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    }

    protected function getSessionToken()
    {
        if (isset($_SESSION['token']) === true) {
            return $_SESSION['token'];
        } else {
            return null;
        }
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setSessionToken()
    {
        $_SESSION['token'] = $this->getToken();
    }

    public function compareToken()
    {
        if ($this->getSessionToken() !== null) {
            hash_equals($this->getUserToken(), $this->getSessionToken());
        }
    }

}