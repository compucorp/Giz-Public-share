<?php

/**
 * - Installs Amazon SNS extensions
 * - Removes the captcha module
 * - Adds default honeypot settings
 */
function compuclient_update_7111() {
  civicrm_initialize();

  civicrm_api3('Extension', 'install', [
    'keys' => [
        'uk.compucorp.civicrm.amazonsns',
    ],
  ]);

  if (module_exists('captcha')) {
      module_disable(['captcha']);
      drupal_uninstall_modules(['captcha']);
  }

  /**
   * @see StandardProfileConfigurationStep::configureHoneypot()
   */
  variable_set('honeypot_form_user_register_form', 1);
  variable_set('honeypot_form_user_pass', 1);
  variable_set('honeypot_form_webforms', 1);
}
