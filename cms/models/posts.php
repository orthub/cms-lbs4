<?php

require_once __DIR__ . '/database.php';
/**
 * Get the last 5 posts from database
 * Post preview (body) limited to 120 chars
 */
function get_last_five_posts()
{
  $sql_five_posts = 'SELECT `posts`.`id`, `title`, SUBSTRING(`body`, 1, 120) AS `body`, `image`, `author`, `created`, `first_name`
                    FROM `posts`
                    JOIN `users` ON(`author` = `users`.`id`)
                    ORDER BY `created` DESC
                    LIMIT 5';
  $result_five_posts = get_cms_db()->query($sql_five_posts);
  return $result_five_posts->fetchAll();
}

/**
 * Call the function with the give post id and return the whole post
 */
function get_full_post_from_id(string $post_id)
{
  $sql_post_from_id = 'SELECT `posts`.`id`, `title`, `body`, `image`, `author`, `created`, `first_name`
                      FROM `posts`
                      JOIN `users` ON(`author` = `users`.`id`)
                      WHERE `posts`.`id` = :postId';

  $statement_post_from_id = get_cms_db()->prepare($sql_post_from_id);
  $statement_post_from_id->execute([':postId' => $post_id]);
  $result_post_from_id = $statement_post_from_id->fetch();
  return $result_post_from_id;
}