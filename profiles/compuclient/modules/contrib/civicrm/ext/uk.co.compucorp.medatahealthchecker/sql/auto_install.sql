SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `medatahealthchecker_issues_log`;

SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE `medatahealthchecker_issues_log` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `entity_id` int unsigned NOT NULL,
    `entity_table` varchar(500) NOT NULL,
    `error_code` int unsigned NOT NULL,
    `contact_id` int unsigned NOT NULL COMMENT 'FK to Contact',
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `index_error_code`(error_code),
    CONSTRAINT FK_medatahealthchecker_issues_log_contact_id FOREIGN KEY (`contact_id`) REFERENCES `civicrm_contact`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB  ;
