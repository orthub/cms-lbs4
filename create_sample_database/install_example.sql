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
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `contact`;
DROP TABLE IF EXISTS `contact_status`;
DROP TABLE IF EXISTS `users_archive`;
-- CREATE CMS TABLES
CREATE TABLE IF NOT EXISTS `users` (
  `id` VARCHAR(28) NOT NULL,
  `first_name` VARCHAR(24) NOT NULL,
  `last_name` VARCHAR(36) NOT NULL,
  `email` VARCHAR(64) NOT NULL,
  `password` VARCHAR(128) NOT NULL,
  `role` ENUM('ADMIN', 'EMPLOYEE', 'CUSTOMER') NOT NULL DEFAULT 'CUSTOMER',
  `home` VARCHAR(64),
  UNIQUE KEY `email` (`email`),
  PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS `posts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(128) NOT NULL,
  `body` TEXT NOT NULL,
  `author` VARCHAR(28) NOT NULL,
  `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published` ENUM('LIVE', 'DRAFT') NOT NULL DEFAULT 'DRAFT',
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_posts_users` FOREIGN KEY (`author`) REFERENCES `users`(`id`)
);
-- CREATE TEST ACCOUNTS
-- ADMIN USER
INSERT INTO
  `users` (
    `id`,
    `first_name`,
    `last_name`,
    `email`,
    `password`,
    `role`,
    `home`
  )
VALUES(
    "1116546574897163",
    "Roland",
    "Ortner",
    "admin@stiftl.at",
    "$2y$10$CbyJ749EvzB1scPFSiuVNepXvcvBK5C5SXirMbhQBY3YjYVP3.jPS",
    "ADMIN",
    "/storage/1116546574897163/"
  );
-- EMPLOYEES
INSERT INTO
  `users` (
    `id`,
    `first_name`,
    `last_name`,
    `email`,
    `password`,
    `role`,
    `home`
  )
VALUES(
    "125546832165",
    "John",
    "Doe",
    "employee@stiftl.at",
    "$2y$10$CbyJ749EvzB1scPFSiuVNepXvcvBK5C5SXirMbhQBY3YjYVP3.jPS",
    "EMPLOYEE",
    "/storage/125546832165/"
  );
INSERT INTO
  `users` (
    `id`,
    `first_name`,
    `last_name`,
    `email`,
    `password`,
    `role`,
    `home`
  )
VALUES(
    "22552833165",
    "Martin",
    "Doe",
    "employee.martin@stiftl.at",
    "$2y$10$CbyJ749EvzB1scPFSiuVNepXvcvBK5C5SXirMbhQBY3YjYVP3.jPS",
    "EMPLOYEE",
    "/storage/22552833165/"
  );
INSERT INTO
  `users` (
    `id`,
    `first_name`,
    `last_name`,
    `email`,
    `password`,
    `role`,
    `home`
  )
VALUES(
    "225524462235",
    "Martina",
    "Hofreiter",
    "employee.martina@stiftl.at",
    "$2y$10$CbyJ749EvzB1scPFSiuVNepXvcvBK5C5SXirMbhQBY3YjYVP3.jPS",
    "EMPLOYEE",
    "/storage/225524462235/"
  );
INSERT INTO
  `users` (
    `id`,
    `first_name`,
    `last_name`,
    `email`,
    `password`,
    `role`,
    `home`
  )
VALUES(
    "223344699235",
    "Hubert",
    "Kleber",
    "employee.hubert@stiftl.at",
    "$2y$10$CbyJ749EvzB1scPFSiuVNepXvcvBK5C5SXirMbhQBY3YjYVP3.jPS",
    "EMPLOYEE",
    "/storage/223344699235/"
  );
-- CUSTOMERS
INSERT INTO
  `users` (
    `id`,
    `first_name`,
    `last_name`,
    `email`,
    `password`,
    `role`,
    `home`
  )
VALUES(
    "77986546432165",
    "Johannes",
    "Maulbeer",
    "j.maulbeer@keinemail.com",
    "$2y$10$CbyJ749EvzB1scPFSiuVNepXvcvBK5C5SXirMbhQBY3YjYVP3.jPS",
    "CUSTOMER",
    "/storage/77986546432165/"
  );
