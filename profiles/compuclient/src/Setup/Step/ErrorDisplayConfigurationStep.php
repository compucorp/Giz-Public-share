<?php

namespace Drupal\compuclient\Setup\Step;

class ErrorDisplayConfigurationStep implements StepInterface {

  /**
   * For development environments this can be turned on, but the security
   * review module recommends that errors be hidden in production.
   *
   * @inheritdoc
   */
  public function apply() {
    variable_set('error_level', 0);
  }

}
