<?php
require_once __DIR__ . '/database.php';


function get_order_with_user_and_order_id(string $user_id, string $order_id)
{
  $sql_get_order_with_user_and_order_id = 'SELECT `orders_id`,`delivery_address_id`,`user_id`, `order_date`, `status`, `order_price`
                                  FROM `orders`
                                  WHERE `user_id` = :userId
                                  AND `orders_id` = :orderId';
  $stmt_get_order_with_user_and_order_id = get_db()->prepare($sql_get_order_with_user_and_order_id);
  $stmt_get_order_with_user_and_order_id->execute([
    ':userId' => $user_id,
    ':orderId' => $order_id
  ]);
  $res_get_order_with_user_and_order_id = $stmt_get_order_with_user_and_order_id->fetch(PDO::FETCH_ASSOC);
  
  return $res_get_order_with_user_and_order_id;
}

function get_products_for_order(string $order_id)
{
  $sql_get_products_for_order = 'SELECT `order_id`, `product_id`, `quantity`
                                  FROM `order_products`
                                  WHERE `order_id` = :order_id';
  $stmt_get_products_for_order = get_db()->prepare($sql_get_products_for_order);
  $stmt_get_products_for_order->execute([':order_id' => $order_id]);
  $res_get_products_for_order = $stmt_get_products_for_order->fetchAll();
  
  return $res_get_products_for_order;
}

function get_product_order_info(int $product_id)
{
  $sql_get_product_price = 'SELECT `price`, `title`, `quantity`
                            FROM `products` 
                            WHERE `id` = :productId';
  $stmt_get_product_price = get_db()->prepare($sql_get_product_price);
  $stmt_get_product_price->execute([':productId' => $product_id]);
  $res_get_product_price = $stmt_get_product_price->fetch(PDO::FETCH_ASSOC);
  
  return $res_get_product_price;
}

function get_user_email_by_id(string $userId)
{
  $sql_get_user_email_by_id = 'SELECT `id`, `email`
                                FROM `users`
                                WHERE `id` = :userId';
  $statement_get_user_email_by_id = get_db()->prepare($sql_get_user_email_by_id);
  $statement_get_user_email_by_id->execute([':userId' => $userId]);
  $result_get_user_email_by_id = $statement_get_user_email_by_id->fetch(PDO::FETCH_ASSOC);

  return $result_get_user_email_by_id;
}