<?php

require_once __DIR__ . '/database.php';

function get_all_users_and_roles()
{
  $sql_get_all_users_and_roles = 'SELECT `id`, `first_name`, `email`, `role`
                                  FROM `users`';
  $stmt_get_all_users_and_roles = get_db()->query($sql_get_all_users_and_roles);
  $result_get_all_users_and_roles = $stmt_get_all_users_and_roles->fetchAll();
  
  return $result_get_all_users_and_roles;
}

function get_all_roles()
{
  $sql_get_all_roles = 'SELECT DISTINCT `role` 
                        FROM `users` 
                        ORDER BY `role` DESC';
  $stmt_get_all_roles = get_db()->query($sql_get_all_roles);
  $result_get_all_roles = $stmt_get_all_roles->fetchAll();
  
  return $result_get_all_roles;
}

function set_new_role(string $role, string $user_id)
{
  $sql_set_new_role = 'UPDATE `users`
                        SET `role` = :newRole
                        WHERE `id` = :userId';
  $stmt_set_new_role = get_db()->prepare($sql_set_new_role);
  $stmt_set_new_role->execute([
    ':newRole' => $role,
    ':userId' => $user_id
  ]);
  
  return $stmt_set_new_role;
}

function delete_user(string $userId)
{
  $sql_delete_user = 'DELETE FROM `users` 
                      WHERE `id` = :userId';
  $stmt_delete_user = get_db()->prepare($sql_delete_user);
  $stmt_delete_user->execute([':userId' => $userId]);
  
  return $stmt_delete_user;
}

function get_last_ten_products()
{
  $sql_get_last_ten_products = 'SELECT `id`, `title`, `slug`, `category`, `quantity`, `price`, `img_url` 
                                FROM `products`
                                ORDER BY `id` DESC LIMIT 10';
  $stmt_get_last_ten_products = get_db()->query($sql_get_last_ten_products);
  $res_get_last_ten_products = $stmt_get_last_ten_products->fetchAll();

  return $res_get_last_ten_products;
}

function get_all_products_for_admin()
{
  $sql_get_all_products_for_admin = 'SELECT `id`, `title`, SUBSTRING(`description`, 1, 40) 
                                      AS `description`, `slug`, `category`, `quantity`, `price`, `status`, `img_url`
                                      FROM `products` 
                                      ORDER BY `id`';
  $stmt_get_all_products_for_admin = get_db()->query($sql_get_all_products_for_admin);
  $res_get_all_products_for_admin = $stmt_get_all_products_for_admin->fetchAll();
  
  return $res_get_all_products_for_admin;
}

function get_all_posts()
{
  $sql_get_all_posts = 'SELECT `posts`.`id`, `title`, SUBSTRING(`body`, 1, 40)   
                        AS `body`, `author`, `created`, `first_name`, `published`
                        FROM `posts`
                        JOIN `users` ON(`author` = `users`.`id`)
                        ORDER BY `created` DESC';
  $statement_get_all_posts = get_db()->query($sql_get_all_posts);
  // $statement_post_from_id->execute([':postId' => $post_id]);
  $result_get_all_posts = $statement_get_all_posts->fetchAll();
  
  return $result_get_all_posts;
}