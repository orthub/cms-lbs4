<?php
session_start();

$valideEmail = false;
$validePassword = false;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  header('Location: ' . '/shop');
}

require_once __DIR__ . '/../models/login.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email)) {
  $_SESSION['errors']['email'] = 'Email erforderlich';
}

if (empty($password)) {
  $_SESSION['errors']['password'] = 'Passwort erforderlich';
}

if (!empty($_SESSION['errors'])) {
  header('Location: ' . '/shop/views/login.php');
}


$verify = get_login($email);
echo '<pre>';
var_dump($verify);
echo '</pre>';
echo 'EMAIL:';
var_dump($email);

if ($email === $verify[0]['email']) {
  $valideEmail = true;
}

if ($valideEmail === true) {
  password_verify($password, $verify[0]['password']);
  $validePassword = true;
}

if ($valideEmail && $validePassword) {
  // session_start();
  $_SESSION['userId'] = $verify[0]['id'] . '_loggedIn';
  header('Location: ' . '/shop');
}