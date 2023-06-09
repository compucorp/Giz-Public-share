<?php

require_once 'shoreditchthirdparty.civix.php';
// phpcs:disable
use CRM_Shoreditchthirdparty_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function shoreditchthirdparty_civicrm_config(&$config) {
  _shoreditchthirdparty_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function shoreditchthirdparty_civicrm_xmlMenu(&$files) {
  _shoreditchthirdparty_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function shoreditchthirdparty_civicrm_install() {
  _shoreditchthirdparty_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function shoreditchthirdparty_civicrm_postInstall() {
  _shoreditchthirdparty_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function shoreditchthirdparty_civicrm_uninstall() {
  _shoreditchthirdparty_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function shoreditchthirdparty_civicrm_enable() {
  _shoreditchthirdparty_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function shoreditchthirdparty_civicrm_disable() {
  _shoreditchthirdparty_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function shoreditchthirdparty_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _shoreditchthirdparty_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function shoreditchthirdparty_civicrm_managed(&$entities) {
  _shoreditchthirdparty_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Add CiviCase types provided by this extension.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function shoreditchthirdparty_civicrm_caseTypes(&$caseTypes) {
  _shoreditchthirdparty_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Add Angular modules provided by this extension.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function shoreditchthirdparty_civicrm_angularModules(&$angularModules) {
  // Auto-add module files from ./ang/*.ang.php
  _shoreditchthirdparty_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function shoreditchthirdparty_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _shoreditchthirdparty_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function shoreditchthirdparty_civicrm_entityTypes(&$entityTypes) {
  _shoreditchthirdparty_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_themes().
 */
function shoreditchthirdparty_civicrm_themes(&$themes) {
  _shoreditchthirdparty_civix_civicrm_themes($themes);
}

function shoreditchthirdparty_civicrm_coreResourceList(&$list, $region) {
  CRM_Core_Resources::singleton()->addStyleFile('io.compuco.shoreditchthirdparty', 'css/shoreditchforthirdparty.css', 1000, 'html-header');
}
