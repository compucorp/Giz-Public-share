<?php

require_once 'invoicehelper.civix.php';
use CRM_Invoicehelper_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function invoicehelper_civicrm_config(&$config) {
  _invoicehelper_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function invoicehelper_civicrm_xmlMenu(&$files) {
  _invoicehelper_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function invoicehelper_civicrm_install() {
  _invoicehelper_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function invoicehelper_civicrm_postInstall() {
  _invoicehelper_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function invoicehelper_civicrm_uninstall() {
  _invoicehelper_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function invoicehelper_civicrm_enable() {
  _invoicehelper_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function invoicehelper_civicrm_disable() {
  _invoicehelper_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function invoicehelper_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _invoicehelper_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function invoicehelper_civicrm_managed(&$entities) {
  _invoicehelper_civix_civicrm_managed($entities);
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
function invoicehelper_civicrm_caseTypes(&$caseTypes) {
  _invoicehelper_civix_civicrm_caseTypes($caseTypes);
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
function invoicehelper_civicrm_angularModules(&$angularModules) {
  _invoicehelper_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function invoicehelper_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _invoicehelper_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function invoicehelper_civicrm_entityTypes(&$entityTypes) {
  _invoicehelper_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_alterMailParams().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterMailParams/
 */
function invoicehelper_civicrm_alterMailParams(&$params, $context) {
  if ($context != 'messageTemplate') {
    return;
  }

  // Precaution against some hacks used by some extensions for PDF generation.
  if (empty($params['toEmail'])) {
    return;
  }

  $fields = ['cc', 'bcc'];

  foreach ($fields as $field) {
    $setting = 'invoicehelper_' . $field . '_' . $params['valueName'];

    if ($value = Civi::settings()->get($setting)) {
      $emails = [];

      // Add existing CC/BCC
      if (!empty($params[$field])) {
        $emails[] = $params[$field];
      }

      // Check against duplicates
      $values = explode(',', $value);

      foreach ($values as $x) {
        $x = trim($x);

        if (array_search($x, $emails) === FALSE) {
          $emails[] = $x;
	}
      }

      if (!empty($emails)) {
        $params[$field] = implode(', ', $emails);
      }
    }
  }

  // Resolve tokens in email_comment.
  CRM_Invoicehelper_Contribute_Form_Task_PrintOrEmail::replaceTokens($params);
}

/**
 * Implements hook_civicrm_buildForm().
 *
 * @param string $formName
 * @param CRM_Core_Form $form
 */
function invoicehelper_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Contribute_Form_ContributionView') {
    CRM_Invoicehelper_Contribute_Form_ContributionView::buildForm($form);
  }
  elseif ($formName == 'CRM_Contribute_Form_Contribution') {
    CRM_Invoicehelper_Contribute_Form_Contribution::buildForm($form);
  }
  elseif ($formName == 'CRM_Member_Form_Membership' || $formName == 'CRM_Member_Form_MembershipRenewal') {
    CRM_Invoicehelper_Member_Form_Membership::buildForm($form);
  }
  elseif ($formName == 'CRM_Contribute_Form_Task_Invoice') {
    CRM_Invoicehelper_Contribute_Form_Task_PrintOrEmail::buildForm($form);
  }
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu/
 */
function invoicehelper_civicrm_navigationMenu(&$menu) {
  _invoicehelper_civix_insert_navigation_menu($menu, 'Administer/CiviContribute', [
    'label' => E::ts('Invoice Helper'),
    'name' => 'invoicehelper_settings',
    'url' => 'civicrm/admin/setting/invoicehelper',
    'permission' => 'administer CiviCRM',
    'operator' => 'OR',
    'separator' => 0,
  ]);
  _invoicehelper_civix_navigationMenu($menu);
}
