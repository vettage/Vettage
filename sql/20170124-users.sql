SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(50) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `bit_address` varchar(150) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `expertise` varchar(255) NOT NULL,
  `address` varchar(150) NOT NULL,
  `address1` varchar(150) NOT NULL,
  `country` varchar(3) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zipcode` varchar(15) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `interests` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `level` int(4) NOT NULL,
  `payment_status` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `token` varchar(150) NOT NULL,
  `story_view_count` int(5) NOT NULL,
  `available_ratings` int(5) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `folio_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
