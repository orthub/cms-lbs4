<?php

require_once __DIR__ . '/database.php';

// suche ob die email in der datenbank existiert
function search_if_email_exists_already()
{
  $sql_search_if_existing_email = 'SELECT `email` FROM `users`';
  $stmt_search_if_existing_email = get_db()->query($sql_search_if_existing_email);
  $res_search_if_existing_email = $stmt_search_if_existing_email->fetchAll(PDO::FETCH_ASSOC);
  
  return $res_search_if_existing_email;
}

// Anlegen eines neuen Benutzers mit gehashtem passwort
function create_new_user(string $register_id, string $first_name, string $last_name, string $email, string $passwd, string $home)
{
  //passwort hashen
  $passwd = password_hash($passwd, PASSWORD_DEFAULT);
  $sql_create_new_user = 'INSERT INTO `users` 
                          SET `id` = :userId,
                              `first_name` = :firstName,
                              `last_name` = :lastName,
                              `email` = :email,
                              `password` = :passwd,
                              `home` = :home';
  $stmt_create_new_user = get_db()->prepare($sql_create_new_user);
  $stmt_create_new_user->execute([
    ':userId' => $register_id,
    ':firstName' => $first_name,
    ':lastName' => $last_name,
    ':email' => $email,
    ':passwd' => $passwd,
    ':home' => $home
  ]);
  
  return $stmt_create_new_user;
}