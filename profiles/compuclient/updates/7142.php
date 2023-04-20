<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.42.
 */

/**
 * Upgrades Compuclient to 7.x-1.42.
 */
function compuclient_update_7142() {
  civicrm_initialize();
  civicrm_api3('Extension', 'upgrade');
  civicrm_api3('Extension', 'refresh');
}
