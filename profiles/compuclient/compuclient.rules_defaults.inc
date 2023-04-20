<?php

/**
 * Implements hook_default_rules_configuration().
 */
function compuclient_default_rules_configuration() {
  $configs = [];
  if (!module_exists('civicrm') || !module_exists('civicrm_entity')) {
    return $configs;
  }

  civicrm_initialize();
  $tag = civicrm_api3('Tag', 'get', [
  'sequential' => 1,
    'name' => 'Create Drupal Account',
  ]);

  if (!isset($tag['id'])) {
    return $configs;
  }

  $rule = rules_reaction_rule();
  $rule->label = 'CiviCRM Entity Tag has been created';
  $rule->active = TRUE;
  $rule->owner = 'rules';
  $rule->event('civicrm_entity_tag_create')
      ->condition(rules_condition('data_is', ['data:select' => 'civicrm-entity-tag:tag-id', 'value' => $tag['id']]))
      ->action('civicrm_entity_action_load_create_user', [
          'civicrm_contact:select' => 'civicrm-entity-tag:entity-id-contact',
          'is_active' => TRUE,
          'notify' => TRUE,
          'civicrm_user' => [ 'civicrm_user'  => 'Created or Loaded Drupal User' ]
        ]);

  $configs['rule_civicrm_entity_tag_has_been_created'] = $rule;

  return $configs;

}
