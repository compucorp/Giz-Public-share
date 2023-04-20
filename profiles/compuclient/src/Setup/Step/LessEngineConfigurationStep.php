<?php

namespace Drupal\compuclient\Setup\Step;

class LessEngineConfigurationStep implements StepInterface {

  /**
   * Because of how the LESS module searches for available engines it will
   * not detect the library we use unless some settings are changed.
   *
   * @inheritdoc
   */
  public function apply() {
    variable_set('less_engine', 'less.php');
  }

}
