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
    $username      = new Username();
    $password      = new Password();
    $email         = new EmailAddress();
    $passwordCrypt = new PasswordCrypt($_POST['user_password']);
    $account       = new Account($database);
    $createAccount = new CreateAccount($database, $account, $username, $password, $email, $passwordCrypt);
} else {
    $csrfToken->generateToken();
    $csrfToken->setSessionToken();
}


include('views/register.phtml');



?>