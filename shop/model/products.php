<?php

require_once __DIR__ . '/dbConn.php';

function get_products()
{
  $sql = 'SELECT `id`, `title`, `description`, `price`  FROM products';
  $stmt = get_db()->query($sql, PDO::FETCH_ASSOC);

  return $stmt;
}