<?php

require_once __DIR__ . '/database.php';

function get_last_five_posts()
{
  $sql_five_posts = 'SELECT `posts`.`id`, `title`, SUBSTRING(`body`, 1, 50) AS `body`, `image`, `author`, `created`, `first_name`
                    FROM `posts`
                    JOIN `users` ON(`author` = `users`.`id`)
                    ORDER BY `id` ASC
                    LIMIT 5';
  $result_five_posts = get_cms_db()->query($sql_five_posts);
  return $result_five_posts->fetchAll();
}

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