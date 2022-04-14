<?php

require_once __DIR__ . '/database.php';

function create_message(string $email, string $title, string $message)
{
  $sql_create_message = 'INSERT INTO `contact`
                          SET `title` = :contactTitle,
                              `message` = :contactMessage,
                              `email` = :contactEmail,
                              `status_id` = 1';
  $statement_create_message = get_db()->prepare($sql_create_message);
  $statement_create_message->execute([
    ':contactTitle' => $title,
    ':contactMessage' => $message,
    ':contactEmail' => $email
  ]);

  return $statement_create_message;
}