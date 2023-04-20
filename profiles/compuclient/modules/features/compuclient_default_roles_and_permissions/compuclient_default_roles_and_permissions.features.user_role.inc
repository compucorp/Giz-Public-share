<?php

/**
 * @file
 * compuclient_default_roles_and_permissions.features.user_role.inc
 */

/**
 * Implements hook_user_default_roles().
 */
function compuclient_default_roles_and_permissions_user_default_roles() {
  $roles = array();

  // Exported role: Award Manager.
  $roles['Award Manager'] = array(
    'name' => 'Award Manager',
    'weight' => 7,
  );

  // Exported role: CiviCRM Admin.
  $roles['CiviCRM Admin'] = array(
    'name' => 'CiviCRM Admin',
    'weight' => 3,
  );

  // Exported role: CiviCRM User.
  $roles['CiviCRM User'] = array(
    'name' => 'CiviCRM User',
    'weight' => 4,
  );

  // Exported role: CiviCase User.
  $roles['CiviCase User'] = array(
    'name' => 'CiviCase User',
    'weight' => 5,
  );

  // Exported role: CiviProspect User.
  $roles['CiviProspect User'] = array(
    'name' => 'CiviProspect User',
    'weight' => 8,
  );

  // Exported role: Maintenance Mode User.
  $roles['Maintenance Mode User'] = array(
    'name' => 'Maintenance Mode User',
    'weight' => 6,
  );

  // Exported role: administrator.
  $roles['administrator'] = array(
    'name' => 'administrator',
    'weight' => 2,
  );

  return $roles;
}
