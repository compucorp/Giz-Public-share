<?php

/**
 * Run Upgraders.
 */
function compuclient_update_7106() {
  civicrm_initialize();

  civicrm_api3('Extension', 'upgrade');

  civicrm_api3('Extension', 'install', [
    'keys' => [
      'com.joineryhq.reltoken',
    ],
  ]);
}
