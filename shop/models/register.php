<?php

require_once __DIR__ . '/../../cms/models/database.php';

function register_account(string $firstName, string $lastName, string $email, string $password): bool
{
  $sql = 'INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`)
          VALUES(:firstName, :lastName, :email, :password)';
  $res = get_db()->prepare($sql);
  $res->execute([
    ':firstName' => $firstName,
    ':lastName' => $lastName,
    ':email' => $email,
    ':password' => $password
  ]);

  if ($res === false) {
    return false;
  }
  return true;
}