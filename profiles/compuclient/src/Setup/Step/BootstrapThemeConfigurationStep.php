<?php

namespace Drupal\compuclient\Setup\Step;

class BootstrapThemeConfigurationStep implements StepInterface {

  /**
   * Apply BootstrapThemeConfigurationStep
   */
  public function apply() {
    $this->bootstrapThemeTheme();
  }

  private function bootstrapThemeTheme(){
    theme_enable(['bootstrap']);
    variable_set('theme_default' , 'bootstrap');
  }

}
