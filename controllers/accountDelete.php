<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../helpers/nonUserRedirect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once __DIR__ . '/../helpers/session.php';
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    require_once __DIR__ . '/../models/users.php';
    
    $delete_account = delete_user_by_id($user_id);

    if ((bool)$delete_account === false) {
      $_SESSION['error']['not-deleted'] = 'Konto konnte nicht gelöscht werden.<br /> Löschen sie gegebenenfalls den Warenkorb und versuchen sie es erneut';
      header('Location: ' . '/views/account.php');
    }

    if ((bool)$delete_account) {
      header('Location: ' . '/views/logout.php');
      exit();
    }
  }
}