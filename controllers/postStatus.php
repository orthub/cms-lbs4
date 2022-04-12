<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/posts.php';
require_once __DIR__ . '/../models/userRights.php';


if (isset($_SESSION['userId'])) {
  $userId = $_SESSION['userId'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
  
  if ($role === 'CUSTOMER') {
    header('Location: ' . '/');
  }

  $post_id = filter_input(INPUT_GET, 'postid', FILTER_SANITIZE_SPECIAL_CHARS);
  $post_status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
  
  if ($post_status === 'LIVE'){
    $new_status = 'DRAFT';
    $changePostStatus = change_post_status_by_id($post_id, $new_status);
    if ($changePostStatus) {
      $_SESSION['edit-post']['published'] = 'DRAFT';
      header('Location: ' . '/views/editPost.php');
      exit();
    }
  }
  
  if ($post_status === 'DRAFT') {
    $new_status = 'LIVE';
    $changePostStatus = change_post_status_by_id($post_id, $new_status);
    if ($changePostStatus) {
      $_SESSION['edit-post']['published'] = 'LIVE';
      header('Location: ' . '/views/editPost.php');
      exit();
    }
  }
  
  } else {
    header('Location: ' . '/');
}