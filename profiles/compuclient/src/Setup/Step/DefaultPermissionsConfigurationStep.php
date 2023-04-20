<?php

namespace Drupal\compuclient\Setup\Step;

class DefaultPermissionsConfigurationStep implements StepInterface {

  /**
   * Set up default roles and permission
   */
  public function apply() {
    module_enable([
      'compuclient_default_roles_and_permissions',
    ]);
  }
}
