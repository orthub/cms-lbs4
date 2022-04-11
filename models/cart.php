<?php

require_once __DIR__ . '/database.php';

function add_to_cart(string $userId, string $productId, string $quantity): bool
{
  $sql_add_to_cart = 'INSERT INTO `cart`
                      SET quantity = 1, `user_id` = :userId , `product_id` = :productId
                      ON DUPLICATE KEY UPDATE quantity = quantity + :quantity';
  $stmt_add_to_cart = get_db()->prepare($sql_add_to_cart);
  $stmt_add_to_cart->execute([
    ':userId' => $userId,
    ':productId' => $productId,
    ':quantity' => $quantity
  ]);
  remove_quantity_from_product($productId);
  
  if ($stmt_add_to_cart === false) {
    return false;
  }

  return true;
}

function remove_quantity_from_product(string $productId)
{
  $sql_remove_quantity_from_product = 'UPDATE `products` 
                                        SET `quantity` = `quantity` -1 
                                        WHERE `id` = :productId';
  $stmt_remove_quantity_from_product = get_db()->prepare($sql_remove_quantity_from_product);
  $stmt_remove_quantity_from_product->execute([':productId' => $productId]);
  
  return $stmt_remove_quantity_from_product;
}

function get_cart_products_for_user(string $userId)
{
  $sql_get_cart_products_for_user = 'SELECT `product_id`, `cart`.`quantity`, `title`, `price`
                                      FROM `cart`
                                      JOIN `products` ON(cart.product_id = products.id)
                                      WHERE `user_id` = :userId';
  $stmt_get_cart_products_for_user = get_db()->prepare($sql_get_cart_products_for_user);
  $stmt_get_cart_products_for_user->execute([':userId' => $userId]);
  $res_get_cart_products_for_user = $stmt_get_cart_products_for_user->fetchAll();

  return $res_get_cart_products_for_user;
}

function remove_product_from_cart(string $userId, string $productId, string $quantity)
{
  $sql_remove_product_from_cart = 'DELETE FROM `cart`
                                    WHERE `product_id` = :productId
                                    AND `user_id` = :userId';
  $stmt_remove_product_from_cart = get_db()->prepare($sql_remove_product_from_cart);
  $stmt_remove_product_from_cart->execute([
    ':productId' => $productId,
    ':userId' => $userId
  ]);
  restore_product_quantity_from_cart($quantity, $productId);
}

function get_quantity_from_cart(string $productId)
{
  $sql_get_quantity_from_cart = 'SELECT `quantity` 
                                  FROM `cart` 
                                  WHERE `product_id` = :productId';
  $stmt_get_quantity_from_cart = get_db()->prepare($sql_get_quantity_from_cart);
  $stmt_get_quantity_from_cart->execute([':productId' => $productId]);
  $res_get_quantity_from_cart = $stmt_get_quantity_from_cart->fetchColumn();

  return $res_get_quantity_from_cart;
}

function restore_product_quantity_from_cart(string $quantity, string $productId)
{
  $sql_restore_product_quantity_from_cart = 'UPDATE `products` SET `quantity` = `quantity` + :quantity
                                              WHERE `id` = :productId';
  $stmt_restore_product_quantity_from_cart = get_db()->prepare($sql_restore_product_quantity_from_cart);
  $stmt_restore_product_quantity_from_cart->execute([
    ':quantity' => $quantity,
    ':productId' => $productId
  ]);
}

function count_products_for_user($userId)
{
  $sql_count_products_for_user = 'SELECT SUM(quantity)
                                  FROM cart
                                  WHERE `user_id` = :userId';
  $stmt_count_products_for_user = get_db()->prepare($sql_count_products_for_user);
  $stmt_count_products_for_user->execute([':userId' => $userId]);
  $res_count_products_for_user = $stmt_count_products_for_user->fetchColumn();
  
  return $res_count_products_for_user;
}