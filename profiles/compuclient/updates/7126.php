<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.26.
 */

/**
 * Upgrades Compuclient to 7.x-1.26.
 */
function compuclient_update_7126() {
  civicrm_initialize();
  civicrm_api3('Extension', 'upgrade');

  // This extension should be disabled for all clients,
  // so make sure to copy this to any Compuclient aligned sites.
  civicrm_api3('Extension', 'disable', [
    'keys' => 'contributioncancelactions',
  ]);

  // This extension should be installed for
  // any client that already has Mosiaco extension
  // installed, which is the case for Compuclient native
  // sites, for Compuclient aligned sites, check if the client
  // is using Mosiaco before adding it to the client upgrade module.
  civicrm_api3('Extension', 'install', [
    'keys' => [
      'io.compuco.custommosaico',
    ],
  ]);

  civicrm_api3('Extension', 'install', [
    'keys' => [
      'uk.co.compucorp.certificate',
    ],
  ]);

  // COMCL-146: we set theme_frontend again to none for existing sites created
  // from Compuclient 1.24 which didn't have this setting.
  civicrm_api3('Setting', 'create', [
    'theme_frontend' => 'none',
  ]);
}
