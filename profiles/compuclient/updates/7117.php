<?php

/**
 * @file
 */

/**
 * Upgrader for Compuclient version 7.x-1.17.
 */
function compuclient_update_7117() {
  /**
   * @see StandardProfileConfigurationStep::configureAdvuserModuleWeight()
   */
  db_update('system')
    ->fields(array('weight' => 1))
    ->condition('name', 'advuser')
    ->execute();
}
