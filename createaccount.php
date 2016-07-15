<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/13/2016
 * Time: 8:36 PM
 */

set_include_path('./classes');
spl_autoload_register();

$database = new Database();
$csrfToken = new CsrfToken();

if ($csrfToken->compareToken() === true) {
    $username      = new Username($database);
    $password      = new Password($database);
    $email         = new EmailAddress($database);
    $passwordCrypt = new PasswordCrypt($_POST['user_password']);
    $createAccount = new CreateAccount($database, $username, $password, $email, $passwordCrypt);
} else {
    $csrfToken->generateToken();
    $csrfToken->setSessionToken();
}


include('views/register.phtml');



?>