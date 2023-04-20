<?php

/**
 * @file
 * Upgrader for Compuclient 7.x-1.36.
 */

/**
 * Upgrades Compuclient to 7.x-1.36.
 */
function compuclient_update_7136() {
  // Update the 'access site map' permission for existing sites.
  // This for Compuclient native sites only, and should "Not" be added
  // to any Compuclient aligned site.
  $permissions = ['access site map'];
  foreach (['administrator'] as $role_name) {
    $role = user_role_load_by_name($role_name);
    if ($role) {
      user_role_revoke_permissions($role->rid, $permissions);
    }
  }
  foreach (['anonymous user', 'authenticated user'] as $role_name) {
    $role = user_role_load_by_name($role_name);
    if ($role) {
      user_role_grant_permissions($role->rid, $permissions);
    }
  }
}
