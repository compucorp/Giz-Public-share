<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.29.
 */

/**
 * Upgrades Compuclient to 7.x-1.29.
 */
function compuclient_update_7129() {
  civicrm_initialize();
  civicrm_api3('Extension', 'upgrade');
}
