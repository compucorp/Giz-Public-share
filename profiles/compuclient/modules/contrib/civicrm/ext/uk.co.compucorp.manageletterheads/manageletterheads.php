<?php

use CRM_ManageLetterheads_Hook_BuildForm_AddLetterheadDropdown as AddLetterheadDropdown;
use CRM_ManageLetterheads_Hook_AlterAPIPermissions_AddLetterheadPermissions as AddLetterheadPermissions;

require_once 'manageletterheads.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function manageletterheads_civicrm_config(&$config) {
  _manageletterheads_civix_civicrm_config($config);

  Civi::dispatcher()->addListener(
    'civi.api.respond',
    ['CRM_ManageLetterheads_Event_Listener_LetterheadExtraFields', 'onRespond'],
    10
  );
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function manageletterheads_civicrm_xmlMenu(&$files) {
  _manageletterheads_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function manageletterheads_civicrm_install() {
  _manageletterheads_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function manageletterheads_civicrm_postInstall() {
  _manageletterheads_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function manageletterheads_civicrm_uninstall() {
  _manageletterheads_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function manageletterheads_civicrm_enable() {
  _manageletterheads_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function manageletterheads_civicrm_disable() {
  _manageletterheads_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function manageletterheads_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _manageletterheads_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function manageletterheads_civicrm_managed(&$entities) {
  _manageletterheads_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function manageletterheads_civicrm_caseTypes(&$caseTypes) {
  _manageletterheads_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function manageletterheads_civicrm_angularModules(&$angularModules) {
  _manageletterheads_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function manageletterheads_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _manageletterheads_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function manageletterheads_civicrm_entityTypes(&$entityTypes) {
  _manageletterheads_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_permission().
 */
function manageletterheads_civicrm_permission(&$permissions) {
  $permissions['manage letterheads'] = [
    ts('CiviCRM: manage letterheads'),
    ts('Allows managing of a list of letterheads that can be selected by users when creating emails and PDF letters'),
  ];
}

/**
 * Implements hook_civicrm_buildForm().
 */
function manageletterheads_civicrm_buildForm($formName, $form) {
  $hooks = [
    new AddLetterheadDropdown(),
  ];

  foreach ($hooks as $hook) {
    $hook->run($formName, $form);
  }
}

/**
 * Implements hook_civicrm_alterAPIPermissions().
 */
function manageletterheads_civicrm_alterAPIPermissions($entity, $action, &$params, &$permissions) {
  $hooks = [
    new AddLetterheadPermissions(),
  ];

  foreach ($hooks as $hook) {
    $hook->run($entity, $action, $params, $permissions);
  }
}
