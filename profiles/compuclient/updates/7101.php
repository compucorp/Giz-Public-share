<?php

use Drupal\compuclient\Setup\Step\ShoreditchCompanionThemeConfigurationStep;
use Drupal\compuclient\Setup\Step\CiviCRMUpgraderStep;

/**
 * Implements compuclient_update_7101().
 * Enable front_page, login_destination
 * administerusersbyrole, role_delegation, node_clone modules
 * and upgrade CiviCRM to version 5.17.4
 */
function compuclient_update_7101() {
  _compuclient_enable_7101_modules();
  _compuclient_config_shoreditch_companion_theme();
  _compuclient_upgrade_7101_civicrm();
}

function _compuclient_enable_7101_modules() {
  $modules = [
    'front_page',
    'login_destination',
    'chain_menu_access',
    'administerusersbyrole',
    'role_delegation',
    'clone'
  ];
  module_enable($modules);
}

function _compuclient_config_shoreditch_companion_theme() {
  $step = new ShoreditchCompanionThemeConfigurationStep();
  $step->apply();
}

function _compuclient_upgrade_7101_civicrm() {
  $step = new CiviCRMUpgraderStep();
  $step->apply();
}


