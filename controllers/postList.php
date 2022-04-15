<?php 
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/products.php';
require_once __DIR__ . '/../helpers/nonUserRedirect.php';

// bei eingeloggtem benutzer werden die rechte abgefragt, wenn der benutzer kein
// administrator ist, wird wieder auf die startseite umgeleitet
if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
  
  if ($role === 'CUSTOMER') {
    header('Location: ' . '/');
    exit();
  }

  require_once __DIR__ . '/../helpers/session.php';
  require_once __DIR__ . '/../models/posts.php';
  $all_posts = get_all_posts();

}