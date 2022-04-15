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

function get_all_messages()
{
  $sql_get_all_messages = 'SELECT `contact`.`id` AS `message_id`, `contact_status`.`id`, `title`, `status`, 
                            SUBSTRING(`message`, 1, 50) AS `message`, 
                            `status_id`, `created`
                            FROM `contact`
                            JOIN `contact_status` ON(`status_id` = `contact_status`.`id`)
                            ORDER BY `created` DESC';
$result_get_all_messages = get_db()->query($sql_get_all_messages);

return $result_get_all_messages->fetchAll();
}

function count_new_messages_for_userbar()
{
  $sql_count_new_messages_for_userbar = 'SELECT COUNT(`id`) 
                                          FROM `contact` 
                                          WHERE `status_id` = 1';
  $stmt_count_new_messages_for_userbar = get_db()->query($sql_count_new_messages_for_userbar);
  return $stmt_count_new_messages_for_userbar->fetchColumn();
}

function get_single_message_by_id(string $messageId)
{
  $sql_get_single_message_by_id = 'SELECT `contact`.`id` AS `message_id`, 
                                    `contact_status`.`id`, `title`, `status`, `email`,
                                    `message`, `status_id`, `created`
                                    FROM `contact`
                                    JOIN `contact_status` ON(`status_id` = `contact_status`.`id`)
                                    WHERE `contact`.`id` = :messageId';
  $statement_get_single_message_by_id = get_db()->prepare($sql_get_single_message_by_id);
  $statement_get_single_message_by_id->execute([':messageId' => $messageId]);
  $result_get_single_message_by_id = $statement_get_single_message_by_id->fetch();

  return $result_get_single_message_by_id;
}

function get_all_message_status()
{
  $sql_get_all_message_status = 'SELECT `id`, `status`
                                  FROM `contact_status`';
  $statement_get_all_message_status = get_db()->query($sql_get_all_message_status);

  return $statement_get_all_message_status->fetchAll();

}

function change_message_status(string $messageId, string $status)
{
  $sql_change_message_status = 'UPDATE `contact`
                                SET `status_id` = :newStatus
                                WHERE `id` = :messageId';
  $statement_change_message_status = get_db()->prepare($sql_change_message_status);
  $statement_change_message_status->execute([
    ':newStatus' => $status,
    ':messageId' => $messageId
  ]);

  return $statement_change_message_status;
}

function get_new_status_from_message(string $messageId)
{
  $sql_get_new_status_from_message = 'SELECT `contact`.`id` AS `message_id`, 
                                      `contact_status`.`id`, `status`, `status_id`
                                      FROM `contact`
                                      JOIN `contact_status` ON(`status_id` = `contact_status`.`id`)
                                      WHERE `contact`.`id` = :messageId';
  $statement_get_new_status_from_message = get_db()->prepare($sql_get_new_status_from_message);
  $statement_get_new_status_from_message->execute([':messageId' => $messageId]);
  $result_get_new_status_from_message = $statement_get_new_status_from_message->fetch();

  return $result_get_new_status_from_message;
}

function delete_message_by_id(string $messageId)
{
  try {
    $sql_delete_message_by_id = 'DELETE FROM `contact`
                                  WHERE `id` = :messageId';
    $statement_delete_message_by_id = get_db()->prepare($sql_delete_message_by_id);
    $statement_delete_message_by_id->execute([':messageId' => $messageId]);
  } catch (\Exception $e) {
    return false;
  }
  return true;
}