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