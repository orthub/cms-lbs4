<?php

require_once __DIR__ . '/database.php';

function check_user_role(string $userId)
{
  $sql_check_user_role = 'SELECT `users`.`id`, `role_id`, `role`
                          FROM `users`
                          JOIN `user_role` ON(`role_id` = `user_role`.`id`) 
                          WHERE `users`.`id` = :userId';
  $stmt_check_user_role = get_db()->prepare($sql_check_user_role);
  $stmt_check_user_role->execute([':userId' => $userId]);
  
  return $stmt_check_user_role->fetch();
}