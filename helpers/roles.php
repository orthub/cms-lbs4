<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../models/userRights.php';

if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];
}