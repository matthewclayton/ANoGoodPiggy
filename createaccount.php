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
    //$account = new Account($database);
    //$username = new Username($account, $_POST['username']);
    $username = new Username();
    //$password = new Password($_POST['user_password'], $_POST['user_password_confirm']);
    $password = new Password();
    //$email = new EmailAddress($account, $_POST['email_address']);
    $email = new EmailAddress();
    $createAccount = new CreateAccount($database, $username, $password, $email);
} else {
    $csrfToken->generateToken();
    $csrfToken->setSessionToken();
}


include('views/register.phtml');



?>