<?php

require_once 'membershipextrasdefaultconfig.civix.php';
use CRM_Membershipextrasdefaultconfig_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function membershipextrasdefaultconfig_civicrm_config(&$config) {
  _membershipextrasdefaultconfig_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function membershipextrasdefaultconfig_civicrm_xmlMenu(&$files) {
  _membershipextrasdefaultconfig_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function membershipextrasdefaultconfig_civicrm_install() {
  _membershipextrasdefaultconfig_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function membershipextrasdefaultconfig_civicrm_postInstall() {
  _membershipextrasdefaultconfig_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function membershipextrasdefaultconfig_civicrm_uninstall() {
  _membershipextrasdefaultconfig_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function membershipextrasdefaultconfig_civicrm_enable() {
  _membershipextrasdefaultconfig_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function membershipextrasdefaultconfig_civicrm_disable() {
  _membershipextrasdefaultconfig_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function membershipextrasdefaultconfig_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _membershipextrasdefaultconfig_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function membershipextrasdefaultconfig_civicrm_managed(&$entities) {
  _membershipextrasdefaultconfig_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function membershipextrasdefaultconfig_civicrm_caseTypes(&$caseTypes) {
  _membershipextrasdefaultconfig_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function membershipextrasdefaultconfig_civicrm_angularModules(&$angularModules) {
  _membershipextrasdefaultconfig_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function membershipextrasdefaultconfig_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _membershipextrasdefaultconfig_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function membershipextrasdefaultconfig_civicrm_entityTypes(&$entityTypes) {
  _membershipextrasdefaultconfig_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function membershipextrasdefaultconfig_civicrm_themes(&$themes) {
  _membershipextrasdefaultconfig_civix_civicrm_themes($themes);
}
