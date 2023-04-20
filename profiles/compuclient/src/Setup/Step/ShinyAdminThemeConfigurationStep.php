<?php

namespace Drupal\compuclient\Setup\Step;

/**
 * Class for configuring shiny admin theme.
 */
class ShinyAdminThemeConfigurationStep implements StepInterface {

  /**
   * Apply ShinyAdminThemeConfigurationStep.
   */
  public function apply() {
    $this->enableShinyAdminTheme();
    $this->disableBlocksOnShinyAdminTheme();
    $this->setShinyAdminThemeAsDefault();
  }

  /**
   * Enable shiny admin theme.
   */
  private function enableShinyAdminTheme() {
    theme_enable('shiny');
  }

  /**
   * Set shiny as default admin theme.
   */
  private function setShinyAdminThemeAsDefault() {
    variable_set('admin_theme', 'shiny');
  }

  /**
   * Disable blocks on shiny admin theme.
   */
  private function disableBlocksOnShinyAdminTheme() {
    db_update('block')
      ->fields([
        'status' => 0,
      ])
      ->condition('theme', 'shiny')
      ->condition('module', 'civicrm')
      ->condition('delta', ['1', '2', '3', '4', '5'], 'IN')
      ->execute();

    db_update('block')
      ->fields([
        'status' => 0,
      ])
      ->condition('theme', 'shiny')
      ->condition('module', 'system')
      ->condition('delta', ['main-menu', 'powered-by'], 'IN')
      ->execute();

    db_update('block')
      ->fields([
        'status' => 0,
      ])
      ->condition('theme', 'shiny')
      ->condition('module', 'menu')
      ->execute();
  }

}
