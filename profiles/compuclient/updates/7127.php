<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.27.
 */

/**
 * Upgrades Compuclient to 7.x-1.27.
 */
function compuclient_update_7127() {
  civicrm_initialize();
  civicrm_api3('Extension', 'upgrade');
}
