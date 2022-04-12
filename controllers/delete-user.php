<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/dashboard.php';


if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
  
  if($role !== 'ADMIN') {
    header('Location: ' . '/');
    exit();
  }

  if($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Location: ' . '/');
  }

  $remove_userId = $_POST['removeUser'];

  delete_user($remove_userId);
  header('Location: ' . '/views/dashboard.php');
}