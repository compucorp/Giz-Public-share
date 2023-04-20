-- /*******************************************************
-- *
-- * Clean up the exisiting tables
-- *
-- *******************************************************/

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `civicrm_manageletterheads_letterhead_availability`;
DROP TABLE IF EXISTS `civicrm_manageletterheads_letterhead`;

SET FOREIGN_KEY_CHECKS=1;