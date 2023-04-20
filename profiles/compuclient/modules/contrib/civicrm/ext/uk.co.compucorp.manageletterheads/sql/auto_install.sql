SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `civicrm_manageletterheads_letterhead_availability`;
DROP TABLE IF EXISTS `civicrm_manageletterheads_letterhead`;

SET FOREIGN_KEY_CHECKS=1;
-- /*******************************************************
-- *
-- * Create new tables
-- *
-- *******************************************************/

-- /*******************************************************
-- *
-- * civicrm_manageletterheads_letterhead
-- *
-- * Store Letterhead details
-- *
-- *******************************************************/
CREATE TABLE `civicrm_manageletterheads_letterhead` (
     `id` int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Unique Letterhead ID',
     `title` varchar(255) NOT NULL   COMMENT 'Letterhead Title',
     `name` varchar(255) NOT NULL   COMMENT 'Letterhead Name',
     `description` varchar(255)    COMMENT 'Letterhead Description',
     `content` longtext NOT NULL   COMMENT 'Letterhead Description',
     `weight` int unsigned NOT NULL   COMMENT 'Controls display sort order.',
     `is_active` tinyint NOT NULL  DEFAULT 1 COMMENT 'Whether the letterhead is disabled or not',
     PRIMARY KEY (`id`)
 );

-- /*******************************************************
-- *
-- * civicrm_manageletterheads_letterhead_availability
-- *
-- * Store details about what the letterhead is available for
-- *
-- *******************************************************/
CREATE TABLE `civicrm_manageletterheads_letterhead_availability` (
     `id` int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Unique LetterheadAvailability ID',
     `available_for` varchar(30) NOT NULL   COMMENT 'One of the values of the manageletterheads_available_for option group',
     `letterhead_id` int unsigned NOT NULL   COMMENT 'FK to Letterhead',
     PRIMARY KEY (`id`),
     CONSTRAINT FK_letterhead_id FOREIGN KEY (`letterhead_id`) REFERENCES `civicrm_manageletterheads_letterhead`(`id`)
);

 