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
    echo 'test';
    $createAccount = new CreateAccount($database);
    $account = new Account($database);
    $username = new Username($account, $_POST['username']);
    $password = new Password($_POST['user_password'], $_POST['user_password_confirm']);
    $email = new EmailAddress($account, $_POST['email_address']);
} else {
    echo 'nopenothere';
}


include('views/register.phtml');



?>