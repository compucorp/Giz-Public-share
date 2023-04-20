<?php

namespace Drupal\compuclient\Setup\Step;

/**
 * CiviCRM dependent modules installation step.
 */
class CiviCRMDependentModulesInstallationStep implements StepInterface {

  /**
   * Enables CiviCRM dependent modules.
   *
   * These modules rely on CiviCRM already being installed and enabled
   * on the site. If it is not, then then installation will fail. Because
   * of this we cannot include them in the list of dependencies in
   * compuclient.info and we must enable them only after CiviCRM has been
   * installed.
   */
  public function apply() {
    module_enable([
      'webform_civicrm',
      'civicrm_entity',
      'webform_civicrm_membership_extras',
    ], TRUE);
  }

}
