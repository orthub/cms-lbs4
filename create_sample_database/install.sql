-- DROP DATABASE
DROP DATABASE IF EXISTS cms_shop;

-- CREATE NEW DATABASE
CREATE DATABASE IF NOT EXISTS cms_shop DEFAULT CHARACTER SET utf8mb4;
USE cms_shop;

-- DROP OLD TABLES IF EXISTS
DROP TABLE IF EXISTS `order_products`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `delivery_address`;
DROP TABLE IF EXISTS `cart`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `posts`;
DROP TABLE IF EXISTS `addresses`;
DROP TABLE IF EXISTS `users`;

-- CREATE CMS TABLES
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(24) NOT NULL,
  `last_name` VARCHAR(36) NOT NULL,
  `email` VARCHAR(64) NOT NULL,
  `password` VARCHAR(128) NOT NULL,
  `role` ENUM('ADMIN', 'EMPLOYEE', 'CUSTOMER') NOT NULL DEFAULT 'CUSTOMER',
  UNIQUE KEY `email` (`email`),
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `country` VARCHAR(64) NOT NULL,
  `city` VARCHAR(64) NOT NULL,
  `zip_code` INT NOT NULL,
  `street` VARCHAR(64) NOT NULL,
  `street_number` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_address_users` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

CREATE TABLE IF NOT EXISTS `posts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(128) NOT NULL,
  `body` TEXT NOT NULL,
  `image` VARCHAR(128) NOT NULL DEFAULT '/cms/img/default.jpg',
  `author` INT UNSIGNED NOT NULL,
  `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published` BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_posts_users` FOREIGN KEY (`author`) REFERENCES `users`(`id`)
);
-- CREATE TEST ACCOUNTS
-- ADMIN USER
INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `role`)
VALUES("mike", "mayer", "test", "test", "ADMIN");
INSERT INTO `addresses` (`user_id`, `country`, `city`, `zip_code`, `street`, `street_number`)
VALUES("1", "Austria", "Vienna", "1100", "Kurzweg", "1a");
-- NON ADMIN USERS
INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `role`)
VALUES("susanne", "stehauf", "test2", "test", "EMPLOYEE");
INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `role`)
VALUES("john", "regen", "test3", "test", "CUSTOMER");
INSERT INTO `addresses` (`user_id`, `country`, `city`, `zip_code`, `street`, `street_number`)
VALUES("2", "Austria", "Vienna", "1100", "Kurzisweg", "1b");
INSERT INTO `addresses` (`user_id`, `country`, `city`, `zip_code`, `street`, `street_number`)
VALUES("3", "Austria", "Vienna", "1100", "Kurzerweg", "1c");
-- CREATE SAMPLE POSTS
INSERT INTO `posts` (`title`, `body`, `author`, `created`)
VALUES('Post 1', 'Post number one testing, this post should display 50 chars in index.
        If it`s viewed in single post, you should see all and the lorem stuff.
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
        Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, 
        when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
        It has survived not only five centuries, but also the leap into electronic typesetting, 
        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset 
        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like 
        Aldus PageMaker including versions of Lorem Ipsum.', '1', '2021-01-23 02:05:19');
-- WAITFOR DELAY '00:00:02';
INSERT INTO `posts` (`title`, `body`, `author`, `created`)
VALUES('Post 2', 'Post number two testing. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '1', '2021-05-11 02:16:37');
-- WAITFOR DELAY '00:00:02'
INSERT INTO `posts` (`title`, `body`, `author`, `created`)
VALUES('Post 3', 'Post number three testing. This is a short post.', '2', '2021-011-10 15:32:01');
-- WAITFOR DELAY '00:00:02';
INSERT INTO `posts` (`title`, `body`, `author`, `created`)
VALUES('Post 4', 'Post number four testing. Hell yeah, i think this will finally work.', '2', '2022-01-16 09:12:53');
-- WAITFOR DELAY '00:00:02';
INSERT INTO `posts` (`title`, `body`, `author`, `created`)
VALUES('Post 5', 'Post number five testing. So, this script is working, hope the delay works also, for sorting the posts. Meh, not working!', '1', '2022-02-21 09:35:42');


-- CREATE SHOP TABLES
CREATE TABLE IF NOT EXISTS `products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(128) NOT NULL,
  `slug` VARCHAR(128) NOT NULL,
  `description` text NOT NULL,
  `price` INT NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `cart` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL DEFAULT 0,
  `product_id` INT UNSIGNED NOT NULL DEFAULT 0,
  `quantity` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id_user_id` (`product_id`, `user_id`),
  -- CONSTRAINT `FK_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `delivery_address` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `city` text NOT NULL,
  `street` text NOT NULL,
  `street_number` varchar(64) NOT NULL,
  `zip_code` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_delivery_address` (`user_id`),
  CONSTRAINT `FK_user_delivery_address` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- CREATE TABLE IF NOT EXISTS `orders` (
--   `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
--   `order_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   `status` ENUM("NEW", "PAYED") NOT NULL DEFAULT "NEW",
--   `user_id` INT UNSIGNED NOT NULL,
--   `orders_id` INT UNSIGNED NOT NULL,
--   `delivery_address_id` INT UNSIGNED NOT NULL,
--   PRIMARY KEY (`id`),
--   UNIQUE KEY (`orders_id`),
--   CONSTRAINT `FK_order_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
--   CONSTRAINT `FK_order_delivery_address` FOREIGN KEY (`delivery_address_id`) REFERENCES `delivery_address` (`id`)
-- );

CREATE TABLE `orders` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum("new", "payed") NOT NULL DEFAULT "new",
  `user_id` INT UNSIGNED NOT NULL,
  `orders_id` INT UNSIGNED NOT NULL,
  `delivery_address_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`orders_id`),
  CONSTRAINT `FK_order_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_order_delivery_address` FOREIGN KEY (`delivery_address_id`) REFERENCES `delivery_address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- CREATE TABLE IF NOT EXISTS `order_products` (
--   `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
--   `order_id` INT UNSIGNED NOT NULL,
--   `product_id` INT UNSIGNED NOT NULL,
--   `quantity` INT UNSIGNED NOT NULL,
--   PRIMARY KEY (`id`),
--   CONSTRAINT `FK_order_products_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
--   CONSTRAINT `FK_order_products_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
--   );

  CREATE TABLE `order_products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` INT UNSIGNED NOT NULL,
  `product_id` INT UNSIGNED NOT NULL,
  `quantity` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_order_products_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_order_products_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`orders_id`) ON DELETE NO ACTION ON UPDATE CASCADE
  );

-- ADD SOME PRODUCTS
INSERT INTO `products` (`title`, `description`, `price`, `slug`)
VALUES("Product 1", "testproduct one", 5491, "product-1");
INSERT INTO `products` (`title`, `description`, `price`, `slug`)
VALUES("Product 2", "testproduct two", 6711, "product-2");
INSERT INTO `products` (`title`, `description`, `price`, `slug`)
VALUES("Product 3", "testproduct three", 1799, "product-3");
INSERT INTO `products` (`title`, `description`, `price`, `slug`)
VALUES("Product 4", "testproduct four", 1999, "product-4");