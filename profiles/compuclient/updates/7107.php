<?php

/**
 * Install Extensions/Run Upgraders.
 */
function compuclient_update_7107() {
  civicrm_initialize();

  civicrm_api3('Extension', 'upgrade');
  civicrm_api3('Extension', 'install', [
    'keys' => [
      'uk.co.compucorp.civicrm.prospect',
      'uk.co.compucorp.civicrm.pivotreport',
    ],
  ]);
}
