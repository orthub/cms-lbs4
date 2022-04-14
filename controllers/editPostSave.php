<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/posts.php';
require_once __DIR__ . '/../models/userRights.php';
require_once __DIR__ . '/../helpers/nonUserRedirect.php';

if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../helpers/session.php';

    $errors = [];

    $postId = htmlspecialchars($_POST['postId']);
    $title = trim(htmlspecialchars($_POST['title']));
    $body = trim(htmlspecialchars($_POST['body']));

    if ((bool)$title === false) {
      $_SESSION['error']['post-title'] = 'Bitte einen Titel eingeben';
      $errors[] = 1;
    }

    if ((bool)$body === false) {
      $_SESSION['error']['post-body'] = 'Beschreibung darf nicht leer sein';
      $errors[] = 1;
    }

    if (count($errors) > 0) {
      header('Location: ' . '/views/editPost.php');
      exit();
    }
    
    $save_product = save_edited_post($postId, $title, $body);

    if ($save_product) {
      $_SESSION['success']['post-edited'] = 'Post erfolgreich bearbeitet';
      unset($_SESSION['edit-product']);
      header('Location: ' . '/views/post-list.php');
      exit();
    }


  }

}