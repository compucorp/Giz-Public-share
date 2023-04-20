<?php

/**
 * Upgrade CiviCRM extensions and Assign new permissions.
 */
function compuclient_update_7113() {
    civicrm_initialize();

    // The CaseCategoryInstance Entity has been added as part CiviCase 1.9.1,
    // but on sites where logging is enabled (which is the case for live sites)
    // a log table for this entity won't be created automatically, so need this
    // API call
    civicrm_api3('System', 'createmissinglogtables');

    civicrm_api3('Extension', 'upgrade');


    $permissions = array('access export action');
    foreach(['administrator', 'CiviCRM Admin', 'CiviCRM User'] as $roleName) {
        $role = user_role_load_by_name($roleName);
        if ($role) {
            user_role_grant_permissions($role->rid, $permissions);
        }
    }
}
