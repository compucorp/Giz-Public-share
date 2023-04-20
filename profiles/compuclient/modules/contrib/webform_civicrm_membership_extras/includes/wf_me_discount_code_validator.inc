<?php

class wf_me_discount_code_validator {

  /**
   * Validates a discount code created in Cividiscount.
   * Throws an exception if discount code is not valid.
   *
   * @param string $discountCode
   *
   * @throws \Exception
   */
  public function validate($discountCode) {
    $civiDiscountExtensionHelper = new wf_me_cividiscount_ext_helper();
    $discountCodeDetails = $civiDiscountExtensionHelper->getDiscountCodeDetails($discountCode);

    if (empty($discountCodeDetails)) {
      throw new Exception(t('The discount code you entered is invalid.'));
    }

    // Validate if discount code is active
    if (empty($discountCodeDetails['is_active'])) {
      throw new Exception(t('The discount code you entered is inactive.'));
    }

    // Validate discount code usage limit.
    if (!empty($discountCodeDetails['count_max']) && $discountCodeDetails['count_use'] >= $discountCodeDetails['count_max']) {
      throw new Exception(t('Discount code usage exceeded.'));
    }

    // Validate discount code activation date.
    if (!empty($discountCodeDetails['active_on'])) {
      $today = new DateTime();
      $activation_date = new DateTime($discountCodeDetails['active_on']);
      if ($today < $activation_date) {
        throw new Exception(t('Discount code not yet activated'));
      }
    }

    // Validate discount code expiry date.
    if (!empty($discountCodeDetails['expire_on'])) {
      $today = new DateTime();
      $expiry_date = new DateTime($discountCodeDetails['expire_on']);
      if ($today >= $expiry_date) {
        throw new Exception(t('Discount code expired.'));
      }
    }
  }
}
