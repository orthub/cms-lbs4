<?php
require_once __DIR__ . '/../../cms/models/database.php';

function get_login($email)
{
  $sql = 'SELECT `id`, `email`, `password` FROM users WHERE `email` = :email';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([':email' => $email]);

  $res = $stmt->fetchAll();
  return $res;
}

function get_user_name(string $id)
{
  $userId = str_replace('_loggedIn', '', $id);
  $sql = 'SELECT `first_name` FROM users WHERE `id` = :id';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([':id' => $userId]);

  $res = $stmt->fetchColumn();
  return $res;
}