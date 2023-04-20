<?php

/**
 * Upgrade CiviCRM extensions
 */
function compuclient_update_7119() {
    civicrm_initialize();

    civicrm_api3('Extension', 'upgrade');
}
