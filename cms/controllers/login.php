<?php
session_start();
unset($_SESSION['login']);
$method = htmlspecialchars($_SERVER['REQUEST_METHOD']);

if ($method === 'POST') {
  $login_email = htmlspecialchars($_POST['email']);
  $login_password = htmlspecialchars($_POST['passwd']);


  $_SESSION['login']['email'] = $login_email;
  $_SESSION['login']['passwd'] = $login_password;

  require_once __DIR__ . '/../models/login.php';

  if (empty($login_email) || empty($login_password)) {
    $_SESSION['error-login'] = 'Enter email and password please';
    header('Location: ' . '/cms/views/login.php');
  }

  $email_exist = check_email_on_login($login_email);
  $_SESSION['login']['found_email'] = $email_exist;

  if ($email_exist === $login_email) {
    echo 'EMAIL IS THE SAME';
  }

  $password_match = check_password_on_login($login_email, $login_password);
  $_SESSION['login']['found_password'] = check_password_on_login($login_email, $login_password);

  if ($email_exist === $login_email && $password_match === 1) {
    header('Location:' . '/cms/views/customer.php');
  }
}


header('Location:' . '/cms/views/login.php');
/*




}
*/