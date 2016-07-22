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

    protected $error;

    public function __construct(Error $error)
    {
        parent::__construct();
        $this->error = $error;
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
        return $_SESSION['token'];
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
        if ($this->getUserToken() !== null) {
            if (hash_equals($this->getUserToken(), $this->getSessionToken()) !== true) {
                $this->error->logError('Unknown error, please refresh and try again');
                return false;
            } else {
                return true;
            }
        }
    }

}