
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE `cart` (
  `oid` int(8) NOT NULL,
  `value` int(7) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `users.id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `item` (
  `reference` int(8) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `value` int(8) NOT NULL,
  `chassis` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `traction` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `transmission` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(375) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `description_long` varchar(3000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(8) NOT NULL,
  `pic` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `messages` (
  `mid` int(8) NOT NULL,
  `users.id` int(8) NOT NULL,
  `message` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `quantity` (
  `item.reference` int(8) NOT NULL,
  `cart.oid` int(8) NOT NULL,
  `quantity` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `users` (
  `id` int(7) NOT NULL,
  `nick` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `type` enum('admin','user') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'user',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `surname` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `theme` enum('index.css','index0.css','index1.css') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'index.css'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



INSERT INTO `users` (`id`, `nick`, `email`, `password`, `address`, `type`, `name`, `surname`, `theme`) VALUES
(14, 'all', 'all@all.com', '827ccb0eea8a706c4c34a16891f84e7b', 'all', 'user', 'all', 'all', 'index.css');


ALTER TABLE `cart`
  ADD PRIMARY KEY (`oid`,`users.id`),
  ADD KEY `users.id` (`users.id`);


ALTER TABLE `item`
  ADD PRIMARY KEY (`reference`),
  ADD KEY `subcategory_name` (`chassis`);


ALTER TABLE `messages`
  ADD PRIMARY KEY (`mid`,`users.id`);

ALTER TABLE `quantity`
  ADD PRIMARY KEY (`item.reference`,`cart.oid`),
  ADD KEY `cart.oid` (`cart.oid`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nick` (`nick`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `cart`
  MODIFY `oid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

ALTER TABLE `item`
  MODIFY `reference` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `messages`
  MODIFY `mid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`users.id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;


ALTER TABLE `quantity`
  ADD CONSTRAINT `quantity_ibfk_1` FOREIGN KEY (`cart.oid`) REFERENCES `cart` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `r.item` FOREIGN KEY (`item.reference`) REFERENCES `item` (`reference`) ON DELETE CASCADE ON UPDATE CASCADE;
