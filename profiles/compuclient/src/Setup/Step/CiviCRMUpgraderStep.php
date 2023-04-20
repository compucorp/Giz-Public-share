<?php

namespace Drupal\compuclient\Setup\Step;

class CiviCRMUpgraderStep implements StepInterface {

  /**
   * Apply CiviCRM Upgrade
   */
  public function apply() {
    $this->downloadUKEnglishLocal();
    $codeVer = \CRM_Utils_System::version();
    $dbVer = \CRM_Core_BAO_Domain::version();
    if (version_compare($codeVer, $dbVer) == 0) {
      return TRUE;
    }
    $upgradeHeadless = new \CRM_Upgrade_Headless();
    $upgradeHeadless->run();
  }


   /**
   * Downloads en_GB (UK english) localization file
   *
   * @return boolean|null
   */
  private function downloadUKEnglishLocal() {
    $localizationURL = 'https://download.civicrm.org/civicrm-l10n-core/mo/en_GB/civicrm.mo';

    global $civicrm_root;
    $downloadPath = "{$civicrm_root}/l10n/en_GB/LC_MESSAGES/";

    file_put_contents($downloadPath . 'civicrm.mo', fopen($localizationURL, 'r'));
  }

}
