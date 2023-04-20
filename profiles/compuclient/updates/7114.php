<?php

/**
 * Set honeypot time limit to 2 seconds.
 */
function compuclient_update_7114() {
  variable_set('honeypot_time_limit', 2);
}
