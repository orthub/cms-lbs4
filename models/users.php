<?php

require_once __DIR__ . '/database.php';


function get_all_users()
{
  $sql_get_all_users = 'SELECT `id`, `first_name`, `last_name`, `email`, `role` 
                        FROM `users`';
  $stmt_get_all_users = get_db()->query($sql_get_all_users, PDO::FETCH_ASSOC);
  return $stmt_get_all_users;
}

function get_all_roles()
{
  $sql_get_all_roles = 'SELECT DISTINCT `role` 
                        FROM `users` 
                        ORDER BY `role` DESC';
  $stmt_get_all_roles = get_db()->query($sql_get_all_roles);
  $result_get_all_roles = $stmt_get_all_roles->fetchAll();
  
  return $result_get_all_roles;
}