<?php

namespace Drupal\compuclient\Setup\Step;

class NodeAccessRebuilderStep implements StepInterface {

  /**
   * If we don't run this the user will be presented with a warning that node
   * access needs to be rebuilt
   *
   * @inheritdoc
   */
  public function apply() {
    node_access_rebuild();
  }

}
