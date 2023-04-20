<?php

require_once 'medatahealthchecker.civix.php';
// phpcs:disable
use CRM_Medatahealthchecker_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function medatahealthchecker_civicrm_config(&$config) {
  _medatahealthchecker_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function medatahealthchecker_civicrm_xmlMenu(&$files) {
  _medatahealthchecker_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function medatahealthchecker_civicrm_install() {
  _medatahealthchecker_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function medatahealthchecker_civicrm_postInstall() {
  _medatahealthchecker_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function medatahealthchecker_civicrm_uninstall() {
  _medatahealthchecker_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function medatahealthchecker_civicrm_enable() {
  _medatahealthchecker_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function medatahealthchecker_civicrm_disable() {
  _medatahealthchecker_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function medatahealthchecker_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _medatahealthchecker_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function medatahealthchecker_civicrm_managed(&$entities) {
  _medatahealthchecker_civix_civicrm_managed($entities);
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
function medatahealthchecker_civicrm_caseTypes(&$caseTypes) {
  _medatahealthchecker_civix_civicrm_caseTypes($caseTypes);
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
function medatahealthchecker_civicrm_angularModules(&$angularModules) {
  _medatahealthchecker_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function medatahealthchecker_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _medatahealthchecker_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function medatahealthchecker_civicrm_entityTypes(&$entityTypes) {
  _medatahealthchecker_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_themes().
 */
function medatahealthchecker_civicrm_themes(&$themes) {
  _medatahealthchecker_civix_civicrm_themes($themes);
}

/**
 * Implements hook_civicrm_navigationMenu().
 */
function medatahealthchecker_civicrm_navigationMenu(&$menu) {
  $issuesDashboardMenuItem = [
    'name' => 'medatahealthchecker_issues_dashboard',
    'label' => ts('Data Health Checker Dashboard'),
    'url' => 'civicrm/medatahealthchecker/issues-dashboard',
    'permission' => 'administer CiviCRM,administer MembershipExtras',
    'operator' => 'OR',
    'separator' => 2,
  ];

  _medatahealthchecker_civix_insert_navigation_menu($menu, 'Administer/CiviContribute', $issuesDashboardMenuItem);
}
