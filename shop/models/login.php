<?php
require_once __DIR__ . '/../../cms/models/database.php';

function get_login(string $email): array
{
  $sql_get_login = 'SELECT `id`, `email`, `password` 
          FROM users 
          WHERE `email` = :email';
  $statement_get_login = get_db()->prepare($sql_get_login);
  $statement_get_login->execute([':email' => $email]);

  $result_get_login = $statement_get_login->fetchAll();
  return $result_get_login;
}

function get_user_name(string $user_id)
{
  $userId = str_replace('_loggedIn', '', $user_id);
  $sql = 'SELECT `first_name` FROM users WHERE `id` = :id';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([':id' => $userId]);

  $res = $stmt->fetchColumn();
  return $res;
}