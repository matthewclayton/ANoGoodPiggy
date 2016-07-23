<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/22/2016
 * Time: 7:54 PM
 */

set_include_path('./classes');
spl_autoload_register();

$database  = new Database();
$error     = new ErrorHandler();
$csrfToken = new CsrfToken($error);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $authorize = new Authorize($database);
    if ($authorize->isValidCredentials() === true) {
        echo 'Success!';
    }

} else {
    $csrfToken->generateToken();
    $csrfToken->setSessionToken();
}


include('views/login.phtml');