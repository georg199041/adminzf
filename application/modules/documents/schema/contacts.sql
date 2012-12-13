-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 09 2012 г., 14:05
-- Версия сервера: 5.1.62-community
-- Версия PHP: 5.3.9-ZS5.6.0

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `sunny_roy`
--

-- --------------------------------------------------------

--
-- Структура таблицы `contacts_contacts`
--

DROP TABLE IF EXISTS `contacts_contacts`;
CREATE TABLE IF NOT EXISTS `contacts_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contacts_groups_id` int(11) DEFAULT NULL,
  `type` enum('ADDRESS','PHONE','EMAIL','SKYPE','LATLNG','QRCODE','IMAGE') NOT NULL DEFAULT 'ADDRESS',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  PRIMARY KEY (`id`),
  KEY `contacts_groups_id` (`contacts_groups_id`),
  KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `contacts_contacts`
--

INSERT INTO `contacts_contacts` (`id`, `contacts_groups_id`, `type`, `title`, `alias`, `description`, `image`, `enabled`) VALUES
(1, 1, 'ADDRESS', 'Адрес базы в крыму', 'crimea_address', NULL, NULL, 'YES'),
(2, 1, 'PHONE', 'Основной телефон', 'crimea_main_phone', '+38 (050) 545-33-69', NULL, 'YES'),
(3, 1, 'PHONE', 'Телефон', 'crimea_phone', '+38 (050) 545-33-69', NULL, 'YES'),
(4, 1, 'EMAIL', 'Эл. почта', 'crimea_email', 'admin@roy.com.ua', NULL, 'YES'),
(5, 1, 'SKYPE', 'skype', 'crimea_skype', 'Che', NULL, 'YES'),
(6, 1, 'LATLNG', 'google', 'crimea_google', '45°17''14.77"С 34°44''1.81"В', NULL, 'YES'),
(7, 1, 'QRCODE', 'QR код', 'crimea_qr', NULL, '/uploads/crimea_qr.png', 'YES'),
(8, 2, 'ADDRESS', 'Адрес в Москве:', 'moscow_address', 'г.Москва, ул.Дубнинская д.14, к.2', NULL, 'YES'),
(9, 2, 'PHONE', 'Телефон в москве', 'moscow_phone', '+7 (495) 668-12-73', NULL, 'YES');

-- --------------------------------------------------------

--
-- Структура таблицы `contacts_groups`
--

DROP TABLE IF EXISTS `contacts_groups`;
CREATE TABLE IF NOT EXISTS `contacts_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `contacts_groups`
--

INSERT INTO `contacts_groups` (`id`, `title`, `alias`, `description`, `enabled`) VALUES
(1, 'База в крыму', 'crimea_base', 'Живописное меcто Крыма расположено за селом Перевальное по пути из столицы Крыма - Симферополя - на Южный берег Крыма, трасса "Симферополь-Ялта".<br /><br />\r\nОт авто- или железнодорожного вокзала доехать маршруткой "Симферополь-Перевальное" до остановки "Красная пещера"или троллейбусами 51, 52, 53 до остановки "Стадион".<br /><br />\r\n<b>Или позвоните нам, и мы Вас встретим. </b>', 'YES'),
(2, 'Офис в Москве', 'moscow_office', NULL, 'YES');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `contacts_contacts`
--
ALTER TABLE `contacts_contacts`
  ADD CONSTRAINT `contacts_contacts_ibfk_1` FOREIGN KEY (`contacts_groups_id`) REFERENCES `contacts_groups` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
