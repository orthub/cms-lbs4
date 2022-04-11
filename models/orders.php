<?php

require_once __DIR__ . '/database.php';

function get_order_overview_for_user(string $userId)
{
  $sql_order_overview = 'SELECT `orders_id`, `user_id`, `order_date`, `status`, `delivery_address_id`
                          FROM `orders`
                          WHERE `user_id` = :userId
                          ORDER BY `order_date` DESC';
  $stmt_order_overview = get_db()->prepare($sql_order_overview);
  $stmt_order_overview->execute([':userId' => $userId]);

  return $stmt_order_overview->fetchAll();
}