<?php

/**
 * Update honeypot settings.
 */
function compuclient_update_7108() {
  /**
   * @see StandardProfileConfigurationStep::configureHoneypot()
   */
  variable_set('honeypot_file_default_scheme', 'public');
}
