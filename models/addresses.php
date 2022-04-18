<?php

require_once __DIR__ . '/database.php';

function get_delivery_address(string $userId)
{
  $sql_get_delivery_address = 'SELECT `id`, `user_id`, `city`, `street`, `street_number`, `zip_code`
                                FROM `delivery_address`
                                WHERE `user_id` = :userId';
  $stmt_get_delivery_address = get_db()->prepare($sql_get_delivery_address);
  $stmt_get_delivery_address->execute([':userId' => $userId]);
  $res_get_delivery_address = $stmt_get_delivery_address->fetchAll();

  return $res_get_delivery_address;
}

function save_delivery_address(string $userId, string $city, string $street, string $streetNumber, string $zipCode)
{
  $sql_save_delivery_address = 'INSERT INTO `delivery_address`
                                SET `user_id` = :userId, 
                                    `city` = :city, 
                                    `street` = :street, 
                                    `street_number` = :streetNumber, 
                                    `zip_code` = :zipCode';
  $stmt_save_delivery_address = get_db()->prepare($sql_save_delivery_address);
  $stmt_save_delivery_address->execute([
    ':userId' => $userId,
    ':city' => $city,
    ':street' => $street,
    ':streetNumber' => $streetNumber,
    ':zipCode' => $zipCode,
  ]);
  $res_save_delivery_address = $stmt_save_delivery_address->fetchAll();

  return $res_save_delivery_address;
}

function delete_address_by_id(string $userId, string $addressId)
{
  try {
    $sql = 'DELETE FROM `delivery_address`
            WHERE `id` = :addressId
            AND `user_id` = :userId';
    $stmt = get_db()->prepare($sql);
    $stmt->execute([
      ':addressId' => $addressId,
      ':userId' => $userId
    ]);
  } catch (\Exception $e) {
    return false;
  }
  return true;
}