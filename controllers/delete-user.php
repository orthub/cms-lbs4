<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/users.php';

if($_SERVER['REQUEST_METHOD'] === 'GET') {
  header('Location: ' . '/');
}

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
  
  if($role !== 'ADMIN') {
    header('Location: ' . '/');
    exit();
  }

  $userId = htmlspecialchars(filter_input(INPUT_POST, 'remove-user'));
  $get_user = get_user_data_by_id($userId);
  $first_name = $get_user['first_name'];
  $last_name = $get_user['last_name'];
  $email = $get_user['email'];
  $user_role = $get_user['role_id'];
  $invoice_path = $get_user['home']; // bis hier OK

  // falls jemand mit der rolle 'customer' gelöscht werden soll, werden alle daten geholt
  // die daten werden dann ins archiv verschoben und von der haupttabelle gelöscht
  if ($user_role === 'CUSTOMER') {
    $user_archive = move_user_to_archive($userId, $first_name, $last_name, $email, $user_role, $invoice_path);
    $deleted = delete_user_by_id($userId);
    if ((bool)$deleted === false) {
      $_SESSION['error']['delete-failed'] = 'Fehler beim löschen des Benutzers';
      header('Location: ' . '/views/user-list.php');
      exit();
    }
    
    if ((bool)$deleted) {
      $_SESSION['success']['user-deleted'] = 'Benutzer wurde erfolgreich gelöscht';
      header('Location: ' . '/views/user-list.php');
      exit();
    }
  }
  
  // falls jemand der nicht die rolle 'customer' hat gelöscht werden soll, wird geprüft ob ein
  // post erstellt wurde, falls ja, wird die id vom post umgeschrieben, danach ins archiv und löschen
  if ($user_role !== 'CUSTOMER') {
    $search_posts = count_posts_from_user($userId);
    if ($search_posts > 0) {
      $change_author = change_author($userId, $newUserId);
    }
    $user_archive = move_user_to_archive($userId, $first_name, $last_name, $email, $user_role, $invoice_path);
    $deleted = delete_user_by_id($userId);
    if ((bool)$deleted === false) {
      $_SESSION['error']['delete-failed'] = 'Fehler beim löschen des Benutzers';
      header('Location: ' . '/views/user-list.php');
      exit();
    }
    
    if ((bool)$deleted) {
      $_SESSION['success']['user-deleted'] = 'Benutzer wurde erfolgreich gelöscht';
      header('Location: ' . '/views/user-list.php');
      exit();
    }
  }
  
  header('Location: ' . '/views/user-list.php');
}