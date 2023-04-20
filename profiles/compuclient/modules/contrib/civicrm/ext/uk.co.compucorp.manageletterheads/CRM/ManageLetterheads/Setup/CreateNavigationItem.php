<?php

/**
 * Setup Class for creating the Letterhead navigation item.
 */
class CRM_ManageLetterheads_Setup_CreateNavigationItem {

  /**
   * Used for running the upgrades.
   *
   * @return bool
   *   TRUE when the upgrader runs successfully.
   */
  public function apply() {
    $this->createManageLetterheadNavigationItem();

    return TRUE;
  }

  /**
   * Creates the letterhead navigation item if it doesn't already exist.
   *
   * The navigation item is created under Communications.
   */
  private function createManageLetterheadNavigationItem() {
    $communications = civicrm_api3('Navigation', 'getsingle', [
      'name' => 'Communications',
      'parent_id' => 'Administer',
    ]);
    $letterheads = civicrm_api3('Navigation', 'get', [
      'name' => 'Letterheads',
    ]);

    if (empty($letterheads['count'])) {
      civicrm_api3('Navigation', 'create', [
        'parent_id' => $communications['id'],
        'label' => 'Letterheads',
        'name' => 'Letterheads',
        'url' => 'civicrm/letterheads/list',
        'permission' => 'manage letterheads',
        'is_active' => '1',
      ]);
    }
  }

}
