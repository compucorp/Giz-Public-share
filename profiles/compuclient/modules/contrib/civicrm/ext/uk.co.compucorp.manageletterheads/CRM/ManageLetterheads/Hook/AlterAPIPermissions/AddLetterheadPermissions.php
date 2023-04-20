<?php

/**
 * Adds the API permissions for the Letterhead entity.
 *
 * All CiviCRM users can access letterheads, but only administrators and
 * users with the Manage Letterhead permission can create, update, and delete
 * them.
 */
class CRM_ManageLetterheads_Hook_AlterAPIPermissions_AddLetterheadPermissions {

  /**
   * Handles the hook implementation.
   *
   * @param string $entity
   * @param string $action
   * @param array $params
   * @param array $permissions
   */
  public function run($entity, $action, &$params, &$permissions) {
    if (!$this->shouldRun($entity)) {
      return;
    }

    $this->addLetterheadPermissions($permissions);
  }

  /**
   * Adds the letterhead API permissions.
   *
   * @param array $permissions
   */
  private function addLetterheadPermissions(&$permissions) {
    $permissions['letterhead'] = [
      'get' => ['access CiviCRM'],
      'default' => ['access CiviCRM', 'manage letterheads'],
    ];
  }

  /**
   * Determines if the hook should run.
   *
   * Only adds the permissions when the request belongs to the Letterhead
   * entity.
   *
   * @param string $entity
   * @return bool
   */
  private function shouldRun($entity) {
    return $entity === 'letterhead';
  }

}
