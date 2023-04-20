<?php

/**
 * This class is responsible for for interacting with the Civicrm CiviDiscount
 * Extension and its API's
 */
class wf_me_cividiscount_ext_helper {

  /**
   * wf_me_cividiscount_ext_helper constructor.
   */
  public function __construct() {
    civicrm_initialize();
  }

  /**
   * Checks whether CiviDiscount extension is enabled or not.
   *
   * @return bool
   */
  public function isEnabled() {
    $isEnabled = CRM_Core_DAO::getFieldValue(
      'CRM_Core_DAO_Extension',
      'org.civicrm.module.cividiscount',
      'is_active',
      'full_name'
    );

    return !empty($isEnabled) ? TRUE : FALSE;
  }

  /**
   * Gets the details for the discount code using CiviDiscount API
   *
   * @param string $discountCode
   *
   * @return array
   */
  public function getDiscountCodeDetails($discountCode) {
    $result = civicrm_api3('DiscountCode', 'get', [
      'code' => $discountCode,
      'sequential' => 1
    ]);

    if ($result['count'] == 1) {
      return $result['values'][0];
    }
  }

  /**
   * Updates the discount code tracking details in cividiscount.
   *
   * @param int $contactId
   * @param int $entityID
   * @param int $contributionID
   * @param int $discountCodeId
   */
  public function updateDiscountTrackingDetails($contactId, $entityID, $contributionID, $discountCodeId) {
    civicrm_api3('DiscountTrack', 'create', [
      'entity_table' => 'civicrm_membership',
      'entity_id' => $entityID,
      'contribution_id' => $contributionID,
      'contact_id' => $contactId,
      'item_id' => $discountCodeId,
      'used_date' => date('Y-m-d H:i:s')
    ]);
  }

  /**
   * Updates the discount code usage count.
   *
   * @param int $discountCodeId
   */
  public function updateDiscountCodeUsage($discountCodeId) {
    $result = civicrm_api3('DiscountCode', 'get', [
      'id' => $discountCodeId,
    ]);

    if ($result['values'][0]) {
      civicrm_api3('DiscountCode', 'create', [
        'id' => $result['values'][0]['id'],
        'count_use' => $result['values'][0]['count_use'] + 1
      ]);
    }
  }
}
