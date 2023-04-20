<?php

/**
 * Uninstall Class for deleting the Letterhead navigation item.
 */
class CRM_ManageLetterheads_Uninstall_DeleteNavigationItem {

  /**
   * Used for running the uninstall sequence.
   *
   * @return bool
   *   TRUE when the uninstall sequence runs successfully.
   */
  public function apply() {
    $this->deleteManageLetterheadNavigationItem();

    return TRUE;
  }

  /**
   * Deletes the letterhead navigation item if it exists.
   */
  private function deleteManageLetterheadNavigationItem() {
    $letterheads = civicrm_api3('Navigation', 'get', [
      'sequential' => '1',
      'name' => 'Letterheads',
    ]);

    if (!empty($letterheads['count'])) {
      $navigationItemRecord = CRM_Utils_Array::first($letterheads['values']);

      civicrm_api3('Navigation', 'delete', [
        'id' => $navigationItemRecord['id'],
      ]);
    }
  }

}
