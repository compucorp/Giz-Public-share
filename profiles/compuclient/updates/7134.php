<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.34.
 */

/**
 * Upgrades Compuclient to 7.x-1.34.
 */
function compuclient_update_7134() {
  civicrm_initialize();
  civicrm_api3('Extension', 'upgrade');

  // Reapply Mosiacoextras bullist settings.
  $defaultToolbar = 'bold italic forecolor backcolor hr bullist numlist styleselect removeformat | civicrmtoken | link unlink | pastetext code';
  civicrm_api3('Setting', 'create', ['mosaico_toolbar' => $defaultToolbar]);
}
