<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.22.
 */

/**
 * Upgrade CiviCRM extensions.
 */
function compuclient_update_7122() {
  civicrm_initialize();

  civicrm_api3('Extension', 'upgrade');

  // Update "IM" word replacement to be exact match.
  civicrm_api3('WordReplacement', 'get', [
    'sequential' => 1,
    'find_word' => "IM",
    'api.WordReplacement.create' => ['match_type' => "exactMatch"],
  ]);
}
