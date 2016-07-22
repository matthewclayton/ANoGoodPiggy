<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/13/2016
 * Time: 8:36 PM
 */

set_include_path('./classes');
spl_autoload_register();

$database  = new Database();
$error     = new ErrorHandler();
$csrfToken = new CsrfToken($error);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username      = new Username($database, $error);
    $password      = new Password($database, $error);
    $email         = new EmailAddress($database, $error);
    $passwordCrypt = new PasswordCrypt($_POST['user_password']);
    $createAccount = new CreateAccount($database, $username, $password, $email, $passwordCrypt, $error);
    if ($createAccount->isUserValid() === true && $csrfToken->compareToken() === true) {
        $createAccount->saveUser();
    } else {
        $errorData = $error->getError();
    }
} else {
    $csrfToken->generateToken();
    $csrfToken->setSessionToken();
}


include('views/register.phtml');



?>