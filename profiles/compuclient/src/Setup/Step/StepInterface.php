<?php

namespace Drupal\compuclient\Setup\Step;

interface StepInterface {

  /**
   * Make changes when upgrading or installing a site
   *
   * @return void
   */
  public function apply();

}
