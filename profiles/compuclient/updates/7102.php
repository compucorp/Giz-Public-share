<?php

use Drupal\compuclient\Setup\Step\ShoreditchCompanionThemeConfigurationStep;
use Drupal\compuclient\Setup\Step\CiviCRMConfigurationStep;
use Drupal\compuclient\Setup\Step\CiviCRMUpgraderStep;


/**
 * Implements compuclient_update_7102().
 */
function compuclient_update_7102() {
  civicrm_initialize();
  $steps = [
    new CiviCRMUpgraderStep(),
    new CiviCRMConfigurationStep(),
    new ShoreditchCompanionThemeConfigurationStep(),
  ];

  foreach ($steps as $step) {
    $step->apply();
  }

  module_enable(['civicrm_entity', 'admin_menu_toolbar']);

  variable_set('node_submitted_webform', 0);

  db_update('block')
      ->fields([
        'status' => 0,
      ])
      ->condition('theme', [
        'shoreditch_companion_d7_theme',
        'bartik',
        'seven'
      ], 'IN')
      ->condition('module', 'user')
      ->condition('delta', 'login')
      ->execute();

  civicrm_api3('Extension', 'upgrade');

}


