<?php

require_once __DIR__ . '/database.php';

function get_quantity_product_from_cart(string $userId)
{
  $sql_get_quantity_product_from_cart = 'SELECT `product_id`, `quantity` 
                                          FROM cart
                                          WHERE `user_id` = :userId';
  $stmt_get_quantity_product_from_cart = get_db()->prepare($sql_get_quantity_product_from_cart);
  $stmt_get_quantity_product_from_cart->execute([':userId' => $userId]);
  return $stmt_get_quantity_product_from_cart->fetchAll();
}



function delivery_address_for_order(string $userId, string $addressId)
{
  $sql_delivery_address_for_order = 'SELECT `id`, `city`, `street`, `street_number`, `zip_code`
                                      FROM delivery_address
                                      WHERE `id` = :addressId
                                      AND `user_id` = :userId';
  $stmt_delivery_address_for_order = get_db()->prepare($sql_delivery_address_for_order);
  $stmt_delivery_address_for_order->execute([
    ':userId' => $userId,
    ':addressId' => $addressId
  ]);

  return $stmt_delivery_address_for_order->fetch();
}

function username_for_order(string $userId)
{
  $sql_username_for_order = 'SELECT first_name, last_name
                              FROM users
                              WHERE id = :userId';
  $stmt_username_for_order = get_db()->prepare($sql_username_for_order);
  $stmt_username_for_order->execute([':userId' => $userId]);

  return $stmt_username_for_order->fetch();
}

function save_order(string $userId, string $orderId, string $addressId, string $totalPrice)
{
  $sql_save_order = 'INSERT INTO `orders`
                      SET `status` = "NEW",
                      `user_id` = :userId,
                      `orders_id` = :orderId,
                      `delivery_address_id` = :addressId,
                      `order_price` = :totalPrice';
  $stmt_save_order = get_db()->prepare($sql_save_order);
  $stmt_save_order->execute([
    ':userId' => $userId,
    ':orderId' => $orderId,
    ':addressId' => $addressId,
    ':totalPrice' => $totalPrice
  ]);
  return $stmt_save_order;
  // $res_save_order = $stmt_save_order->fetch();
  // // return $stmt;
  // if ($stmt_save_order == true) {
  //   return $res_save_order;
  // }
  // return false;
}

function get_order_id_from_user(string $userId)
{
  $sql_get_order_id_from_user = 'SELECT order_id 
                                  FROM orders WHERE user_id = :userId';
  $stmt_get_order_id_from_user = get_db()->prepare($sql_get_order_id_from_user);
  $stmt_get_order_id_from_user->execute([':userId' => $userId]);
  return $stmt_get_order_id_from_user->fetchAll();
}

function save_order_products(string $userId, string $orderId)
{
  $cartProducts = get_quantity_product_from_cart($userId);

  foreach ($cartProducts as $value) {
    $sql_save_order_products = 'INSERT INTO `order_products`
                                SET `order_id` = :orderId,
                                `product_id` = :productId,
                                `quantity` = :quantity';
    $stmt_save_order_products = get_db()->prepare($sql_save_order_products);
    $stmt_save_order_products->execute([
      ':orderId' => $orderId,
      ':productId' => $value['product_id'],
      ':quantity' => $value['quantity']
    ]);
  }
  if ($stmt_save_order_products == 1) {
    return true;
  }
  return false;
}

function delete_products_from_cart(string $userId)
{
  $sql_delete_products_from_cart = 'DELETE FROM `cart` 
                                    WHERE `user_id` = :userId';
  $stmt_delete_products_from_cart = get_db()->prepare($sql_delete_products_from_cart);
  $stmt_delete_products_from_cart->execute([':userId' => $userId]);

}