<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.20.
 */

/**
 * Upgrade CiviCRM extensions.
 */
function compuclient_update_7120() {
  civicrm_initialize();

  civicrm_api3('Extension', 'upgrade');
}
