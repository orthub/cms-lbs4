<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/posts.php';
require_once __DIR__ . '/../models/userRights.php';

if (!isset($_SESSION['userId'])) {
  header('Location: ' . '/');
}

if (isset($_SESSION['userId'])) {
  $userId = $_SESSION['userId'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../helpers/session.php';

    $postId = htmlspecialchars($_POST['postId']);
    $title = htmlspecialchars($_POST['title']);
    $body = htmlspecialchars($_POST['body']);

    $save_product = save_edited_post($postId, $title, $body);

    if ($save_product) {
      unset($_SESSION['edit-product']);
      header('Location: ' . '/views/post-list.php');
    }


  }

}