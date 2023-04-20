<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.40.
 */

/**
 * Upgrades Compuclient to 7.x-1.40.
 */
function compuclient_update_7140() {
  civicrm_initialize();
  civicrm_api3('Extension', 'upgrade');
  civicrm_api3('Extension', 'refresh');
}
