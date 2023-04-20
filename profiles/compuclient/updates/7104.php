<?php

use Drupal\compuclient\Setup\Step\CiviCRMJobScheduleConfigurationStep;
use Drupal\compuclient\Setup\Step\CiviCRMConfigurationStep;

/**
 * Implements compuclient_update_7104().
 */
function compuclient_update_7104() {
  civicrm_initialize();

  civicrm_api3('Extension', 'upgrade');

  civicrm_api3('Extension', 'install', [
    'keys' => [
      'org.civicrm.flexmailer',
      'uk.co.vedaconsulting.mosaico',
      'uk.co.compucorp.manualdirectdebit',
      'biz.jmaconsulting.lineitemedit',
    ],
  ]);

  //Apply roles and permissions and enable rules_admin
  module_enable([
    'compuclient_default_roles_and_permissions',
    'rules_admin',
    'webform_civicrm_membership_extras',
    'webform_manualdd'
  ]);

  $steps = [
    new CiviCRMConfigurationStep(),
    new CiviCRMJobScheduleConfigurationStep(),
  ];

  foreach ($steps as $step) {
    $step->apply();
  }

}
