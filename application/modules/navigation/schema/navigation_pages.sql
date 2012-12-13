SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT=0;
START TRANSACTION;

DROP TABLE IF EXISTS `navigation_pages`;
CREATE TABLE IF NOT EXISTS `navigation_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `navigation_pages_id` int(11) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `type` enum('URI','MVC') NOT NULL DEFAULT 'URI',
  `uri` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `params` text,
  `route` varchar(255) DEFAULT NULL,
  `reset_params` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `encode_url` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `enabled` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_ts` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_ts` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_ts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `checked_out_by` (`checked_out_by`),
  KEY `modified_by` (`modified_by`),
  KEY `navigation_pages_id` (`navigation_pages_id`),
  CONSTRAINT `navigation_pages_ibfk_1` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `navigation_pages_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `navigation_pages_ibfk_3` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `navigation_pages_ibfk_4` FOREIGN KEY (`navigation_pages_id`) REFERENCES `navigation_pages` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TRIGGER IF EXISTS `BEFORE_INSERT_navigation_pages`;
DELIMITER //
CREATE TRIGGER `BEFORE_INSERT_navigation_pages` BEFORE INSERT ON `navigation_pages`
FOR EACH ROW
BEGIN
	SET `NEW`.`created_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END;
//
DELIMITER ;

DROP TRIGGER IF EXISTS `BEFORE_UPDATE_navigation_pages`;
DELIMITER //
CREATE TRIGGER `BEFORE_UPDATE_navigation_pages` BEFORE UPDATE ON `navigation_pages`
FOR EACH ROW
BEGIN
	SET `NEW`.`modified_ts` = UNIX_TIMESTAMP();
	IF `NEW`.`checked_out_by` IS NOT NULL THEN
	    SET `NEW`.`checked_out_ts` = UNIX_TIMESTAMP();
	ELSE
	    SET `NEW`.`checked_out_ts` = NULL;
	END IF;
END;
//
DELIMITER ;

INSERT INTO `navigation_pages` (`id`, `navigation_pages_id`, `label`, `type`, `uri`, `action`, `controller`, `module`, `params`, `route`, `reset_params`, `encode_url`) VALUES
(1, NULL, 'Administration', 'MVC', NULL, 'index', 'admin-index', 'default', NULL, NULL, 'YES', 'YES');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;