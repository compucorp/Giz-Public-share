<?php

require_once 'contactmembershiplog.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function contactmembershiplog_civicrm_config(&$config) {
  _contactmembershiplog_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function contactmembershiplog_civicrm_xmlMenu(&$files) {
  _contactmembershiplog_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function contactmembershiplog_civicrm_install() {
  _contactmembershiplog_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function contactmembershiplog_civicrm_postInstall() {
  _contactmembershiplog_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function contactmembershiplog_civicrm_uninstall() {
  _contactmembershiplog_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function contactmembershiplog_civicrm_enable() {
  _contactmembershiplog_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function contactmembershiplog_civicrm_disable() {
  _contactmembershiplog_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function contactmembershiplog_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _contactmembershiplog_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function contactmembershiplog_civicrm_managed(&$entities) {
  _contactmembershiplog_civix_civicrm_managed($entities);
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
function contactmembershiplog_civicrm_caseTypes(&$caseTypes) {
  _contactmembershiplog_civix_civicrm_caseTypes($caseTypes);
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
function contactmembershiplog_civicrm_angularModules(&$angularModules) {
  _contactmembershiplog_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function contactmembershiplog_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _contactmembershiplog_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function contactmembershiplog_civicrm_entityTypes(&$entityTypes) {
  _contactmembershiplog_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function contactmembershiplog_civicrm_themes(&$themes) {
  _contactmembershiplog_civix_civicrm_themes($themes);
}

/**
 * Implements hook_civicrm_pageRun().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_pageRun
 */
function contactmembershiplog_civicrm_pageRun(&$page) {
  if (get_class($page) == 'CRM_Member_Page_Tab') {
    CRM_Core_Resources::singleton()->addScriptFile(
      'civicrm', 'js/crm.expandRow.js', 10, 'page-footer'
    );

    foreach (['activeMembers', 'inActiveMembers'] as $name) {
      $rows = $page->get_template_vars($name);
      if (empty($rows)) {
        continue;
      }
      _contactmembershiplog_civicrm_rebuildRows($rows);
      $page->assign($name, $rows);
    }
  }
}

/**
 * Implements hook_civicrm_buildForm().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_buildForm
 */
function contactmembershiplog_civicrm_buildForm($formName, &$form) {
  if (in_array($formName, ['CRM_Member_Form_Search',
    'CRM_Contact_Form_Search_Advanced',
  ])) {
    if ($formName == 'CRM_Contact_Form_Search_Advanced'
      && ($form->getVar('_modeValue')['component'] != 'CiviMember' || !empty($form->_searchPane))
    ) {
      return;
    }
    CRM_Core_Resources::singleton()->addScriptFile(
      'civicrm', 'js/crm.expandRow.js', 10, 'page-footer'
    );
  }
}

/**
 * Implements hook_civicrm_searchColumns().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_searchColumns
 */
function contactmembershiplog_civicrm_searchColumns($objectName, &$headers, &$rows, &$selector) {
  if ('membership' == $objectName) {
    _contactmembershiplog_civicrm_rebuildRows($rows);
  }
}

/**
 * Append expand link to Membership Type
 *
 * @param array $rows
 *
 */
function _contactmembershiplog_civicrm_rebuildRows(&$rows) {
  foreach ($rows as &$row) {
    $url = CRM_Utils_System::url('civicrm/membershiplogs/getmemlogs', "reset=1&mid={$row['membership_id']}");
    $expandlink = "<a class='nowrap bold crm-expand-row' title='" . ts('view recent logs') . "' href='{$url}'></a>";
    $row['membership_type'] = $expandlink . $row['membership_type'];
  }
}
