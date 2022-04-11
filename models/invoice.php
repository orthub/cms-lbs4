<?php
require_once __DIR__ . '/database.php';


function get_order_with_user_id(string $user_id)
{
  $sql_get_order_with_user_id = 'SELECT `orders_id`,`delivery_address_id`,`user_id`, `order_date`, `status`
                                  FROM `orders`
                                  WHERE `user_id` = :userId';
  $stmt_get_order_with_user_id = get_db()->prepare($sql_get_order_with_user_id);
  $stmt_get_order_with_user_id->execute([':userId' => $user_id]);
  $res_get_order_with_user_id = $stmt_get_order_with_user_id->fetch();
  
  return $res_get_order_with_user_id;
}

// ???
// --`products`.`id`,
// -- JOIN `products` ON  `product_id` = `products`.`id`
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
  $sql_get_product_price = 'SELECT `price`, `title` 
                            FROM `products` 
                            WHERE `id` = :productId';
  $stmt_get_product_price = get_db()->prepare($sql_get_product_price);
  $stmt_get_product_price->execute([':productId' => $product_id]);
  $res_get_product_price = $stmt_get_product_price->fetch();
  
  return $res_get_product_price;
}