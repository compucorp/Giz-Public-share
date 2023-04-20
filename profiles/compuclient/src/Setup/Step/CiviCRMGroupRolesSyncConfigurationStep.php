<?php

namespace Drupal\compuclient\Setup\Step;

class CiviCRMGroupRolesSyncConfigurationStep implements StepInterface {

  /**
   * Apply CiviCRM Group Role modules
   */
  public function apply() {
    $this->enableRoleSyncModules();
    $this->enableGroupRolesDebuggingLog();
  }

  /**
   * Enable civicrm roles sync modules
   */
  private function enableRoleSyncModules() {
    module_enable(['civicrm_group_roles']);
    module_enable(['civicrm_member_roles']);
  }

  /**
   * Enable detailed database logging
   * <sites>/admin/config/civicrm/civicrm_group_roles/settings
   */
  private function enableGroupRolesDebuggingLog() {
    variable_set('civicrm_group_roles_debugging', 1);
  }

}
