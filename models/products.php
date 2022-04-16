<?php

require_once __DIR__ . '/database.php';

function get_all_live_products()
{
  $sql_get_all_live_products = 'SELECT `products`.`id`, `title`, `description`, `price`, 
                                `category_id`, `img_url`, `slug`, `quantity`, `status`, `product_category`.`category` AS `cat`
                                FROM `products`
                                JOIN `product_category` ON(`category_id` = `product_category`.`id`)
                                WHERE `status` = "LIVE"
                                ORDER BY `products`.`id` ASC';
  $stmt_get_all_live_products = get_db()->query($sql_get_all_live_products, PDO::FETCH_ASSOC);

  return $stmt_get_all_live_products;
}

function get_categories()
{
  $sql_get_categories = 'SELECT `id`, `category`
                          FROM `product_category`';
  $stmt_get_categories = get_db()->query($sql_get_categories);
  $result_get_categories = $stmt_get_categories->fetchAll();

  return $result_get_categories;
}

function get_category_by_id(string $categoryId)
{
  $sql_get_category_by_id = 'SELECT `category`
                              FROM `product_category`
                              WHERE `id` = :categoryId';
  $stmt_get_category_by_id = get_db()->prepare($sql_get_category_by_id);
  $stmt_get_category_by_id->execute([':categoryId' => $categoryId]);
  $result_get_category_by_id = $stmt_get_category_by_id->fetchColumn();

  return $result_get_category_by_id;
}

function get_products_from_category(string $get_category_id): array
{
  $sql_get_products_from_category = 'SELECT `products`.`id`, `title`, `description`, `price`,
                                            `category_id`, `slug`, `img_url`, `quantity`, `status`, `product_category`.`category` AS `cat`
                                      FROM `products`
                                      JOIN `product_category` ON(`category_id` = `product_category`.`id`)
                                      WHERE `category_id` = :getCategory';
  $stmt_get_products_from_category = get_db()->prepare($sql_get_products_from_category);
  $stmt_get_products_from_category->execute([':getCategory' => $get_category_id]);
  return $stmt_get_products_from_category->fetchAll();
}

function new_product(string $product, string $slug, string $description, string $price, string $categoryId, string $quantity)
{
  $sql_new_product = 'INSERT INTO `products`
                      SET `title` = :title, 
                          `slug` = :slug, 
                          `description` = :productDescription, 
                          `price` = :price, 
                          `category_id` = :categoryId, 
                          `quantity` = :quantity,
                          `status` = "DRAFT"';
  $stmt_new_product = get_db()->prepare($sql_new_product);
  $stmt_new_product->execute([
    ':title' => $product,
    ':slug' => $slug,
    ':productDescription' => $description,
    ':price' => $price,
    ':categoryId' => $categoryId,
    ':quantity' => $quantity
  ]);
  
  return $stmt_new_product;
}

function get_product_by_slug(string $slug)
{
  $sql_get_product_by_slug = 'SELECT `products`.`id`, `title`, `slug`, `description`, `price`, 
                                      `category_id`, `img_url`, `quantity`, `status`, `product_category`.`category` AS `cat`
                              FROM `products`
                              JOIN `product_category` ON(`category_id` = `product_category`.`id`)
                              WHERE `slug` = :slug';
  $stmt_get_product_by_slug = get_db()->prepare($sql_get_product_by_slug);
  $stmt_get_product_by_slug->execute([':slug' => $slug]);
  $res_get_product_by_slug = $stmt_get_product_by_slug->fetch();
  
  return $res_get_product_by_slug;
}

function save_edited_product(string $productId, string $title, string $description, string $price, string $categoryId, string $quantity, string $status)
{
  $sql_save_edited_product = 'UPDATE `products`
                              SET `title` = :title, 
                                  `description` = :productDescription, 
                                  `price` = :price,
                                  `category_id` = :categoryId, 
                                  `quantity` = :quantity,
                                  `status` = :productStatus
                              WHERE `id` = :productId';
  $stmt_save_edited_product = get_db()->prepare($sql_save_edited_product);
  $stmt_save_edited_product->execute([
    ':title' => $title,
    ':productDescription' => $description,
    ':price' => $price,
    ':categoryId' => $categoryId,
    ':quantity' => $quantity,
    ':productId' => $productId,
    ':productStatus' => $status
  ]);
  
  return $stmt_save_edited_product;
}

function delete_product_by_id(string $productId): bool
{
  try {
    $sql_delete_product_by_id = 'DELETE FROM `products` 
                                  WHERE `id` = :productId';
    $stmt_delete_product_by_id = get_db()->prepare($sql_delete_product_by_id);
    $stmt_delete_product_by_id->execute([':productId' => $productId]);
  } catch (\Exception $e) {
    return false;
  }

  return true;
}

function check_slugs(string $slug)
{
  $sql_check_slugs = 'SELECT `slug`
                      FROM `products`
                      WHERE `slug` = :slug';
  $stmt_check_slugs = get_db()->prepare($sql_check_slugs);
  $stmt_check_slugs->execute([':slug' => $slug]);
  $res_check_slugs = $stmt_check_slugs->fetchColumn();

  return $res_check_slugs;
}

function change_product_status_by_id(string $productId,string $status)
{
  $sql_change_product_status_by_id = 'UPDATE `products`
                              SET `status` = :productStatus
                              WHERE `id` = :productId';
  $stmt_change_product_status_by_id = get_db()->prepare($sql_change_product_status_by_id);
  $stmt_change_product_status_by_id->execute([
    ':productId' => $productId,
    ':productStatus' => $status
  ]);
  
  return $stmt_change_product_status_by_id;
}

function update_product_image_by_slug(string $path, string $slug)
{
  $sql_update_product_image_by_slug = 'UPDATE `products`
                                        SET `img_url` = :newPath
                                        WHERE `slug` = :slug';
  $statement_update_product_image_by_slug = get_db()->prepare($sql_update_product_image_by_slug);
  $statement_update_product_image_by_slug->execute([
    ':newPath' => $path,
    ':slug' => $slug
  ]);
  
  return $statement_update_product_image_by_slug;
}

function get_slug_path_by_id(string $productId)
{
  $sql_get_slug_path_by_id = 'SELECT `id`, `img_url`, `slug`
                              FROM `products`
                              WHERE `id` = :productId';
  $statement_get_slug_path_by_id = get_db()->prepare($sql_get_slug_path_by_id);
  $statement_get_slug_path_by_id->execute([':productId' => $productId]);
  $result_get_slug_path_by_id = $statement_get_slug_path_by_id->fetch();

  return $result_get_slug_path_by_id;
}

function get_all_products()
{
  $sql_get_all_products = 'SELECT `products`.`id`, `title`, `description`, `price`, 
                                  `category_id`, `img_url`, `slug`, `quantity`, `status`, `product_category`.`category` AS `cat`
                            FROM `products`
                            JOIN `product_category` ON(`category_id` = `product_category`.`id`)
                            ORDER BY `products`.`id` DESC';
$stmt_get_all_products = get_db()->query($sql_get_all_products, PDO::FETCH_ASSOC);

return $stmt_get_all_products;
}