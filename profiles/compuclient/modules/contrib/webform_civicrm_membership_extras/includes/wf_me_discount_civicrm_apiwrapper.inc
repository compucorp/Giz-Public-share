<?php

class wf_me_discount_civicrm_apiwrapper implements API_Wrapper {
  /**
   * {@inheritdoc}
   */
  public function fromApiInput($apiRequest) {
    return $apiRequest;
  }

  /**
   * This method basically modifies the response for the get method of the
   * membership_type.get API to allow the minimum fee to be set correctly for
   * discounted memberships based on data stored in session.
   *
   * @param array $apiRequest
   * @param array $result
   *
   * @return array
   */
  public function toApiOutput($apiRequest, $result) {
    if ($apiRequest['entity'] == 'MembershipType' && $apiRequest['action'] == 'get') {
      // is 'webform_discount_submit' context is present, alter api results to have discounted prices
      if (isset($_SESSION['webform_discount_submit'])) {
        $membership_types = $_SESSION['webform_discount_submit']['membership_types'];
        foreach ($membership_types as $membership_type_id => $price) {
          $result['values'][$membership_type_id]['minimum_fee'] = $price;
        }
      }
      // unset context so from next call discount wont be set in results
      unset($_SESSION['webform_discount_submit']);
    }

    return $result;
  }
}
