<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.35.
 */

/**
 * Upgrades Compuclient to 7.x-1.35.
 */
function compuclient_update_7135() {
  civicrm_initialize();
  civicrm_api3('Extension', 'upgrade');
  civicrm_api3('Extension', 'refresh');
}
