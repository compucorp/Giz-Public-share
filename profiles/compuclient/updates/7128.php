<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.28.
 */

/**
 * Upgrades Compuclient to 7.x-1.28.
 */
function compuclient_update_7128() {
  civicrm_initialize();
  civicrm_api3('Extension', 'upgrade');

  // Due to instability of CKEditor V5, we are switching
  // back to v4 and then uninstall CKEditor extension.
  // This should also be applied to Compuclient aligned sites.
  civicrm_api3('Setting', 'create', ['editor_id' => 'CKEditor']);
  civicrm_api3('Extension', 'disable', [
    'keys' => 'ckeditor5',
  ]);
  civicrm_api3('Extension', 'uninstall', [
    'keys' => 'ckeditor5',
  ]);
}
