<?php

require_once __DIR__ . '/../../cms/models/database.php';

function add_to_cart(string $userId, string $productId, string $quantity): bool
{
  $sql = 'INSERT INTO `cart`
          SET quantity = 1, `user_id` = :userId , `product_id` = :productId
          ON DUPLICATE KEY UPDATE quantity = quantity + :quantity';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([
    ':userId' => $userId,
    ':productId' => $productId,
    ':quantity' => $quantity
  ]);

  if ($stmt === false) {
    return false;
  }

  return true;
}

function get_cart_products_for_user(string $userId)
{
  $sql = 'SELECT `product_id`, `quantity`, `title`, `price`
          FROM `cart`
          JOIN `products` ON(cart.product_id = products.id)
          WHERE `user_id` = :userId';
  $stmt = get_db()->prepare($sql);

  $stmt->execute([':userId' => $userId]);

  $res = $stmt->fetchAll();
  return $res;
}

function remove_product_from_cart(string $userId, string $productId)
{
  $sql = 'DELETE FROM `cart`
          WHERE `product_id` = :productId
          AND `user_id` = :userId';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([
    ':productId' => $productId,
    ':userId' => $userId
  ]);
}

function count_products_for_user($userId)
{
  $sql = 'SELECT SUM(quantity)
          FROM cart
          WHERE `user_id` = :userId';

  $stmt = get_db()->prepare($sql);

  $stmt->execute([':userId' => $userId]);

  $res = $stmt->fetchColumn();
  return $res;
}