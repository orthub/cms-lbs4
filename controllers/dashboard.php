<?php
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/dashboard.php';

// wenn niemand eingeloggt ist wird auf die startseite umgeleitet
if (!isset($_SESSION['userId'])) {
  header('Location: ' . '/');
}

// bei eingeloggtem benutzer werden die rechte abgefragt, wenn der benutzer kein
// administrator oder angestellter ist, wird wieder auf die startseite umgeleitet
if (isset($_SESSION['userId'])) {
  $userId = $_SESSION['userId'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
  
  if($role === 'CUSTOMER') {
    header('Location: ' . '/');
    die();
  }

  // informationen über benutzer, posts und produkte holen
  $all_users = get_all_users_and_roles();
  $roles = get_all_roles();

  $last_products = get_last_ten_products();
  $all_products = get_all_products_for_admin();

  $all_posts = get_all_posts();
}