<?php
require_once __DIR__ . '/../lib/sessionHelper.php';
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/posts.php';
require_once __DIR__ . '/../models/userRights.php';

if (isset($_SESSION['userId'])) {
  $userId = $_SESSION['userId'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
  
  if ($role === 'ADMIN') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      require_once __DIR__ . '/../lib/sessionHelper.php';
      $get_post_id = filter_input(INPUT_POST, 'delete-post', FILTER_SANITIZE_SPECIAL_CHARS);
      $delete_post = delete_post_by_id($get_post_id);
    
      if ($delete_post) {
        header('Location: ' . '/views/post-list.php');
      }
    }
  }
  header('Location: ' . '/');
}