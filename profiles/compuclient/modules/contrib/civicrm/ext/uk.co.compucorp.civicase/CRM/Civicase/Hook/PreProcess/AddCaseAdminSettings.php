<?php

use CRM_Civicase_ExtensionUtil as ExtensionUtil;

/**
 * Adds custom settings related to civicase.
 */
class CRM_Civicase_Hook_PreProcess_AddCaseAdminSettings {

  /**
   * Single case role setting name.
   */
  const CIVICASE_SINGLE_CASE_ROLE_PER_TYPE = 'civicaseSingleCaseRolePerType';

  /**
   * Multiple client setting name.
   */
  const CIVICASE_ALLOW_MULTIPLE_CLIENTS = 'civicaseAllowMultipleClients';

  /**
   * Sets the case admin settings.
   *
   * @param string $formName
   *   Form name.
   * @param CRM_Core_Form $form
   *   Form object class.
   */
  public function run($formName, CRM_Core_Form &$form) {
    if (!$this->shouldRun($formName)) {
      return;
    }

    $settings = $form->getVar('_settings');

    $this->addCivicaseSettingsToForm($settings);
    $form->setVar('_settings', $settings);
    $this->addScriptFile();
  }

  /**
   * Takes civicase setting names and adds them to the admin form.
   *
   * The settings are taken from the civicase settings file. This function is
   * needed to properly display these settings on the form.
   *
   * @param array $settings
   *   Settings array.
   */
  private function addCivicaseSettingsToForm(array &$settings) {
    $civicaseSettings = $this->getCiviCaseSettings();
    $settingKeys = array_keys($civicaseSettings);

    foreach ($settingKeys as $settingKey) {
      $settings[$settingKey] = CRM_Core_BAO_Setting::SYSTEM_PREFERENCES_NAME;
    }
    $settings = $this->changeOrderForSingleCaseRoleSetting($settings);
  }

  /**
   * Change order for single case role setting.
   *
   * @param array $settings
   *   Settings array.
   *
   * @return array
   *   Settings array with changed order.
   */
  private function changeOrderForSingleCaseRoleSetting(array $settings) {
    if (!empty($settings[self::CIVICASE_SINGLE_CASE_ROLE_PER_TYPE]) &&
      !empty($settings[self::CIVICASE_ALLOW_MULTIPLE_CLIENTS])) {
      $newSettings = [];
      foreach ($settings as $k => $val) {
        if ($k === self::CIVICASE_SINGLE_CASE_ROLE_PER_TYPE) {
          continue;
        }
        $newSettings[$k] = $val;
        if ($k === self::CIVICASE_ALLOW_MULTIPLE_CLIENTS) {
          $newSettings[self::CIVICASE_SINGLE_CASE_ROLE_PER_TYPE] = $settings[self::CIVICASE_SINGLE_CASE_ROLE_PER_TYPE];
        }
      }
      return $newSettings;
    }

    return $settings;
  }

  /**
   * Adds a custom JS file to the Civicase settings admin form.
   *
   * This JS file handles custom logic needed to display or hide certain
   * fields in the admin form.
   */
  private function addScriptFile() {
    CRM_Core_Resources::singleton()
      ->addScriptFile('uk.co.compucorp.civicase', 'js/civicase-settings-form.js');
  }

  /**
   * Returns the list of settings defined in the civicase settings file.
   *
   * @return array
   *   The civicase settings.
   */
  private function getCiviCaseSettings() {
    $settingsPath = CRM_Core_Resources::singleton()
      ->getPath(ExtensionUtil::LONG_NAME, 'settings/CiviCase.setting.php');

    return require $settingsPath;
  }

  /**
   * Determines if the hook will run.
   *
   * @param string $formName
   *   Form class object.
   *
   * @return bool
   *   returns TRUE or FALSE.
   */
  private function shouldRun($formName) {
    return $formName == 'CRM_Admin_Form_Setting_Case';
  }

}
