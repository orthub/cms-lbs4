<?php
require_once __DIR__ . '/../helpers/session.php';

if (isset($_GET['actoken']) && !empty($_GET['actoken'])) {
  require_once __DIR__ . '/../helpers/session.php';
  $token = trim(htmlspecialchars(filter_input(INPUT_GET, 'actoken')));

  if ($_SESSION['register']['token'] === $token) {

    $register_id = $_SESSION['register']['id'];
    $registerFirstname = $_SESSION['register']['first-name'];
    $registerLastname = $_SESSION['register']['last-name'];
    $registerEmail = $_SESSION['register']['email'];
    $registerPassword = $_SESSION['register']['password'];
    $registerHome = $_SESSION['register']['home'];

    require_once __DIR__ . '/../models/register.php';

    $create_new_user = create_new_user($register_id, $registerFirstname, $registerLastname, $registerEmail, $registerPassword, $registerHome);

    if ((bool)$create_new_user) {
      $path = '/var/www/html/storage/' . $register_id;
      mkdir($path, 0700, true);
      $_SESSION['new-user'] = 'Account erfolgreich erstellt. Sie können sich nun einloggen';
      header('Location: ' . '/views/login.php');
    }
    
    $_SESSION['success']['activated'] = 'Account erfolgreich aktiviert';
    header('Location: ' . '/views/login.php');
    exit();
  }

  header('Location: ' . '/views/register.php');
}