<?php

require_once __DIR__ . '/../../cms/models/database.php';

function get_delivery_address(string $userId)
{
  $sql = 'SELECT `id`, `user_id`, `city`, `street`, `street_number`, `zip_code`
          FROM delivery_address
          WHERE `user_id` = :userId';

  $stmt = get_db()->prepare($sql);
  $stmt->execute([':userId' => $userId]);

  $res = $stmt->fetchAll();

  return $res;
}

function save_delivery_address(string $userId, string $city, string $street, string $streetNumber, string $zipCode)
{
  $sql = 'INSERT INTO `delivery_address`
          SET `user_id` = :userId, `city` = :city, `street` = :street, `street_number` = :streetNumber, `zip_code` = :zipCode';

  $stmt = get_db()->prepare($sql);
  $stmt->execute([
    ':userId' => $userId,
    ':city' => $city,
    ':street' => $street,
    ':streetNumber' => $streetNumber,
    ':zipCode' => $zipCode,
  ]);

  $res = $stmt->fetchAll();

  return $res;
}