<?php

namespace Drupal\compuclient\Setup\Step;

class ShoreditchCompanionThemeConfigurationStep implements StepInterface {

  /**
   * Apply ShoreditchConfigurationStep
   */
  public function apply() {
    $this->enableShoreditchCompanionTheme();
    $this->disableBlocksOnShoreditchCompanionTheme();
  }

  private function enableShoreditchCompanionTheme(){
    theme_enable(['shoreditch_companion_d7_theme']);
    variable_set('civicrmtheme_theme_admin' , 'shoreditch_companion_d7_theme');
  }

  private function disableBlocksOnShoreditchCompanionTheme() {
    db_update('block')
      ->fields([
        'status' => 0,
      ])
      ->condition('theme', 'shoreditch_companion_d7_theme')
      ->condition('module', 'civicrm')
      ->condition('delta', ['1', '2', '3', '4', '5'], 'IN')
      ->execute();

    db_update('block')
      ->fields([
        'status' => 0,
      ])
      ->condition('theme', 'shoreditch_companion_d7_theme')
      ->condition('module', 'search')
      ->condition('delta', 'form')
      ->execute();

    db_update('block')
      ->fields([
        'status' => 0,
      ])
      ->condition('theme', 'shoreditch_companion_d7_theme')
      ->condition('module', 'system')
      ->condition('delta', ['navigation', 'powered-by'] , 'IN')
      ->execute();

  }

}
