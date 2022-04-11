<?php

require_once __DIR__ . '/database.php';

function check_user_role(string $userId)
{
  $sql_check_user_role = 'SELECT `id`, `role` FROM `users` WHERE `id` = :userId';
  $stmt_check_user_role = get_db()->prepare($sql_check_user_role);
  $stmt_check_user_role->execute([':userId' => $userId]);
  
  return $stmt_check_user_role->fetch();
}