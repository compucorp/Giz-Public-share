<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.23.
 */

/**
 * Upgrade CiviCRM extensions.
 */
function compuclient_update_7123() {
  civicrm_initialize();

  civicrm_api3('Extension', 'upgrade');

  civicrm_api3('Extension', 'install', [
    'keys' => [
      'uk.co.compucorp.medatahealthchecker',
    ],
  ]);
}
