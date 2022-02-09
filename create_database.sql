-- DROP OLD TABLES
DROP TABLE IF EXISTS `posts`;
DROP TABLE IF EXISTS `users`;

-- CREATE NEW TABLES
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

CREATE TABLE IF NOT EXISTS `posts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(128) NOT NULL,
  `body` TEXT NOT NULL,
  `image` VARCHAR(128) NOT NULL DEFAULT '/public/img/default.jpg',
  `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` INT UNSIGNED NOT NULL,
  `published` BOOLEAN NOT NULL DEFAULT FALSE,
  CONSTRAINT `FK_posts_user` FOREIGN KEY (`author`) REFERENCES `users`(`id`),
  PRIMARY KEY (`id`)
);

-- ADD TEST USERS AND SOME POSTS
-- USERS
INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `role`)
VALUES('Mike', 'Mayer', 'mike@mayer.com', 'test', 'ADMIN');
INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `role`)
VALUES('Susanne', 'Schnell', 'susanne@schnell.com', 'test', 'EMPLOYEE');
INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `role`)
VALUES('Richard', 'Regen', 'richard@regen.com', 'test', 'CUSTOMER');
INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `role`)
VALUES('Nina', 'Nacht', 'nina@nacht.com', 'test', 'CUSTOMER');
-- POSTS
INSERT INTO `posts` (`title`, `body`, `author`)
VALUES('Post 1', 'Just a post for testing', '1');
INSERT INTO `posts` (`title`, `body`, `author`)
VALUES('Post 2', 'Just a post for testing', '1');
INSERT INTO `posts` (`title`, `body`, `author`)
VALUES('Post 3', 'Just a post for testing', '2');
INSERT INTO `posts` (`title`, `body`, `author`)
VALUES('Post 4', 'Just a post for testing', '2');