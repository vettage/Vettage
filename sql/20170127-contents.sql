ALTER TABLE `contents` ADD `latitude` DECIMAL(18,14) NOT NULL AFTER `type`, ADD `longitude` DECIMAL(18,14) NOT NULL AFTER `latitude`, ADD `full_address` VARCHAR(255) NOT NULL AFTER `longitude`;

ALTER TABLE `contents` ADD `alias` VARCHAR(255) NOT NULL AFTER `full_address`;
