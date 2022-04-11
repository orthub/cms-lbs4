<?php

require_once __DIR__ . '/database.php';

function check_email_on_login(string $email)
{
  $sql_check_email = 'SELECT `email` 
                      FROM `users`
                      WHERE `email` = :email';
  $statement_check_email = get_db()->prepare($sql_check_email);
  $statement_check_email->execute(['email' => $email]);
  $result_check_email = $statement_check_email->fetchColumn();

  return $result_check_email;
}

function check_password_on_login(string $email, string $password)
{
  $sql_check_password = 'SELECT `id` `email`, `password`
                        FROM `users`
                        WHERE `email` = :email
                        AND `password` = :passwd';
  $statmenent_check_password = get_db()->prepare($sql_check_password);
  $statmenent_check_password->execute([
    ':email' => $email,
    ':passwd' => $password
  ]);
  $result_check_password = $statmenent_check_password->fetchColumn();

  return $result_check_password;
}


function get_login(string $email): array
{
  $sql_get_login = 'SELECT `id`, `email`, `password` 
          FROM `users` 
          WHERE `email` = :email';
  $statement_get_login = get_db()->prepare($sql_get_login);
  $statement_get_login->execute([':email' => $email]);
  $result_get_login = $statement_get_login->fetchAll();

  return $result_get_login;
}

function get_user_name(string $user_id)
{
  $sql_get_user_name = 'SELECT `first_name` 
                        FROM `users` 
                        WHERE `id` = :id';
  $stmt_get_user_name = get_db()->prepare($sql_get_user_name);
  $stmt_get_user_name->execute([':id' => $user_id]);
  $res_get_user_name = $stmt_get_user_name->fetchColumn();
  
  return $res_get_user_name;
}

/**
 * CHECK IF SOME FUNCTIONS ARE USEFULL
 */

function search_mail(string $email): bool
{
  $sql_search_mail = 'SELECT `email` FROM `users` WHERE `email` = :Email';
  $stmt_search_mail = get_db()->prepare($sql_search_mail);
  $stmt_search_mail->execute([':Email' => $email]);
  $res_search_mail = $stmt_search_mail->fetchColumn();
  
  return $res_search_mail;
}

function get_password_from_email(string $email)
{
  $sql_match_mail_password = 'SELECT `password` FROM `users`
                              WHERE `email` = :Email';
  $stmt_match_mail_password = get_db()->prepare($sql_match_mail_password);
  $stmt_match_mail_password->execute([
    ':Email' => $email,
  ]);
  $res_match_mail_password = $stmt_match_mail_password->fetchColumn();

  return $res_match_mail_password;
}

function get_user_id(string $email)
{
  $sql_match_mail_password = 'SELECT `id` FROM `users`
                              WHERE `email` = :Email';
  $stmt_match_mail_password = get_db()->prepare($sql_match_mail_password);
  $stmt_match_mail_password->execute([':Email' => $email]);
  $res_match_mail_password = $stmt_match_mail_password->fetchColumn();

  return $res_match_mail_password;
}