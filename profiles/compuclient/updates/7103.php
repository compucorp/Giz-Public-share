<?php

use Drupal\compuclient\Setup\Step\CiviCRMUpgraderStep;


/**
 * Implements compuclient_update_7103().
 */
function compuclient_update_7103() {
  civicrm_initialize();
  $steps = [
    new CiviCRMUpgraderStep(),
  ];

  foreach ($steps as $step) {
    $step->apply();
  }
}


