<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.24.
 */

/**
 * Sets the CiviCRM front end theme from display preferences.
 */
function compuclient_update_7124() {
  civicrm_initialize();

  civicrm_api3('Extension', 'upgrade');

  civicrm_api3('Setting', 'create', [
    'theme_frontend' => 'none',
  ]);
}
