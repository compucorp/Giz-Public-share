<?php

namespace Drupal\compuclient\Setup\Step;

/**
 * CiviCRM System Setting Step.
 */
class CiviCRMSystemSettingStep implements StepInterface {

  /**
   * Applies CiviCRM System Settings.
   */
  public function apply() {
    $this->setWordReplacements();
    $this->setSystemSettings();
  }

  /**
   * Sets system settings.
   */
  private function setSystemSettings() {
    civicrm_api3('Setting', 'create', [
      'logging' => 1,
      'empoweredBy' => 0,
    ]);
  }

  /**
   * Sets default Word replacements.
   */
  private function setWordReplacements() {
    civicrm_api3('WordReplacement', 'create', [
      'find_word' => 'Instant Messenger',
      'replace_word' => 'Social Media',
      'is_active' => 1,
    ]);

    civicrm_api3('WordReplacement', 'create', [
      'find_word' => 'IM',
      'replace_word' => 'Social Media',
      'is_active' => 1,
      'match_type' => 'exactMatch',
    ]);

    civicrm_api3('WordReplacement', 'create', [
      'find_word' => 'Current Employer',
      'replace_word' => 'Primary Employer',
      'is_active' => 1,
      'match_type' => 'exactMatch',
    ]);
  }

}
