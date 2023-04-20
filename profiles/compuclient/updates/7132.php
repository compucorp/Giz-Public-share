<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.32.
 */

/**
 * Upgrades Compuclient to 7.x-1.32.
 */
function compuclient_update_7132() {
  civicrm_initialize();
  civicrm_api3('Extension', 'upgrade');
  civicrm_api3('Extension', 'refresh');
}
