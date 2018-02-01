SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `config` (
  `setting` varchar(100) NOT NULL,
  `value` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `config` (`setting`, `value`) VALUES
('attack_mitigation_time', ''),
('attempts_before_ban', ''),
('attempts_before_verify', ''),
('bcrypt_cost', ''),
('cookie_domain', ''),
('cookie_forget', ''),
('cookie_http', ''),
('cookie_name', ''),
('cookie_path', '
('cookie_remember', ''),
('cookie_secure', ''),
('emailmessage_suppress_activation', ''),
('emailmessage_suppress_reset', ''),
('mail_charset', 'UTF-8'),
('password_min_score', ''),
('request_key_expiration', ''),
('site_activation_page', ''),
('site_email', ''),
('site_key', ''),
('site_name', 'Vettage'),
('site_password_reset_page', ''),
('site_timezone', ''),
('site_url', 'http://vettage'),
('smtp', ''),
('smtp_auth', ''),
('smtp_host', ''),
('smtp_password', ''),
('smtp_port', ''),
('smtp_security', NULL),
('smtp_username', ''),
('table_attempts', 'attempts'),
('table_requests', 'requests'),
('table_sessions', 'sessions'),
('table_users', 'users'),
('verify_email_max_length', ''),
('verify_email_min_length', ''),
('verify_email_use_banlist', ''),
('verify_password_min_length', '');


ALTER TABLE `config`
  ADD UNIQUE KEY `setting` (`setting`);

