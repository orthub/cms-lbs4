<?php

require_once __DIR__ . '/dbConn.php';

function get_quantity_product_from_cart(string $userId)
{
  $sql = 'SELECT `product_id`, `quantity` 
          FROM cart
          WHERE `user_id` = :userId';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([':userId' => $userId]);
  return $stmt->fetchAll();
}



function delivery_address_for_order(string $userId, string $addressId)
{
  $sql = 'SELECT `id`, `city`, `street`, `street_number`, `zip_code`
          FROM delivery_address
          WHERE `id` = :addressId
          AND `user_id` = :userId';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([
    ':userId' => $userId,
    ':addressId' => $addressId
  ]);

  return $stmt->fetch();
}

function username_for_order(string $userId)
{
  $sql = 'SELECT first_name, last_name
          FROM user
          WHERE id = :userId';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([':userId' => $userId]);

  return $stmt->fetch();
}

function save_order(string $userId, string $orderId, string $addressId) #: bool
{
  $sql = 'INSERT INTO `orders`
          SET `status` = "new",
          `user_id` = :userId,
          `orders_id` = :orderId,
          `delivery_address_id` = :addressId';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([
    ':userId' => $userId,
    ':orderId' => $orderId,
    ':addressId' => $addressId
  ]);

  // return $stmt;
  if ($stmt == true) {
    return true;
  }
  return false;
}

function get_order_id_from_user(string $userId)
{
  $sql = 'SELECT order_id FROM orders WHERE user_id = :userId';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([':userId' => $userId]);
  return $stmt->fetchAll();
}

function save_order_products(string $userId, string $orderId) #: bool
{
  $cartProducts = get_quantity_product_from_cart($userId);

  foreach ($cartProducts as $value) {
    $sql = 'INSERT INTO `order_products`
              SET `order_id` = :orderId,
              `product_id` = :productId,
              `quantity` = :quantity';
    $stmt = get_db()->prepare($sql);
    $stmt->execute([
      ':orderId' => $orderId,
      ':productId' => $value['product_id'],
      ':quantity' => $value['quantity']
    ]);
  }
  // return $stmt;
  if ($stmt == true) {
    return true;
  }
  return false;
}

function delete_products_from_cart(string $userId) #: bool
{
  $sql = 'DELETE FROM `cart`
          WHERE `user_id` = :userId';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([':userId' => $userId]);
  // return $stmt;
  if ($stmt == false) {
    return false;
  }

  return true;
}