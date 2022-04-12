<?php
require_once __DIR__ . '/../helpers/session.php';


if (isset($_SESSION['errors'])) {
  unset($_SESSION['errors']);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  header('Location: ' . '/views/login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errors = [];
  $emailExist = false;
  $matchPasswd = false;
  $loginEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $loginPasswd = filter_input(INPUT_POST, 'passwd');

  if ((bool)$loginEmail === false) {
    $_SESSION['errors']['login-mail'] = 'Bitte Email eingeben';
    $errors[] = 1;
  }
  if ((bool)$loginPasswd === false) {
    $_SESSION['errors']['login-passwd'] = 'Bitte Passwort eingeben';
    $errors[] = 1;
  }

  if ((bool)$loginEmail) {
    $_SESSION['login']['email'] = $loginEmail;
  }
  if ((bool)$loginPasswd) {
    $_SESSION['login']['passwd'] = $loginPasswd;
  }

  if (count($errors) > 0) {
    header('Location: ' . '/views/login.php');
  }

  if (count($errors) === 0) {
    require_once __DIR__ . '/../models/login.php';
    
    $emailExist = search_mail($loginEmail, $loginPasswd);

    if ((bool)$emailExist === false) {
      $_SESSION['errors']['login-fail'] = 'Email oder Passwort stimmt nicht';
      $errors[] = 1;
    }
    
    if (count($errors) > 0) {
      header('Location: ' . '/views/login.php');
    }

    if ((bool)$emailExist) {
      $match = get_password_from_email($loginEmail);
      $isValidLogin = password_verify($loginPasswd, $match);
      
      if (!$isValidLogin) {
        $_SESSION['errors']['login-fail'] = 'Email oder Passwort stimmt nicht';
        header('Location: ' . '/views/login.php');
      }
  
      if ($isValidLogin) {
        $user_id = get_user_id($loginEmail);
        $_SESSION['userId'] = $user_id;
        unset($_SESSION['login']);
        header('Location: ' . '/views/main.php');
        exit();
      }
    }
  }
}