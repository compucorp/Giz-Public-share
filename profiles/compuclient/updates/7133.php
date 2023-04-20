<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.33.
 */

/**
 * Upgrades Compuclient to 7.x-1.33.
 */
function compuclient_update_7133() {
  civicrm_initialize();
  civicrm_api3('Extension', 'upgrade');
  civicrm_api3('Extension', 'refresh');
}
