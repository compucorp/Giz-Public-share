<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.25.
 */

/**
 * Installs 'uk.co.compucorp.usermenu' extension.
 */
function compuclient_update_7125() {
  civicrm_initialize();

  civicrm_api3('Extension', 'install', [
    'keys' => [
      'uk.co.compucorp.usermenu',
      'ckeditor5',
    ],
  ]);

  civicrm_api3('Extension', 'upgrade');
  civicrm_api3('Setting', 'create', ['editor_id' => 'CKEditor5-elfinder']);

}
