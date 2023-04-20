<?php

/**
 * This class is responsible for for adding/updating records in the
 * webform_discount_settings table. The webform_discount_details table is
 * used to track whether discount is enabled for a webform or not.
 */
class wf_me_discount_settings {

  /**
   * Saves a record in the webform_discount_details table.
   *
   * @param int $nid
   * @param int $discountStatus
   */
  public function save($nid, $discountStatus) {
    $query = db_select('webform_discount_settings')
      ->fields('webform_discount_settings', ['nid'])
      ->condition('nid', $nid);
    $numberOfRows = $query->countQuery()->execute()->fetchField();

    if ($numberOfRows == 1) {
      $this->update($nid, $discountStatus);
    }
    else {
      $this->create($nid, $discountStatus);
    }
  }

  /**
   * Gets the discount status for the webform node
   *
   * @param int $nid
   *
   * @return mixed
   */
  public function getDiscountStatus($nid) {
    $query = db_select('webform_discount_settings', 'wds')
      ->fields('wds', array('enabled'))
      ->condition('nid', $nid);
    $status = $query->execute()->fetchField();

    return empty($status) ? 0 : 1;
  }

  /**
   * Creates record in the webform_discount_details table.
   *
   * @param int $nid
   * @param int $discountStatus
   */
  private function create($nid, $discountStatus) {
    db_insert('webform_discount_settings')
      ->fields([
        'nid' => $nid,
        'enabled' => $discountStatus
      ])
      ->execute();
  }

  /**
   * Updates record in the webform_discount_details table.
   *
   * @param int $nid
   * @param int $discountStatus
   */
  private function update($nid, $discountStatus) {
    db_update('webform_discount_settings')
      ->fields(['enabled' => $discountStatus])
      ->condition('nid', $nid)
      ->execute();
  }
}