INSERT INTO
  `users` (
    `id`,
    `first_name`,
    `last_name`,
    `email`,
    `password`,
    `role`,
    `home`
  )
VALUES(
    "84986546532165",
    "Bill",
    "Hates",
    "customer.bill@stiftl.at",
    "$2y$10$CbyJ749EvzB1scPFSiuVNepXvcvBK5C5SXirMbhQBY3YjYVP3.jPS",
    "CUSTOMER",
    "/storage/84986546532165/"
  );
-- CREATE SAMPLE POSTS
INSERT INTO
  `posts` (`title`, `body`, `author`, `created`)
VALUES(
    'Post 1',
    'Post number one testing, this post should display 50 chars in index.
        If it`s viewed in single post, you should see all and the lorem stuff.
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
        Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, 
        when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
        It has survived not only five centuries, but also the leap into electronic typesetting, 
        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset 
        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like 
        Aldus PageMaker including versions of Lorem Ipsum.',
    '1116546574897163',
    '2021-01-23 02:05:19'
  );
-- WAITFOR DELAY '00:00:02';
INSERT INTO
  `posts` (`title`, `body`, `author`, `created`)
VALUES(
    'Post 2',
    'Post number two testing. Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
    '1116546574897163',
    '2021-05-11 02:16:37'
  );
-- WAITFOR DELAY '00:00:02'
INSERT INTO
  `posts` (`title`, `body`, `author`, `created`)
VALUES(
    'Post 3',
    'Post number three testing. This is a short post.',
    '125546832165',
    '2021-011-10 15:32:01'
  );
-- WAITFOR DELAY '00:00:02';
INSERT INTO
  `posts` (`title`, `body`, `author`, `created`)
VALUES(
    'Post 4',
    'Post number four testing. Hell yeah, i think this will finally work.',
    '125546832165',
    '2022-01-16 09:12:53'
  );
-- WAITFOR DELAY '00:00:02';
INSERT INTO
  `posts` (`title`, `body`, `author`, `created`)
VALUES(
    'Post 5',
    'Post number five testing. So, this script is working, hope the delay works also, for sorting the posts. Meh, not working!',
    '125546832165',
    '2022-02-21 09:35:42'
  );
-- CREATE SHOP TABLES
  CREATE TABLE IF NOT EXISTS `products` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(128) NOT NULL,
    `slug` VARCHAR(128) NOT NULL,
    `description` text NOT NULL,
    `price` INT NOT NULL,
    `category` ENUM(
      "Buntstift",
      "Kugelschreiber",
      "Gel-Schreiber",
      "Spezial"
    ),
    `img_url` VARCHAR(128) DEFAULT "/img/products/default.jpg",
    `quantity` INT UNSIGNED DEFAULT "0",
    `status` ENUM("LIVE", "DRAFT") DEFAULT "DRAFT",
    PRIMARY KEY (`id`)
  );
CREATE TABLE IF NOT EXISTS `cart` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` VARCHAR(28) NOT NULL,
    `product_id` INT UNSIGNED NOT NULL DEFAULT 0,
    `quantity` INT UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `product_id_user_id` (`product_id`, `user_id`),
    -- CONSTRAINT `FK_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
    CONSTRAINT `FK_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE
  );
