<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/dashboard.php';

if (!isset($_SESSION['userId'])) {
  header('Location: ' . '/');
}

if (isset($_SESSION['userId'])) {
  $userId = $_SESSION['userId'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
  
  if($role !== 'ADMIN') {
    header('Location: ' . '/');
  }
  
  if($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Location: ' . '/');
  }

  $role = $_POST['user-rights'];
  $userId = $_POST['userId'];
  set_new_role($role, $userId);
  header('Location: ' . '/views/dashboard.php');
}