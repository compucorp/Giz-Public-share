<?php

function compuclient_update_7110() {
  civicrm_initialize();

  civicrm_api3('Extension', 'install', [
    'keys' => [
        'uk.co.compucorp.eventsextras',
    ],
  ]);
}
