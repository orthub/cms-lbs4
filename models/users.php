<?php

require_once __DIR__ . '/database.php';


function get_all_users()
{
  $sql_get_all_users = 'SELECT `users`.`id`, `first_name`, `last_name`, `email`, `role_id`, `user_role`.`role`
                        FROM `users`
                        JOIN `user_role` ON(`role_id` = `user_role`.`id`)';
  $stmt_get_all_users = get_db()->query($sql_get_all_users, PDO::FETCH_ASSOC);
  return $stmt_get_all_users;
}

function get_all_roles()
{
  $sql_get_all_roles = 'SELECT `id`, `role` 
                        FROM `user_role` 
                        ORDER BY `role` DESC';
  $stmt_get_all_roles = get_db()->query($sql_get_all_roles);
  $result_get_all_roles = $stmt_get_all_roles->fetchAll();
  
  return $result_get_all_roles;
}

function get_user_email_by_id(string $userId)
{
  $sql_get_user_email_by_id = 'SELECT `email` FROM `users` WHERE `id` = :userId';
  $statement_get_user_email_by_id = get_db()->prepare($sql_get_user_email_by_id);
  $statement_get_user_email_by_id->execute([':userId' => $userId]);
  $result_get_user_email_by_id = $statement_get_user_email_by_id->fetchColumn();

  return $result_get_user_email_by_id;
}

function get_user_data_by_id(string $userId)
{
  $sql_get_user_data_by_id = 'SELECT `users`.`id`, `first_name`, `last_name`, `email`, `role_id`, `home`, `user_role`.`role`
                              FROM `users`
                              JOIN `user_role` ON(`role_id` = `user_role`.`id`)
                              WHERE `users`.`id` = :userId';
  $statement_get_user_data_by_id = get_db()->prepare($sql_get_user_data_by_id);
  $statement_get_user_data_by_id->execute([':userId' => $userId]);
  $result_get_user_data_by_id = $statement_get_user_data_by_id->fetch();

  return $result_get_user_data_by_id;
}

function move_user_to_archive(string $userId, string $firstName, string $lastName, string $email, string $roleId, string $invoicePath)
{
  $sql_move_user_to_archive = 'INSERT INTO `users_archive`
                                SET `id` = :userId, `first_name` = :firstName, `last_name` = :lastName,
                                     `email` = :email, `role_id` = :roleId, `invoice_path` = :invoicePath';
  $statement_move_user_to_archive = get_db()->prepare($sql_move_user_to_archive);
  $statement_move_user_to_archive->execute([
    ':userId' => $userId,
    ':firstName' => $firstName,
    ':lastName' => $lastName,
    ':email' => $email,
    ':roleId' => $roleId,
    ':invoicePath' => $invoicePath
  ]);
}

function delete_user_by_id(string $userId)
{
  try {
    $sql_delete_user_by_id = 'DELETE FROM `users` WHERE `id` = :userId';
    $statement_delete_user_by_id = get_db()->prepare($sql_delete_user_by_id);
    $statement_delete_user_by_id->execute([':userId' => $userId]);
  } catch (\Exception $e) {
    return false;
  }
  return true;
}

function count_posts_from_user(string $userId)
{
  $sql_search_post_from_user = 'SELECT COUNT(`author`)
                                FROM `posts`
                                WHERE `author` = :userId';
  $statement_seach_post_from_user = get_db()->prepare($sql_search_post_from_user);
  $statement_seach_post_from_user->execute([':userId' => $userId]);
  $result_search_post_from_user = $statement_seach_post_from_user->fetchColumn();

  return $result_search_post_from_user;
}

function change_author(string $oldAuthor, string $newAuthor)
{
  $sql_change_author = 'UPDATE `posts`
                        SET `author` = :newAuthor
                        WHERE `author` = :oldAuthor';
  $statement_change_author = get_db()->prepare($sql_change_author);
  $statement_change_author->execute([
    ':oldAuthor' => $oldAuthor,
    ':newAuthor' => $newAuthor
  ]);

  return $statement_change_author;
}

function get_archived_users()
{
  $sql_get_archived_users = 'SELECT `users_archive`.`id`, `first_name`, `last_name`, `email`, 
                                    `role_id`, `invoice_path`, `user_role`.`role`
                              FROM `users_archive`
                              JOIN `user_role` ON(`role_id` = `user_role`.`id`)';
  $stmt_get_archived_users = get_db()->query($sql_get_archived_users, PDO::FETCH_ASSOC);

  return $stmt_get_archived_users;
}

function get_current_password_by_id(string $userId)
{
  $sql_get_current_password_by_id = 'SELECT `password`
                                FROM `users`
                                WHERE `id` = :userId';
  $statement_get_current_password_by_id = get_db()->prepare($sql_get_current_password_by_id);
  $statement_get_current_password_by_id->execute([':userId' => $userId]);
  $result_get_current_password_by_id = $statement_get_current_password_by_id->fetchColumn();

  return $result_get_current_password_by_id;
}

function set_new_password_by_id(string $userId, string $newPassword)
{
  $hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);
  try {
    $sql = 'UPDATE `users`
            SET `password` = :newPassword
            WHERE `id` = :userId';
    $stmt = get_db()->prepare($sql);
    $stmt->execute([
      ':newPassword' => $hashPassword,
      ':userId' => $userId
    ]);
  } catch (\Exception $e) {
    return false;
  }
  return true;
}