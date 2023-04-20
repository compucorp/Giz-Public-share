<?php

use CRM_ManageLetterheads_Setup_CreateNavigationItem as CreateNavigationItem;
use CRM_ManageLetterheads_Uninstall_DeleteNavigationItem as DeleteNavigationItem;

/**
 * Collection of upgrade steps.
 */
class CRM_ManageLetterheads_Upgrader extends CRM_ManageLetterheads_Upgrader_Base {

  /**
   * A list of directories to be scanned for XML installation files
   *
   * @var array
   */
  private $xmlDirectories = ['option_groups'];

  /**
   * Custom extension installation logic
   */
  public function install() {
    $steps = [
      new CreateNavigationItem(),
    ];

    foreach ($steps as $step) {
      $step->apply();
    }

    $this->processXMLInstallationFiles();
  }

  /**
   * Manage Letterheads uninstall logic.
   */
  public function uninstall() {
    $steps = [
      new DeleteNavigationItem(),
    ];

    foreach ($steps as $step) {
      $step->apply();
    }
  }

  /**
   * Scans all the directories in $xmlDirectories for installation files
   * (xml files ending with _install.xml) and processes them.
   */
  private function processXMLInstallationFiles() {
    foreach ($this->xmlDirectories as $directory) {
      $files = glob($this->extensionDir . "/xml/{$directory}/*_install.xml");
      if (is_array($files)) {
        foreach ($files as $file) {
          $this->executeCustomDataFileByAbsPath($file);
        }
      }
    }
  }

}
