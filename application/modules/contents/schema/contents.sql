SET FOREIGN_KEY_CHECKS=0;

--
-- Структура таблицы `contents_categories`
--

DROP TABLE IF EXISTS `contents_categories`;
CREATE TABLE IF NOT EXISTS `contents_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contents_categories_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`),
  KEY `contents_categories_id` (`contents_categories_id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  CONSTRAINT `contents_categories_ibfk_1` FOREIGN KEY (`contents_categories_id`) REFERENCES `contents_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contents_categories_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contents_categories_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contents_categories_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Триггеры `contents_categories`
--

DROP TRIGGER IF EXISTS `BEFORE_INSERT_contents_categories`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_contents_categories` BEFORE INSERT ON `contents_categories`
 FOR EACH ROW BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

DROP TRIGGER IF EXISTS `BEFORE_UPDATE_contents_categories`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_contents_categories` BEFORE UPDATE ON `contents_categories`
 FOR EACH ROW BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

--
-- Структура таблицы `contents_comments`
--

DROP TABLE IF EXISTS `contents_comments`;
CREATE TABLE IF NOT EXISTS `contents_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contents_posts_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_posts_id` (`contents_posts_id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  CONSTRAINT `contents_comments_ibfk_1` FOREIGN KEY (`contents_posts_id`) REFERENCES `contents_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contents_comments_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contents_comments_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contents_comments_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Триггеры `contents_comments`
--

DROP TRIGGER IF EXISTS `BEFORE_INSERT_contents_comments`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_contents_comments` BEFORE INSERT ON `contents_comments`
 FOR EACH ROW BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

DROP TRIGGER IF EXISTS `BEFORE_UPDATE_contents_comments`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_contents_comments` BEFORE UPDATE ON `contents_comments`
 FOR EACH ROW BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

--
-- Структура таблицы `contents_params`
--

DROP TABLE IF EXISTS `contents_params`;
CREATE TABLE IF NOT EXISTS `contents_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contents_categories_id` int(11) DEFAULT NULL,
  `contents_posts_id` int(11) DEFAULT NULL,
  `params_names_id` int(11) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_categories_id` (`contents_categories_id`),
  KEY `contents_posts_id` (`contents_posts_id`),
  KEY `params_names_id` (`params_names_id`),
  CONSTRAINT `contents_params_ibfk_1` FOREIGN KEY (`contents_categories_id`) REFERENCES `contents_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contents_params_ibfk_2` FOREIGN KEY (`contents_posts_id`) REFERENCES `contents_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contents_params_ibfk_3` FOREIGN KEY (`params_names_id`) REFERENCES `params_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Структура таблицы `contents_posts`
--

DROP TABLE IF EXISTS `contents_posts`;
CREATE TABLE IF NOT EXISTS `contents_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contents_categories_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `introtext` text,
  `fulltext` text,
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `contents_categories_id` (`contents_categories_id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  CONSTRAINT `contents_posts_ibfk_1` FOREIGN KEY (`contents_categories_id`) REFERENCES `contents_categories` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `contents_posts_ibfk_2` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contents_posts_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contents_posts_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Триггеры `contents_posts`
--

DROP TRIGGER IF EXISTS `BEFORE_INSERT_contents_posts`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_contents_posts` BEFORE INSERT ON `contents_posts`
 FOR EACH ROW BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

DROP TRIGGER IF EXISTS `BEFORE_UPDATE_contents_posts`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_contents_posts` BEFORE UPDATE ON `contents_posts`
 FOR EACH ROW BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END
//
DELIMITER ;

--
-- Структура таблицы `contents_translations`
--

DROP TABLE IF EXISTS `contents_translations`;
CREATE TABLE IF NOT EXISTS `contents_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contents_categories_id` int(11) NOT NULL,
  `contents_posts_id` int(11) NOT NULL,
  `translations_languages_id` int(11) NOT NULL,
  `field` int(11) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_categories_id` (`contents_categories_id`),
  KEY `contents_posts_id` (`contents_posts_id`),
  KEY `translations_languages_id` (`translations_languages_id`),
  CONSTRAINT `contents_translations_ibfk_1` FOREIGN KEY (`contents_categories_id`) REFERENCES `contents_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contents_translations_ibfk_2` FOREIGN KEY (`contents_posts_id`) REFERENCES `contents_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contents_translations_ibfk_3` FOREIGN KEY (`translations_languages_id`) REFERENCES `translations_languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

SET FOREIGN_KEY_CHECKS=1;
