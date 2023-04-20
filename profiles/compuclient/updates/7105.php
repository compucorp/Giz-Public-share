<?php

/**
 * Implements compuclient_update_7105().
 */
function compuclient_update_7105() {
  civicrm_initialize();

  civicrm_api3('Extension', 'upgrade');

  civicrm_api3('Extension', 'install', [
    'keys' => [
      'uk.co.compucorp.civiawards',
      'uk.co.compucorp.additionalsearchparams',
    ],
  ]);

}
