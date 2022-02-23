<?php

require_once __DIR__ . '/dbConn.php';

function get_orders_for_user(string $userId)
{
  $sql = 'SELECT `order_date`, `status`, `user_id`, `orders_id`, `delivery_address_id`, `product_id`
          FROM `orders`
          JOIN `order_products`
          ON orders.orders_id = order_products.order_id
          ORDER BY `order_date` DESC';
  $stmt = get_db()->prepare($sql);
  $stmt->execute();

  return $stmt->fetchAll();
}