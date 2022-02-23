<?php
require_once __DIR__ . '/dbConn.php';

$db = get_db();

$dropTables = 'DROP TABLE IF EXISTS `order_products`;
              DROP TABLE IF EXISTS `orders`;
              DROP TABLE IF EXISTS `delivery_address`;
              DROP TABLE IF EXISTS `cart`;
              DROP TABLE IF EXISTS `user`;
              DROP TABLE IF EXISTS `products`;';

$db->exec($dropTables);

$createTables = 'CREATE TABLE `user` (
              `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
              `first_name` varchar(24) NOT NULL DEFAULT " ",
              `last_name` varchar(32) NOT NULL DEFAULT " ",
              `email` varchar(128) NOT NULL DEFAULT " ",
              `password` varchar(128) NOT NULL DEFAULT " ",
              PRIMARY KEY (`id`),
              UNIQUE KEY `email` (`email`)
              );

CREATE TABLE `delivery_address` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `city` text NOT NULL,
  `street` text NOT NULL,
  `street_number` varchar(64) NOT NULL,
  `zip_code` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_delivery_address` (`user_id`),
  CONSTRAINT `FK_user_delivery_address` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `products` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL DEFAULT " ",
  `description` text NOT NULL,
  `price` int(16) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
);

CREATE TABLE `cart` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL DEFAULT 0,
  `product_id` int(16) unsigned NOT NULL DEFAULT 0,
  `quantity` int(8) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id_user_id` (`product_id`, `user_id`),
  CONSTRAINT `FK_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE `orders` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `order_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum("new", "payed") NOT NULL DEFAULT "new",
  `user_id` int(16) unsigned NOT NULL,
  `orders_id` int(16) unsigned NOT NULL,
  `delivery_address_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`orders_id`),
  CONSTRAINT `FK_order_to_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_order_delivery_address` FOREIGN KEY (`delivery_address_id`) REFERENCES `delivery_address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE `order_products` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(16) unsigned NOT NULL,
  `product_id` int(16) unsigned NOT NULL,
  `quantity` int(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_order_products_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_order_products_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`orders_id`) ON DELETE NO ACTION ON UPDATE CASCADE
  );
';
$db->exec($createTables);

$addProducts = 'INSERT INTO `products` (`title`, `description`, `price`, `slug`)
                VALUES("Produkt 1", "testprodukt eins", 5491, "product-1"
                );
                INSERT INTO `products` (`title`, `description`, `price`, `slug`)
                VALUES("Produkt 2", "testprodukt zwei", 6711, "product-2"
                );
                INSERT INTO `products` (`title`, `description`, `price`, `slug`)
                VALUES("Produkt 3", "testprodukt drei", 1799, "product-3"
                );
                INSERT INTO `products` (`title`, `description`, `price`, `slug`)
                VALUES("Produkt 4", "testprodukt vier", 1999, "product-4"
                );
                ';

$db->exec($addProducts);

$createUser = 'INSERT INTO `user` (`first_name`,`last_name`,`email`,`password`)
                VALUES("Mike", "Mayer", "mike", "mike")';
$db->exec($createUser);

// rename(__DIR__ . '/install.php', __DIR__ . '/install_example');