CREATE TABLE IF NOT EXISTS `delivery_address` (
    `id` INT(16) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` VARCHAR(28) NOT NULL,
    `city` TEXT NOT NULL,
    `street` TEXT NOT NULL,
    `street_number` VARCHAR(64) NOT NULL,
    `zip_code` VARCHAR(64) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `FK_user_delivery_address` (`user_id`),
    CONSTRAINT `FK_user_delivery_address` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
  );
CREATE TABLE `orders` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `order_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `status` enum("new", "payed") NOT NULL DEFAULT "new",
    `user_id` VARCHAR(28) NOT NULL,
    `orders_id` VARCHAR(128) NOT NULL,
    `order_price` INT,
    `delivery_address_id` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY (`orders_id`),
    CONSTRAINT `FK_order_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
    CONSTRAINT `FK_order_delivery_address` FOREIGN KEY (`delivery_address_id`) REFERENCES `delivery_address` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
  );
CREATE TABLE `order_products` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `order_id` VARCHAR(128) NOT NULL,
    `product_id` INT UNSIGNED NOT NULL,
    `quantity` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `FK_order_products_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
    CONSTRAINT `FK_order_products_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`orders_id`) ON DELETE CASCADE ON UPDATE CASCADE
  );
-- ARCHIVE FOR DELETED USERS
  CREATE TABLE `users_archive` (
    `id` VARCHAR(28) NOT NULL,
    `first_name` VARCHAR(24) NOT NULL,
    `last_name` VARCHAR(36) NOT NULL,
    `email` VARCHAR(64) NOT NULL,
    `role` VARCHAR(16) NOT NULL,
    `invoice_path` VARCHAR(255),
    UNIQUE KEY `email` (`email`),
    PRIMARY KEY (`id`)
  );
CREATE TABLE `contact_status` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `status` VARCHAR(24) NOT NULL,
    PRIMARY KEY (`id`)
  );
-- CONTACT TABLE
  CREATE TABLE `contact` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(128) NOT NULL,
    `title` VARCHAR(64) NOT NULL,
    `message` TEXT NOT NULL,
    `status_id` INT UNSIGNED NOT NULL,
    `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `FK_contact_status_contact` FOREIGN KEY (`status_id`) REFERENCES `contact_status` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
  );
-- ADD SOME PRODUCTS
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 1",
    "testproduct one",
    1499,
    "product-1",
    "Kugelschreiber",
    10,
    "/img/products/default.jpg",
    "LIVE"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 2",
    "testproduct two",
    1499,
    "product-2",
    "Kugelschreiber",
    10,
    "/img/products/default.jpg",
    "LIVE"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 3",
    "testproduct three",
    1499,
    "product-3",
    "Gel-Schreiber",
    10,
    "/img/products/default.jpg",
    "LIVE"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 4",
    "testproduct four",
    1999,
    "product-4",
    "Buntstift",
    10,
    "/img/products/default.jpg",
    "LIVE"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 5",
    "testproduct five",
    1199,
    "product-5",
    "Buntstift",
    10,
    "/img/products/default.jpg",
    "DRAFT"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 6",
    "testproduct six",
    1999,
    "product-6",
    "Kugelschreiber",
    10,
    "/img/products/default.jpg",
    "DRAFT"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 7",
    "testproduct seven",
    2199,
    "product-7",
    "Gel-Schreiber",
    10,
    "/img/products/default.jpg",
    "LIVE"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 8",
    "testproduct eight",
    2199,
    "product-8",
    "Gel-Schreiber",
    10,
    "/img/products/default.jpg",
    "LIVE"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 9",
    "testproduct nine",
    1499,
    "product-9",
    "Buntstift",
    10,
    "/img/products/default.jpg",
    "LIVE"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 10",
    "testproduct ten",
    1199,
    "product-10",
    "Kugelschreiber",
    10,
    "/img/products/default.jpg",
    "LIVE"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 11",
    "testproduct eleven",
    1799,
    "product-11",
    "Gel-Schreiber",
    10,
    "/img/products/default.jpg",
    "DRAFT"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 12",
    "testproduct twelve",
    2199,
    "product-12",
    "Buntstift",
    10,
    "/img/products/default.jpg",
    "LIVE"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 13",
    "testproduct thirteen",
    1499,
    "product-13",
    "Buntstift",
    10,
    "/img/products/default.jpg",
    "LIVE"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 14",
    "testproduct fourteen",
    1199,
    "product-14",
    "Buntstift",
    10,
    "/img/products/default.jpg",
    "LIVE"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 15",
    "testproduct fivteen",
    1999,
    "product-15",
    "Kugelschreiber",
    10,
    "/img/products/default.jpg",
    "DRAFT"
  );
INSERT INTO
  `products` (
    `title`,
    `description`,
    `price`,
    `slug`,
    `category`,
    `quantity`,
    `img_url`,
    `status`
  )
VALUES(
    "Product 16",
    "testproduct sixteen",
    2199,
    "product-16",
    "Gel-Schreiber",
    10,
    "/img/products/default.jpg",
    "LIVE"
  );
-- ADD CONTACT STATUS
INSERT INTO
  `contact_status` (`status`)
VALUES('NEU');
INSERT INTO
  `contact_status` (`status`)
VALUES('GELESEN');
INSERT INTO
  `contact_status` (`status`)
VALUES('BEANTWORTET');