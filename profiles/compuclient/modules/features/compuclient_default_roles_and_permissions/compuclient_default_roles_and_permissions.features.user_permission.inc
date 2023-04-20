<?php

/**
 * @file
 * compuclient_default_roles_and_permissions.features.user_permission.inc
 */

/**
 * Implements hook_user_default_permissions().
 */
function compuclient_default_roles_and_permissions_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'access AJAX API'.
  $permissions['access AJAX API'] = array(
    'name' => 'access AJAX API',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access CiviCRM'.
  $permissions['access CiviCRM'] = array(
    'name' => 'access CiviCRM',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access CiviContribute'.
  $permissions['access CiviContribute'] = array(
    'name' => 'access CiviContribute',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access CiviEvent'.
  $permissions['access CiviEvent'] = array(
    'name' => 'access CiviEvent',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access CiviMail'.
  $permissions['access CiviMail'] = array(
    'name' => 'access CiviMail',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access CiviMail subscribe/unsubscribe pages'.
  $permissions['access CiviMail subscribe/unsubscribe pages'] = array(
    'name' => 'access CiviMail subscribe/unsubscribe pages',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access CiviMember'.
  $permissions['access CiviMember'] = array(
    'name' => 'access CiviMember',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access CiviPledge'.
  $permissions['access CiviPledge'] = array(
    'name' => 'access CiviPledge',
    'roles' => array(
      'CiviProspect User' => 'CiviProspect User',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access CiviReport'.
  $permissions['access CiviReport'] = array(
    'name' => 'access CiviReport',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access Contact Dashboard'.
  $permissions['access Contact Dashboard'] = array(
    'name' => 'access Contact Dashboard',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access Report Criteria'.
  $permissions['access Report Criteria'] = array(
    'name' => 'access Report Criteria',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access administration menu'.
  $permissions['access administration menu'] = array(
    'name' => 'access administration menu',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'admin_menu',
  );

  // Exported permission: 'access administration pages'.
  $permissions['access administration pages'] = array(
    'name' => 'access administration pages',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'access advuser'.
  $permissions['access advuser'] = array(
    'name' => 'access advuser',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'advuser',
  );

  // Exported permission: 'access all awards and activities'.
  $permissions['access all awards and activities'] = array(
    'name' => 'access all awards and activities',
    'roles' => array(
      'Award Manager' => 'Award Manager',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access all cases and activities'.
  $permissions['access all cases and activities'] = array(
    'name' => 'access all cases and activities',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCase User' => 'CiviCase User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access all custom data'.
  $permissions['access all custom data'] = array(
    'name' => 'access all custom data',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access all prospecting and activities'.
  $permissions['access all prospecting and activities'] = array(
    'name' => 'access all prospecting and activities',
    'roles' => array(
      'CiviProspect User' => 'CiviProspect User',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access all views'.
  $permissions['access all views'] = array(
    'name' => 'access all views',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'views',
  );

  // Exported permission: 'access all webform results'.
  $permissions['access all webform results'] = array(
    'name' => 'access all webform results',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'access bean overview'.
  $permissions['access bean overview'] = array(
    'name' => 'access bean overview',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'access civicrm group role setting'.
  $permissions['access civicrm group role setting'] = array(
    'name' => 'access civicrm group role setting',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm_group_roles',
  );

  // Exported permission: 'access civicrm member role setting'.
  $permissions['access civicrm member role setting'] = array(
    'name' => 'access civicrm member role setting',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm_member_roles',
  );

  // Exported permission: 'access comments'.
  $permissions['access comments'] = array(
    'name' => 'access comments',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'comment',
  );

  // Exported permission: 'access contact reference fields'.
  $permissions['access contact reference fields'] = array(
    'name' => 'access contact reference fields',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access content'.
  $permissions['access content'] = array(
    'name' => 'access content',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'node',
  );

  // Exported permission: 'access content overview'.
  $permissions['access content overview'] = array(
    'name' => 'access content overview',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'access contextual links'.
  $permissions['access contextual links'] = array(
    'name' => 'access contextual links',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'contextual',
  );

  // Exported permission: 'access dashboard'.
  $permissions['access dashboard'] = array(
    'name' => 'access dashboard',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'dashboard',
  );

  // Exported permission: 'access deleted contacts'.
  $permissions['access deleted contacts'] = array(
    'name' => 'access deleted contacts',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access export action'.
  $permissions['access export action'] = array(
    'name' => 'access export action',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access flood unblock'.
  $permissions['access flood unblock'] = array(
    'name' => 'access flood unblock',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'flood_unblock',
  );

  // Exported permission: 'access library reports'.
  $permissions['access library reports'] = array(
    'name' => 'access library reports',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'libraries',
  );

  // Exported permission: 'access my awards and activities'.
  $permissions['access my awards and activities'] = array(
    'name' => 'access my awards and activities',
    'roles' => array(
      'Award Manager' => 'Award Manager',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access my cases and activities'.
  $permissions['access my cases and activities'] = array(
    'name' => 'access my cases and activities',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCase User' => 'CiviCase User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access my prospecting and activities'.
  $permissions['access my prospecting and activities'] = array(
    'name' => 'access my prospecting and activities',
    'roles' => array(
      'CiviProspect User' => 'CiviProspect User',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access own webform results'.
  $permissions['access own webform results'] = array(
    'name' => 'access own webform results',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'access own webform submissions'.
  $permissions['access own webform submissions'] = array(
    'name' => 'access own webform submissions',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'access payment custom field set'.
  $permissions['access payment custom field set'] = array(
    'name' => 'access payment custom field set',
    'roles' => array(
      'Award Manager' => 'Award Manager',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access review custom field set'.
  $permissions['access review custom field set'] = array(
    'name' => 'access review custom field set',
    'roles' => array(
      'Award Manager' => 'Award Manager',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access rules debug'.
  $permissions['access rules debug'] = array(
    'name' => 'access rules debug',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'rules',
  );

  // Exported permission: 'access security review list'.
  $permissions['access security review list'] = array(
    'name' => 'access security review list',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'security_review',
  );

  // Exported permission: 'access site in maintenance mode'.
  $permissions['access site in maintenance mode'] = array(
    'name' => 'access site in maintenance mode',
    'roles' => array(
      'Maintenance Mode User' => 'Maintenance Mode User',
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'access site map'.
  $permissions['access site map'] = array(
    'name' => 'access site map',
    'roles' => array(
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'site_map',
  );

  // Exported permission: 'access site reports'.
  $permissions['access site reports'] = array(
    'name' => 'access site reports',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'access statistics'.
  $permissions['access statistics'] = array(
    'name' => 'access statistics',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'statistics',
  );

  // Exported permission: 'access uploaded files'.
  $permissions['access uploaded files'] = array(
    'name' => 'access uploaded files',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'Maintenance Mode User' => 'Maintenance Mode User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'access user profiles'.
  $permissions['access user profiles'] = array(
    'name' => 'access user profiles',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'user',
  );

  // Exported permission: 'access users overview'.
  $permissions['access users overview'] = array(
    'name' => 'access users overview',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'add JS snippets for google analytics'.
  $permissions['add JS snippets for google analytics'] = array(
    'name' => 'add JS snippets for google analytics',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'googleanalytics',
  );

  // Exported permission: 'add awards'.
  $permissions['add awards'] = array(
    'name' => 'add awards',
    'roles' => array(
      'Award Manager' => 'Award Manager',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'add cases'.
  $permissions['add cases'] = array(
    'name' => 'add cases',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCase User' => 'CiviCase User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'add contact notes'.
  $permissions['add contact notes'] = array(
    'name' => 'add contact notes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'add contacts'.
  $permissions['add contacts'] = array(
    'name' => 'add contacts',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'add prospecting'.
  $permissions['add prospecting'] = array(
    'name' => 'add prospecting',
    'roles' => array(
      'CiviProspect User' => 'CiviProspect User',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'administer CiviCRM'.
  $permissions['administer CiviCRM'] = array(
    'name' => 'administer CiviCRM',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'administer CiviCRM Entity'.
  $permissions['administer CiviCRM Entity'] = array(
    'name' => 'administer CiviCRM Entity',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm_entity',
  );

  // Exported permission: 'administer CiviCase'.
  $permissions['administer CiviCase'] = array(
    'name' => 'administer CiviCase',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'administer CiviDiscount'.
  $permissions['administer CiviDiscount'] = array(
    'name' => 'administer CiviDiscount',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'administer Reports'.
  $permissions['administer Reports'] = array(
    'name' => 'administer Reports',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'administer Tagsets'.
  $permissions['administer Tagsets'] = array(
    'name' => 'administer Tagsets',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'administer actions'.
  $permissions['administer actions'] = array(
    'name' => 'administer actions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'administer advanced pane settings'.
  $permissions['administer advanced pane settings'] = array(
    'name' => 'administer advanced pane settings',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'administer advuser'.
  $permissions['administer advuser'] = array(
    'name' => 'administer advuser',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'advuser',
  );

  // Exported permission: 'administer autologout'.
  $permissions['administer autologout'] = array(
    'name' => 'administer autologout',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'autologout',
  );

  // Exported permission: 'administer bean settings'.
  $permissions['administer bean settings'] = array(
    'name' => 'administer bean settings',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'administer bean types'.
  $permissions['administer bean types'] = array(
    'name' => 'administer bean types',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'administer beans'.
  $permissions['administer beans'] = array(
    'name' => 'administer beans',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'administer block classes'.
  $permissions['administer block classes'] = array(
    'name' => 'administer block classes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'block_class',
  );

  // Exported permission: 'administer blocks'.
  $permissions['administer blocks'] = array(
    'name' => 'administer blocks',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'block',
  );

  // Exported permission: 'administer comments'.
  $permissions['administer comments'] = array(
    'name' => 'administer comments',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'comment',
  );

  // Exported permission: 'administer content types'.
  $permissions['administer content types'] = array(
    'name' => 'administer content types',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'administer dedupe rules'.
  $permissions['administer dedupe rules'] = array(
    'name' => 'administer dedupe rules',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'administer elysia_cron'.
  $permissions['administer elysia_cron'] = array(
    'name' => 'administer elysia_cron',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'elysia_cron',
  );

  // Exported permission: 'administer features'.
  $permissions['administer features'] = array(
    'name' => 'administer features',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'features',
  );

  // Exported permission: 'administer field collections'.
  $permissions['administer field collections'] = array(
    'name' => 'administer field collections',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'field_collection',
  );

  // Exported permission: 'administer fields'.
  $permissions['administer fields'] = array(
    'name' => 'administer fields',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'field',
  );

  // Exported permission: 'administer filters'.
  $permissions['administer filters'] = array(
    'name' => 'administer filters',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'filter',
  );

  // Exported permission: 'administer front page'.
  $permissions['administer front page'] = array(
    'name' => 'administer front page',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'front_page',
  );

  // Exported permission: 'administer google analytics'.
  $permissions['administer google analytics'] = array(
    'name' => 'administer google analytics',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'googleanalytics',
  );

  // Exported permission: 'administer honeypot'.
  $permissions['administer honeypot'] = array(
    'name' => 'administer honeypot',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'honeypot',
  );

  // Exported permission: 'administer hotjar'.
  $permissions['administer hotjar'] = array(
    'name' => 'administer hotjar',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'hotjar',
  );

  // Exported permission: 'administer image styles'.
  $permissions['administer image styles'] = array(
    'name' => 'administer image styles',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'image',
  );

  // Exported permission: 'administer imce'.
  $permissions['administer imce'] = array(
    'name' => 'administer imce',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'imce',
  );

  // Exported permission: 'administer languages'.
  $permissions['administer languages'] = array(
    'name' => 'administer languages',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'locale',
  );

  // Exported permission: 'administer less'.
  $permissions['administer less'] = array(
    'name' => 'administer less',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'less',
  );

  // Exported permission: 'administer login destination settings'.
  $permissions['administer login destination settings'] = array(
    'name' => 'administer login destination settings',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'login_destination',
  );

  // Exported permission: 'administer mailsystem'.
  $permissions['administer mailsystem'] = array(
    'name' => 'administer mailsystem',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'mailsystem',
  );

  // Exported permission: 'administer manualcrop settings'.
  $permissions['administer manualcrop settings'] = array(
    'name' => 'administer manualcrop settings',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'manualcrop',
  );

  // Exported permission: 'administer masquerade'.
  $permissions['administer masquerade'] = array(
    'name' => 'administer masquerade',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'masquerade',
  );

  // Exported permission: 'administer menu'.
  $permissions['administer menu'] = array(
    'name' => 'administer menu',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'menu',
  );

  // Exported permission: 'administer menu attributes'.
  $permissions['administer menu attributes'] = array(
    'name' => 'administer menu attributes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'menu_attributes',
  );

  // Exported permission: 'administer menu_token'.
  $permissions['administer menu_token'] = array(
    'name' => 'administer menu_token',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'menu_token',
  );

  // Exported permission: 'administer module filter'.
  $permissions['administer module filter'] = array(
    'name' => 'administer module filter',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'module_filter',
  );

  // Exported permission: 'administer modules'.
  $permissions['administer modules'] = array(
    'name' => 'administer modules',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'administer nodequeue'.
  $permissions['administer nodequeue'] = array(
    'name' => 'administer nodequeue',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'nodequeue',
  );

  // Exported permission: 'administer nodes'.
  $permissions['administer nodes'] = array(
    'name' => 'administer nodes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'administer page manager'.
  $permissions['administer page manager'] = array(
    'name' => 'administer page manager',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'page_manager',
  );

  // Exported permission: 'administer pane access'.
  $permissions['administer pane access'] = array(
    'name' => 'administer pane access',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'administer panels display styles'.
  $permissions['administer panels display styles'] = array(
    'name' => 'administer panels display styles',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'administer panels layouts'.
  $permissions['administer panels layouts'] = array(
    'name' => 'administer panels layouts',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'administer panels pane styles'.
  $permissions['administer panels pane styles'] = array(
    'name' => 'administer panels pane styles',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'administer panels region styles'.
  $permissions['administer panels region styles'] = array(
    'name' => 'administer panels region styles',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'administer panels styles'.
  $permissions['administer panels styles'] = array(
    'name' => 'administer panels styles',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'administer paragraphs bundles'.
  $permissions['administer paragraphs bundles'] = array(
    'name' => 'administer paragraphs bundles',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'paragraphs',
  );

  // Exported permission: 'administer password policies'.
  $permissions['administer password policies'] = array(
    'name' => 'administer password policies',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'password_policy',
  );

  // Exported permission: 'administer pathauto'.
  $permissions['administer pathauto'] = array(
    'name' => 'administer pathauto',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'pathauto',
  );

  // Exported permission: 'administer payment processors'.
  $permissions['administer payment processors'] = array(
    'name' => 'administer payment processors',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'administer permissions'.
  $permissions['administer permissions'] = array(
    'name' => 'administer permissions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'user',
  );

  // Exported permission: 'administer private reports'.
  $permissions['administer private reports'] = array(
    'name' => 'administer private reports',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'administer redirects'.
  $permissions['administer redirects'] = array(
    'name' => 'administer redirects',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'redirect',
  );

  // Exported permission: 'administer reserved groups'.
  $permissions['administer reserved groups'] = array(
    'name' => 'administer reserved groups',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'administer reserved reports'.
  $permissions['administer reserved reports'] = array(
    'name' => 'administer reserved reports',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'administer reserved tags'.
  $permissions['administer reserved tags'] = array(
    'name' => 'administer reserved tags',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'administer rules'.
  $permissions['administer rules'] = array(
    'name' => 'administer rules',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'rules',
  );

  // Exported permission: 'administer search'.
  $permissions['administer search'] = array(
    'name' => 'administer search',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'search',
  );

  // Exported permission: 'administer session limits by role'.
  $permissions['administer session limits by role'] = array(
    'name' => 'administer session limits by role',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'session_limit',
  );

  // Exported permission: 'administer session limits per user'.
  $permissions['administer session limits per user'] = array(
    'name' => 'administer session limits per user',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'session_limit',
  );

  // Exported permission: 'administer shortcuts'.
  $permissions['administer shortcuts'] = array(
    'name' => 'administer shortcuts',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'shortcut',
  );

  // Exported permission: 'administer site configuration'.
  $permissions['administer site configuration'] = array(
    'name' => 'administer site configuration',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'administer smtp module'.
  $permissions['administer smtp module'] = array(
    'name' => 'administer smtp module',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'smtp',
  );

  // Exported permission: 'administer software updates'.
  $permissions['administer software updates'] = array(
    'name' => 'administer software updates',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'administer statistics'.
  $permissions['administer statistics'] = array(
    'name' => 'administer statistics',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'statistics',
  );

  // Exported permission: 'administer taxonomy'.
  $permissions['administer taxonomy'] = array(
    'name' => 'administer taxonomy',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'taxonomy',
  );

  // Exported permission: 'administer themes'.
  $permissions['administer themes'] = array(
    'name' => 'administer themes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'administer url aliases'.
  $permissions['administer url aliases'] = array(
    'name' => 'administer url aliases',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'path',
  );

  // Exported permission: 'administer users'.
  $permissions['administer users'] = array(
    'name' => 'administer users',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'user',
  );

  // Exported permission: 'administer uuid'.
  $permissions['administer uuid'] = array(
    'name' => 'administer uuid',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'uuid',
  );

  // Exported permission: 'administer views'.
  $permissions['administer views'] = array(
    'name' => 'administer views',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'views',
  );

  // Exported permission: 'administer xmlsitemap'.
  $permissions['administer xmlsitemap'] = array(
    'name' => 'administer xmlsitemap',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'xmlsitemap',
  );

  // Exported permission: 'assign CiviCRM Admin role'.
  $permissions['assign CiviCRM Admin role'] = array(
    'name' => 'assign CiviCRM Admin role',
    'roles' => array(),
    'module' => 'role_delegation',
  );

  // Exported permission: 'assign CiviCRM User role'.
  $permissions['assign CiviCRM User role'] = array(
    'name' => 'assign CiviCRM User role',
    'roles' => array(),
    'module' => 'role_delegation',
  );

  // Exported permission: 'assign CiviCase User role'.
  $permissions['assign CiviCase User role'] = array(
    'name' => 'assign CiviCase User role',
    'roles' => array(),
    'module' => 'role_delegation',
  );

  // Exported permission: 'assign CiviProspect User role'.
  $permissions['assign CiviProspect User role'] = array(
    'name' => 'assign CiviProspect User role',
    'roles' => array(),
    'module' => 'role_delegation',
  );

  // Exported permission: 'assign Maintenance Mode User role'.
  $permissions['assign Maintenance Mode User role'] = array(
    'name' => 'assign Maintenance Mode User role',
    'roles' => array(),
    'module' => 'role_delegation',
  );

  // Exported permission: 'assign all roles'.
  $permissions['assign all roles'] = array(
    'name' => 'assign all roles',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'role_delegation',
  );

  // Exported permission: 'basic awards information'.
  $permissions['basic awards information'] = array(
    'name' => 'basic awards information',
    'roles' => array(
      'Award Manager' => 'Award Manager',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'basic case information'.
  $permissions['basic case information'] = array(
    'name' => 'basic case information',
    'roles' => array(
      'CiviCase User' => 'CiviCase User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'basic prospecting information'.
  $permissions['basic prospecting information'] = array(
    'name' => 'basic prospecting information',
    'roles' => array(
      'CiviProspect User' => 'CiviProspect User',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'block IP addresses'.
  $permissions['block IP addresses'] = array(
    'name' => 'block IP addresses',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'bypass access in place editing'.
  $permissions['bypass access in place editing'] = array(
    'name' => 'bypass access in place editing',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'bypass honeypot protection'.
  $permissions['bypass honeypot protection'] = array(
    'name' => 'bypass honeypot protection',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'honeypot',
  );

  // Exported permission: 'bypass node access'.
  $permissions['bypass node access'] = array(
    'name' => 'bypass node access',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'bypass rules access'.
  $permissions['bypass rules access'] = array(
    'name' => 'bypass rules access',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'rules',
  );

  // Exported permission: 'cancel account'.
  $permissions['cancel account'] = array(
    'name' => 'cancel account',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'user',
  );

  // Exported permission: 'cancel users with role 2'.
  $permissions['cancel users with role 2'] = array(
    'name' => 'cancel users with role 2',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'cancel users with role 4'.
  $permissions['cancel users with role 4'] = array(
    'name' => 'cancel users with role 4',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'cancel users with role 5'.
  $permissions['cancel users with role 5'] = array(
    'name' => 'cancel users with role 5',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'cancel users with role 6'.
  $permissions['cancel users with role 6'] = array(
    'name' => 'cancel users with role 6',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'cancel users with role 7'.
  $permissions['cancel users with role 7'] = array(
    'name' => 'cancel users with role 7',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'cancel users with role 8'.
  $permissions['cancel users with role 8'] = array(
    'name' => 'cancel users with role 8',
    'roles' => array(),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'cancel users with role 9'.
  $permissions['cancel users with role 9'] = array(
    'name' => 'cancel users with role 9',
    'roles' => array(),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'change layouts in place editing'.
  $permissions['change layouts in place editing'] = array(
    'name' => 'change layouts in place editing',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'change own logout threshold'.
  $permissions['change own logout threshold'] = array(
    'name' => 'change own logout threshold',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'autologout',
  );

  // Exported permission: 'change own username'.
  $permissions['change own username'] = array(
    'name' => 'change own username',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'user',
  );

  // Exported permission: 'civicrm_entity.rules.administer'.
  $permissions['civicrm_entity.rules.administer'] = array(
    'name' => 'civicrm_entity.rules.administer',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm_entity',
  );

  // Exported permission: 'clone node'.
  $permissions['clone node'] = array(
    'name' => 'clone node',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'clone',
  );

  // Exported permission: 'clone own nodes'.
  $permissions['clone own nodes'] = array(
    'name' => 'clone own nodes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'clone',
  );

  // Exported permission: 'close all manual batches'.
  $permissions['close all manual batches'] = array(
    'name' => 'close all manual batches',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'close own manual batches'.
  $permissions['close own manual batches'] = array(
    'name' => 'close own manual batches',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'create article content'.
  $permissions['create article content'] = array(
    'name' => 'create article content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'create manual batch'.
  $permissions['create manual batch'] = array(
    'name' => 'create manual batch',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'create page content'.
  $permissions['create page content'] = array(
    'name' => 'create page content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'create url aliases'.
  $permissions['create url aliases'] = array(
    'name' => 'create url aliases',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'path',
  );

  // Exported permission: 'create users'.
  $permissions['create users'] = array(
    'name' => 'create users',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'create webform content'.
  $permissions['create webform content'] = array(
    'name' => 'create webform content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'create/edit awards'.
  $permissions['create/edit awards'] = array(
    'name' => 'create/edit awards',
    'roles' => array(
      'Award Manager' => 'Award Manager',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'customize shortcut links'.
  $permissions['customize shortcut links'] = array(
    'name' => 'customize shortcut links',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'shortcut',
  );

  // Exported permission: 'delete activities'.
  $permissions['delete activities'] = array(
    'name' => 'delete activities',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'delete all manual batches'.
  $permissions['delete all manual batches'] = array(
    'name' => 'delete all manual batches',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'delete all webform submissions'.
  $permissions['delete all webform submissions'] = array(
    'name' => 'delete all webform submissions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'delete any article content'.
  $permissions['delete any article content'] = array(
    'name' => 'delete any article content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete any page content'.
  $permissions['delete any page content'] = array(
    'name' => 'delete any page content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete any webform content'.
  $permissions['delete any webform content'] = array(
    'name' => 'delete any webform content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete contacts'.
  $permissions['delete contacts'] = array(
    'name' => 'delete contacts',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'delete in CiviAwards'.
  $permissions['delete in CiviAwards'] = array(
    'name' => 'delete in CiviAwards',
    'roles' => array(
      'Award Manager' => 'Award Manager',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'delete in CiviCase'.
  $permissions['delete in CiviCase'] = array(
    'name' => 'delete in CiviCase',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'delete in CiviContribute'.
  $permissions['delete in CiviContribute'] = array(
    'name' => 'delete in CiviContribute',
    'roles' => array(),
    'module' => 'civicrm',
  );

  // Exported permission: 'delete in CiviEvent'.
  $permissions['delete in CiviEvent'] = array(
    'name' => 'delete in CiviEvent',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'delete in CiviMail'.
  $permissions['delete in CiviMail'] = array(
    'name' => 'delete in CiviMail',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'delete in CiviMember'.
  $permissions['delete in CiviMember'] = array(
    'name' => 'delete in CiviMember',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'delete in CiviProspecting'.
  $permissions['delete in CiviProspecting'] = array(
    'name' => 'delete in CiviProspecting',
    'roles' => array(),
    'module' => 'civicrm',
  );

  // Exported permission: 'delete own article content'.
  $permissions['delete own article content'] = array(
    'name' => 'delete own article content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete own manual batches'.
  $permissions['delete own manual batches'] = array(
    'name' => 'delete own manual batches',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'delete own page content'.
  $permissions['delete own page content'] = array(
    'name' => 'delete own page content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete own webform content'.
  $permissions['delete own webform content'] = array(
    'name' => 'delete own webform content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete own webform submissions'.
  $permissions['delete own webform submissions'] = array(
    'name' => 'delete own webform submissions',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'delete revisions'.
  $permissions['delete revisions'] = array(
    'name' => 'delete revisions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete terms in tags'.
  $permissions['delete terms in tags'] = array(
    'name' => 'delete terms in tags',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'taxonomy',
  );

  // Exported permission: 'diff view changes'.
  $permissions['diff view changes'] = array(
    'name' => 'diff view changes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'diff',
  );

  // Exported permission: 'display drupal links'.
  $permissions['display drupal links'] = array(
    'name' => 'display drupal links',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'admin_menu',
  );

  // Exported permission: 'edit all contacts'.
  $permissions['edit all contacts'] = array(
    'name' => 'edit all contacts',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit all events'.
  $permissions['edit all events'] = array(
    'name' => 'edit all events',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit all manual batches'.
  $permissions['edit all manual batches'] = array(
    'name' => 'edit all manual batches',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit all webform submissions'.
  $permissions['edit all webform submissions'] = array(
    'name' => 'edit all webform submissions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'edit any article content'.
  $permissions['edit any article content'] = array(
    'name' => 'edit any article content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit any page content'.
  $permissions['edit any page content'] = array(
    'name' => 'edit any page content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit any webform content'.
  $permissions['edit any webform content'] = array(
    'name' => 'edit any webform content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit api keys'.
  $permissions['edit api keys'] = array(
    'name' => 'edit api keys',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit bean view mode'.
  $permissions['edit bean view mode'] = array(
    'name' => 'edit bean view mode',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'edit contributions'.
  $permissions['edit contributions'] = array(
    'name' => 'edit contributions',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit event participants'.
  $permissions['edit event participants'] = array(
    'name' => 'edit event participants',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit field collections'.
  $permissions['edit field collections'] = array(
    'name' => 'edit field collections',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'field_collection',
  );

  // Exported permission: 'edit groups'.
  $permissions['edit groups'] = array(
    'name' => 'edit groups',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit inbound email basic information'.
  $permissions['edit inbound email basic information'] = array(
    'name' => 'edit inbound email basic information',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit inbound email basic information and content'.
  $permissions['edit inbound email basic information and content'] = array(
    'name' => 'edit inbound email basic information and content',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit memberships'.
  $permissions['edit memberships'] = array(
    'name' => 'edit memberships',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit message templates'.
  $permissions['edit message templates'] = array(
    'name' => 'edit message templates',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit mimemail user settings'.
  $permissions['edit mimemail user settings'] = array(
    'name' => 'edit mimemail user settings',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'mimemail',
  );

  // Exported permission: 'edit my contact'.
  $permissions['edit my contact'] = array(
    'name' => 'edit my contact',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit own api keys'.
  $permissions['edit own api keys'] = array(
    'name' => 'edit own api keys',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit own article content'.
  $permissions['edit own article content'] = array(
    'name' => 'edit own article content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit own comments'.
  $permissions['edit own comments'] = array(
    'name' => 'edit own comments',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'comment',
  );

  // Exported permission: 'edit own manual batches'.
  $permissions['edit own manual batches'] = array(
    'name' => 'edit own manual batches',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit own page content'.
  $permissions['edit own page content'] = array(
    'name' => 'edit own page content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit own webform content'.
  $permissions['edit own webform content'] = array(
    'name' => 'edit own webform content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit own webform submissions'.
  $permissions['edit own webform submissions'] = array(
    'name' => 'edit own webform submissions',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'edit pledges'.
  $permissions['edit pledges'] = array(
    'name' => 'edit pledges',
    'roles' => array(
      'CiviProspect User' => 'CiviProspect User',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit system workflow message templates'.
  $permissions['edit system workflow message templates'] = array(
    'name' => 'edit system workflow message templates',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit terms in tags'.
  $permissions['edit terms in tags'] = array(
    'name' => 'edit terms in tags',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit user-driven message templates'.
  $permissions['edit user-driven message templates'] = array(
    'name' => 'edit user-driven message templates',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'edit users with role 2'.
  $permissions['edit users with role 2'] = array(
    'name' => 'edit users with role 2',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'edit users with role 4'.
  $permissions['edit users with role 4'] = array(
    'name' => 'edit users with role 4',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'edit users with role 5'.
  $permissions['edit users with role 5'] = array(
    'name' => 'edit users with role 5',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'edit users with role 6'.
  $permissions['edit users with role 6'] = array(
    'name' => 'edit users with role 6',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'edit users with role 7'.
  $permissions['edit users with role 7'] = array(
    'name' => 'edit users with role 7',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'edit users with role 8'.
  $permissions['edit users with role 8'] = array(
    'name' => 'edit users with role 8',
    'roles' => array(),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'edit users with role 9'.
  $permissions['edit users with role 9'] = array(
    'name' => 'edit users with role 9',
    'roles' => array(),
    'module' => 'administerusersbyrole',
  );

  // Exported permission: 'edit webform components'.
  $permissions['edit webform components'] = array(
    'name' => 'edit webform components',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'execute elysia_cron'.
  $permissions['execute elysia_cron'] = array(
    'name' => 'execute elysia_cron',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'elysia_cron',
  );

  // Exported permission: 'export all manual batches'.
  $permissions['export all manual batches'] = array(
    'name' => 'export all manual batches',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'export nodes'.
  $permissions['export nodes'] = array(
    'name' => 'export nodes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node_export',
  );

  // Exported permission: 'export own manual batches'.
  $permissions['export own manual batches'] = array(
    'name' => 'export own manual batches',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'export own nodes'.
  $permissions['export own nodes'] = array(
    'name' => 'export own nodes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node_export',
  );

  // Exported permission: 'flush caches'.
  $permissions['flush caches'] = array(
    'name' => 'flush caches',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'admin_menu',
  );

  // Exported permission: 'force merge duplicate contacts'.
  $permissions['force merge duplicate contacts'] = array(
    'name' => 'force merge duplicate contacts',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'force password change'.
  $permissions['force password change'] = array(
    'name' => 'force password change',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'password_policy',
  );

  // Exported permission: 'generate features'.
  $permissions['generate features'] = array(
    'name' => 'generate features',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'features',
  );

  // Exported permission: 'import SQL datasource'.
  $permissions['import SQL datasource'] = array(
    'name' => 'import SQL datasource',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'import contacts'.
  $permissions['import contacts'] = array(
    'name' => 'import contacts',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'make online contributions'.
  $permissions['make online contributions'] = array(
    'name' => 'make online contributions',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'CiviCase User' => 'CiviCase User',
      'CiviProspect User' => 'CiviProspect User',
      'Maintenance Mode User' => 'Maintenance Mode User',
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'manage event profiles'.
  $permissions['manage event profiles'] = array(
    'name' => 'manage event profiles',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'manage features'.
  $permissions['manage features'] = array(
    'name' => 'manage features',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'features',
  );

  // Exported permission: 'manage tags'.
  $permissions['manage tags'] = array(
    'name' => 'manage tags',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'manipulate all queues'.
  $permissions['manipulate all queues'] = array(
    'name' => 'manipulate all queues',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'nodequeue',
  );

  // Exported permission: 'manipulate queues'.
  $permissions['manipulate queues'] = array(
    'name' => 'manipulate queues',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'nodequeue',
  );

  // Exported permission: 'masquerade as admin'.
  $permissions['masquerade as admin'] = array(
    'name' => 'masquerade as admin',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'masquerade',
  );

  // Exported permission: 'masquerade as any user'.
  $permissions['masquerade as any user'] = array(
    'name' => 'masquerade as any user',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'masquerade',
  );

  // Exported permission: 'masquerade as user'.
  $permissions['masquerade as user'] = array(
    'name' => 'masquerade as user',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'masquerade',
  );

  // Exported permission: 'merge duplicate contacts'.
  $permissions['merge duplicate contacts'] = array(
    'name' => 'merge duplicate contacts',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'notify of path changes'.
  $permissions['notify of path changes'] = array(
    'name' => 'notify of path changes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'pathauto',
  );

  // Exported permission: 'opt-in or out of tracking'.
  $permissions['opt-in or out of tracking'] = array(
    'name' => 'opt-in or out of tracking',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'googleanalytics',
  );

  // Exported permission: 'post comments'.
  $permissions['post comments'] = array(
    'name' => 'post comments',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'comment',
  );

  // Exported permission: 'profile create'.
  $permissions['profile create'] = array(
    'name' => 'profile create',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'Maintenance Mode User' => 'Maintenance Mode User',
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'profile edit'.
  $permissions['profile edit'] = array(
    'name' => 'profile edit',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'Maintenance Mode User' => 'Maintenance Mode User',
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'profile listings'.
  $permissions['profile listings'] = array(
    'name' => 'profile listings',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'profile listings and forms'.
  $permissions['profile listings and forms'] = array(
    'name' => 'profile listings and forms',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'profile view'.
  $permissions['profile view'] = array(
    'name' => 'profile view',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'Maintenance Mode User' => 'Maintenance Mode User',
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'receive email advuser'.
  $permissions['receive email advuser'] = array(
    'name' => 'receive email advuser',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'advuser',
  );

  // Exported permission: 'register for events'.
  $permissions['register for events'] = array(
    'name' => 'register for events',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'rename features'.
  $permissions['rename features'] = array(
    'name' => 'rename features',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'features',
  );

  // Exported permission: 'reopen all manual batches'.
  $permissions['reopen all manual batches'] = array(
    'name' => 'reopen all manual batches',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'reopen own manual batches'.
  $permissions['reopen own manual batches'] = array(
    'name' => 'reopen own manual batches',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'revert revisions'.
  $permissions['revert revisions'] = array(
    'name' => 'revert revisions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'run security checks'.
  $permissions['run security checks'] = array(
    'name' => 'run security checks',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'security_review',
  );

  // Exported permission: 'save Report Criteria'.
  $permissions['save Report Criteria'] = array(
    'name' => 'save Report Criteria',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'search content'.
  $permissions['search content'] = array(
    'name' => 'search content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'search',
  );

  // Exported permission: 'select account cancellation method'.
  $permissions['select account cancellation method'] = array(
    'name' => 'select account cancellation method',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'user',
  );

  // Exported permission: 'send SMS'.
  $permissions['send SMS'] = array(
    'name' => 'send SMS',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'send arbitrary files'.
  $permissions['send arbitrary files'] = array(
    'name' => 'send arbitrary files',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'mimemail',
  );

  // Exported permission: 'send email advuser'.
  $permissions['send email advuser'] = array(
    'name' => 'send email advuser',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'advuser',
  );

  // Exported permission: 'skip IDS check'.
  $permissions['skip IDS check'] = array(
    'name' => 'skip IDS check',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'skip comment approval'.
  $permissions['skip comment approval'] = array(
    'name' => 'skip comment approval',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'comment',
  );

  // Exported permission: 'switch shortcut sets'.
  $permissions['switch shortcut sets'] = array(
    'name' => 'switch shortcut sets',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'shortcut',
  );

  // Exported permission: 'translate CiviCRM'.
  $permissions['translate CiviCRM'] = array(
    'name' => 'translate CiviCRM',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'translate interface'.
  $permissions['translate interface'] = array(
    'name' => 'translate interface',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'locale',
  );

  // Exported permission: 'unblock expired accounts'.
  $permissions['unblock expired accounts'] = array(
    'name' => 'unblock expired accounts',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'password_policy',
  );

  // Exported permission: 'use PHP for tracking visibility'.
  $permissions['use PHP for tracking visibility'] = array(
    'name' => 'use PHP for tracking visibility',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'googleanalytics',
  );

  // Exported permission: 'use PHP to import nodes'.
  $permissions['use PHP to import nodes'] = array(
    'name' => 'use PHP to import nodes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node_export',
  );

  // Exported permission: 'use advanced search'.
  $permissions['use advanced search'] = array(
    'name' => 'use advanced search',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'search',
  );

  // Exported permission: 'use ctools import'.
  $permissions['use ctools import'] = array(
    'name' => 'use ctools import',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'ctools',
  );

  // Exported permission: 'use ipe with page manager'.
  $permissions['use ipe with page manager'] = array(
    'name' => 'use ipe with page manager',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'use manualcrop'.
  $permissions['use manualcrop'] = array(
    'name' => 'use manualcrop',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'manualcrop',
  );

  // Exported permission: 'use page manager'.
  $permissions['use page manager'] = array(
    'name' => 'use page manager',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'page_manager',
  );

  // Exported permission: 'use panels caching features'.
  $permissions['use panels caching features'] = array(
    'name' => 'use panels caching features',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'use panels dashboard'.
  $permissions['use panels dashboard'] = array(
    'name' => 'use panels dashboard',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'use panels in place editing'.
  $permissions['use panels in place editing'] = array(
    'name' => 'use panels in place editing',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'use panels locks'.
  $permissions['use panels locks'] = array(
    'name' => 'use panels locks',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'use text format filtered_html'.
  $permissions['use text format filtered_html'] = array(
    'name' => 'use text format filtered_html',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'filter',
  );

  // Exported permission: 'use text format full_html'.
  $permissions['use text format full_html'] = array(
    'name' => 'use text format full_html',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'filter',
  );

  // Exported permission: 'use xmlsitemap'.
  $permissions['use xmlsitemap'] = array(
    'name' => 'use xmlsitemap',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'xmlsitemap',
  );

  // Exported permission: 'view all activities'.
  $permissions['view all activities'] = array(
    'name' => 'view all activities',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'view all contacts'.
  $permissions['view all contacts'] = array(
    'name' => 'view all contacts',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'view all manual batches'.
  $permissions['view all manual batches'] = array(
    'name' => 'view all manual batches',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'view all notes'.
  $permissions['view all notes'] = array(
    'name' => 'view all notes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'view any unpublished article content'.
  $permissions['view any unpublished article content'] = array(
    'name' => 'view any unpublished article content',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'view_unpublished',
  );

  // Exported permission: 'view any unpublished content'.
  $permissions['view any unpublished content'] = array(
    'name' => 'view any unpublished content',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'view_unpublished',
  );

  // Exported permission: 'view any unpublished page content'.
  $permissions['view any unpublished page content'] = array(
    'name' => 'view any unpublished page content',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'view_unpublished',
  );

  // Exported permission: 'view any unpublished webform content'.
  $permissions['view any unpublished webform content'] = array(
    'name' => 'view any unpublished webform content',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'view_unpublished',
  );

  // Exported permission: 'view bean page'.
  $permissions['view bean page'] = array(
    'name' => 'view bean page',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'view bean revisions'.
  $permissions['view bean revisions'] = array(
    'name' => 'view bean revisions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'view debug output'.
  $permissions['view debug output'] = array(
    'name' => 'view debug output',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'view elysia_cron'.
  $permissions['view elysia_cron'] = array(
    'name' => 'view elysia_cron',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'elysia_cron',
  );

  // Exported permission: 'view event info'.
  $permissions['view event info'] = array(
    'name' => 'view event info',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'view event participants'.
  $permissions['view event participants'] = array(
    'name' => 'view event participants',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'Maintenance Mode User' => 'Maintenance Mode User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'view mimemail user settings'.
  $permissions['view mimemail user settings'] = array(
    'name' => 'view mimemail user settings',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'mimemail',
  );

  // Exported permission: 'view my contact'.
  $permissions['view my contact'] = array(
    'name' => 'view my contact',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'view my invoices'.
  $permissions['view my invoices'] = array(
    'name' => 'view my invoices',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'view own manual batches'.
  $permissions['view own manual batches'] = array(
    'name' => 'view own manual batches',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'view own unpublished content'.
  $permissions['view own unpublished content'] = array(
    'name' => 'view own unpublished content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'view pane admin links'.
  $permissions['view pane admin links'] = array(
    'name' => 'view pane admin links',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'view post access counter'.
  $permissions['view post access counter'] = array(
    'name' => 'view post access counter',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'statistics',
  );

  // Exported permission: 'view public CiviMail content'.
  $permissions['view public CiviMail content'] = array(
    'name' => 'view public CiviMail content',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'CiviCase User' => 'CiviCase User',
      'CiviProspect User' => 'CiviProspect User',
      'Maintenance Mode User' => 'Maintenance Mode User',
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'view report sql'.
  $permissions['view report sql'] = array(
    'name' => 'view report sql',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'administrator' => 'administrator',
    ),
    'module' => 'civicrm',
  );

  // Exported permission: 'view revisions'.
  $permissions['view revisions'] = array(
    'name' => 'view revisions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'view the administration theme'.
  $permissions['view the administration theme'] = array(
    'name' => 'view the administration theme',
    'roles' => array(
      'CiviCRM Admin' => 'CiviCRM Admin',
      'CiviCRM User' => 'CiviCRM User',
      'CiviCase User' => 'CiviCase User',
      'CiviProspect User' => 'CiviProspect User',
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  return $permissions;
}
