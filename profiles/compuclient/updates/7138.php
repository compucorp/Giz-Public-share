<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.38.
 */

/**
 * Upgrades Compuclient to 7.x-1.38.
 */
function compuclient_update_7138() {
  civicrm_initialize();
  civicrm_api3('Extension', 'upgrade');
  civicrm_api3('Extension', 'refresh');
}
