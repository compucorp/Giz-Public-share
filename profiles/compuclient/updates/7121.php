<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.21.
 */

/**
 * Upgrade CiviCRM extensions.
 */
function compuclient_update_7121() {
  civicrm_initialize();

  civicrm_api3('Extension', 'upgrade');
}
