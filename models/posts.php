<?php

require_once __DIR__ . '/database.php';
/**
 * Get the last 5 posts from database
 * Post preview (body) limited to 120 chars
 */
function get_last_ten_posts()
{
  $sql_five_posts = 'SELECT `posts`.`id`, `title`, SUBSTRING(`body`, 1, 120) 
                      AS `body`, `author`, `created`, `first_name`, `published`
                      FROM `posts`
                      JOIN `users` ON(`author` = `users`.`id`)
                      ORDER BY `created` DESC
                      LIMIT 10';
  $result_five_posts = get_db()->query($sql_five_posts);
  
  return $result_five_posts->fetchAll();
}

/**
 * Call the function with the give post id and return the whole post
 */
function get_post_by_id(string $post_id)
{
  $sql_post_from_id = 'SELECT `posts`.`id`, `title`, `body`, `author`, `created`, `first_name`, `published`
                        FROM `posts`
                        JOIN `users` ON(`author` = `users`.`id`)
                        WHERE `posts`.`id` = :postId';

  $statement_post_from_id = get_db()->prepare($sql_post_from_id);
  $statement_post_from_id->execute([':postId' => $post_id]);
  $result_post_from_id = $statement_post_from_id->fetch();
  
  return $result_post_from_id;
}

function new_post(string $title, string $body, string $userId)
{
  $sql_new_post = 'INSERT INTO `posts`
                    SET `title` = :title, 
                        `body` = :body, 
                        `author` = :userId';
  $stmt_new_post = get_db()->prepare($sql_new_post);
  $stmt_new_post->execute([
    ':title' => $title,
    ':body' => $body,
    ':userId' => $userId
  ]);

  return $stmt_new_post;
}

function delete_post_by_id(string $postId)
{
  try {
    $sql_delete_post_by_id = 'DELETE FROM `posts` 
                              WHERE `id` = :postId';
    $stmt_delete_post_by_id = get_db()->prepare($sql_delete_post_by_id);
    $stmt_delete_post_by_id->execute([':postId' => $postId]);
  } catch (\Exception $e) {
    return false;
  }

  return true;
}

function change_post_status_by_id(string $postId, string $status)
{
  $sql_change_post_status_by_id = 'UPDATE `posts`
                                    SET `published` = :postStatus
                                    WHERE `id` = :postId';
$stmt_change_post_status_by_id = get_db()->prepare($sql_change_post_status_by_id);
$stmt_change_post_status_by_id->execute([
':postId' => $postId,
':postStatus' => $status
]);

return $stmt_change_post_status_by_id;
}

function save_edited_post(string $postId, string $title, string $body)
{
  $sql_save_edited_post = 'UPDATE `posts`
                            SET `title` = :postTitle,
                                `body` = :postBody
                            WHERE `id` = :postId';
  $statement_save_edited_post = get_db()->prepare($sql_save_edited_post);
  $statement_save_edited_post->execute([
    ':postTitle' => $title,
    ':postBody' => $body,
    ':postId' => $postId
  ]);

  return $statement_save_edited_post;
}