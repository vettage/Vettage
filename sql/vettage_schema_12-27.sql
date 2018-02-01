
-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 68.178.143.144
-- Generation Time: Dec 27, 2016 at 06:18 AM
-- Server version: 5.5.43
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vettage`
--

-- --------------------------------------------------------

--
-- Table structure for table `allotment`
--

DROP TABLE IF EXISTS `allotment`;
CREATE TABLE `allotment` (
  `allot_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `percent` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contributor_id` int(11) NOT NULL,
  `editor_id` int(11) NOT NULL,
  PRIMARY KEY (`allot_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=222 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `mem_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `blog_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_desc` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `blog_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(2) NOT NULL,
  `date_added` datetime NOT NULL,
  `tags` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE `blog_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2898000 ;

-- --------------------------------------------------------

--
-- Table structure for table `connect`
--

DROP TABLE IF EXISTS `connect`;
CREATE TABLE `connect` (
  `conn_id` int(11) NOT NULL AUTO_INCREMENT,
  `raw_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-accept,2-reject',
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `request_type` int(11) NOT NULL COMMENT '1-contributor-editor,2-editor-contributor',
  PRIMARY KEY (`conn_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE `contact_us` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_con_id` int(11) NOT NULL,
  `mem_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mem_email` varchar(350) COLLATE utf8_unicode_ci NOT NULL,
  `mem_phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_date` date NOT NULL,
  `ipaddress` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(2) NOT NULL COMMENT '0-Open,1-Closed',
  PRIMARY KEY (`con_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `raw_id` int(11) NOT NULL,
  `content_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `types` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `home_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `content_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `story` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `embed_code_link` text COLLATE utf8_unicode_ci NOT NULL,
  `contributor` int(11) NOT NULL,
  `editor` int(11) NOT NULL,
  `story_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `ipaddress` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(2) NOT NULL,
  `featured` int(2) NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=119 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_category`
--

DROP TABLE IF EXISTS `content_category`;
CREATE TABLE `content_category` (
  `catd_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`catd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_likes`
--

DROP TABLE IF EXISTS `content_likes`;
CREATE TABLE `content_likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `like_by` int(11) NOT NULL,
  `bitcoins` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `like_date` datetime NOT NULL,
  `like_ip` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_ratings`
--

DROP TABLE IF EXISTS `content_ratings`;
CREATE TABLE `content_ratings` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `rating_by` int(11) NOT NULL,
  `importance` int(11) NOT NULL,
  `credibility` int(11) NOT NULL,
  `timeline` int(11) NOT NULL,
  `appearance` int(11) NOT NULL,
  `rating` decimal(2,2) NOT NULL,
  `bitcoins` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `rating_date` datetime NOT NULL,
  `rating_ip` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`rating_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=236 ;

-- --------------------------------------------------------

--
-- Table structure for table `editor_pricing`
--

DROP TABLE IF EXISTS `editor_pricing`;
CREATE TABLE `editor_pricing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `editor` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `month` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `temp_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `msg` text COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT '1- Administrator,2- General, 3- Transaction, 4- Order, 5- User',
  `status` int(11) NOT NULL COMMENT '0- Inactive, 1- Active',
  PRIMARY KEY (`temp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_cat_id` int(11) NOT NULL,
  `question` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-Inactive, 1- Active',
  `added_date` datetime NOT NULL,
  `added_ip_address` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `english` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `indonesian` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `files` varchar(30) NOT NULL,
  `date_added` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `mem_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(2) NOT NULL COMMENT '1-Contributor,2-Editor,3-Subscriber',
  `level` int(4) NOT NULL COMMENT '1-free,2-Micropayments / Sharing,3-per view,4-monthly,5-institutional',
  `payment_status` int(2) NOT NULL,
  `subscibe_id` int(11) NOT NULL,
  `experience` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `expertise` text COLLATE utf8_unicode_ci NOT NULL,
  `interests` text COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `folio_link` text COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `ip` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(2) NOT NULL,
  `contribute_bit_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `editor_bit_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `stroy_view_count` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`mem_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=90 ;

-- --------------------------------------------------------

--
-- Table structure for table `member_upgrades`
--

DROP TABLE IF EXISTS `member_upgrades`;
CREATE TABLE `member_upgrades` (
  `upgrade_id` int(11) NOT NULL AUTO_INCREMENT,
  `mem_id` int(11) NOT NULL,
  `level` int(4) NOT NULL COMMENT '1-free,2-per story,3-monthly,4-institutional',
  `price` float NOT NULL,
  `date` datetime NOT NULL,
  `expire_date` datetime NOT NULL,
  `payment_type` int(11) NOT NULL DEFAULT '0' COMMENT '0-no payment,1-paypal,2-bitwall',
  PRIMARY KEY (`upgrade_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `ipaddress` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `raw_media`
--

DROP TABLE IF EXISTS `raw_media`;
CREATE TABLE `raw_media` (
  `raw_id` int(11) NOT NULL AUTO_INCREMENT,
  `raw_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contributor_id` int(11) NOT NULL,
  `editor_id` int(11) NOT NULL,
  `format` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `copyright` int(11) NOT NULL COMMENT '1-yes,2-no',
  `date` datetime NOT NULL,
  `links` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_event` int(11) NOT NULL,
  `zipcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`raw_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `country_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58087 ;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE `subscriptions` (
  `subscibe_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `cost` decimal(4,2) NOT NULL,
  PRIMARY KEY (`subscibe_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

DROP TABLE IF EXISTS `system_settings`;
CREATE TABLE `system_settings` (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `adm_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adm_email` varchar(375) COLLATE utf8_unicode_ci NOT NULL,
  `adm_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adm_support_email` varchar(375) COLLATE utf8_unicode_ci NOT NULL,
  `adm_info_email` varchar(375) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_link` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_link` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `linked_in_link` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pinterest_link` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dribble_link` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(2) NOT NULL COMMENT '0 - Inactive, 1-Active',
  PRIMARY KEY (`adm_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;
