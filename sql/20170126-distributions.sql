CREATE TABLE `distribution` (
  `dist_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `allot_id` int(11) NOT NULL,
  `amount` decimal(10,6) NOT NULL,
  `rating_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
