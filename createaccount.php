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
$createAccount = new CreateAccount($database);
$username = new Username($database, $_POST['username']);
$password = new Password($user_password, $user_password_confirm);
$email = new EmailAddress($email_address);



include('views/register.phtml');



?>