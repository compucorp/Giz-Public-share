<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.30.
 */

/**
 * Upgrades Compuclient to 7.x-1.30.
 */
function compuclient_update_7130() {
  civicrm_initialize();
  civicrm_api3('Extension', 'upgrade');
  civicrm_api3('Extension', 'refresh');

  // This extension should be installed for
  // any client that already has Mosiaco extension
  // installed, which is the case for Compuclient native
  // sites, for Compuclient aligned sites, check if the client
  // is using Mosiaco before adding it to the client upgrade module.
  civicrm_api3('Extension', 'install', [
    'keys' => 'mosaicoextras',
  ]);

  $defaultToolbar = 'bold italic forecolor backcolor hr bullist numlist styleselect removeformat | civicrmtoken | link unlink | pastetext code';
  civicrm_api3('Setting', 'create', ['mosaico_toolbar' => $defaultToolbar]);

  // Re-add the reserved "Billing" location type.
  // This for Compuclient native sites only, and should "Not" be added
  // to any Compuclient aligned site.
  $billingLocationType = civicrm_api3('LocationType', 'get', [
    'sequential' => 1,
    'name' => 'Billing',
    'options' => ['limit' => 1],
  ]);
  if (empty($billingLocationType['id'])) {
    $result = civicrm_api3('LocationType', 'create', [
      'name' => 'Billing',
      'display_name' => 'Billing',
      'description' => 'Billing Address location',
      'is_reserved' => 1,
      'is_active' => 1,
    ]);
  }
}
