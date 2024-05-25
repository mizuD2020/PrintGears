drop table if exists order;
drop table if exists order_item;
drop table if exists cart;
drop table if exists cart_item;
drop table if exists sticker;
drop table if exists categories;
drop table if exists user;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `sticker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL default 50,
  `image` text NOT NULL,
  `category_id` int(11) NOT NULL,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`),
  PRIMARY KEY (`id`)
); 

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `email` text not null,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `order`(
  `id` int(11) NOT NULL AUTO_INCREMENT, 
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `order_item`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `sticker_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`order_id`) REFERENCES `order`(`id`),
  FOREIGN KEY (`sticker_id`) REFERENCES `sticker`(`id`)
);

CREATE TABLE `cart`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
);

CREATE TABLE `cart_item`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `sticker_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`cart_id`) REFERENCES `cart`(`id`),
  FOREIGN KEY (`sticker_id`) REFERENCES `sticker`(`id`)
);
