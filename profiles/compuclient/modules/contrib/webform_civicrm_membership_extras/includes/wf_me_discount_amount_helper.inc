<?php


/**
 * Class wf_me_discount_amount_helper
 *
 * This class helps with calculating actual discounted amount for
 * a membership type given a discount code. It encapsulates logic
 * for retrieving discount code details and calculating the price for
 * each membership depending on if the discount code is fixed or
 * percentage amount.
 */
class wf_me_discount_amount_helper {

  const WEBFORM_DISCOUNT_PERCENTAGE_AMOUNT = 1;
  const WEBFORM_DISCOUNT_FIXED_AMOUNT = 2;

  /**
   * @var array
   */
  private $formStorage;

  private $numberOfInstallments;

  /**
   * wf_me_discount_amount_helper constructor.
   *
   * @param array $formStorage
   */
  public function __construct($formStorage) {
    $this->formStorage = $formStorage;
  }

  /**
   * Returns the adjusted webform line Items after re-calculating the amount for
   * the membership based on the discount code. Returns NULL if there are no matching
   * membership types when comparing the user membership types and the membership types
   * linked to the discount code or if the discount code has no membership types linked.
   *
   * @param string $discountCode
   * @param array $lineItems
   * @param array $membershipTypesAdded
   *
   * @return array|NULL
   */
  public function getAdjustedLineItems($discountCode, $lineItems, $membershipTypesAdded) {
    $discountCodeDetails =$this->getDiscountDetails($discountCode);

    if (empty($discountCodeDetails['memberships'])) {
      return NULL;
    }

    $membershipNamesForDiscount = $this->getMembershipNamesForDiscount($discountCodeDetails['memberships']);
    if (!array_intersect(array_keys($membershipNamesForDiscount), $membershipTypesAdded)) {
      return NULL;
    }

    return $this->adjustLineItems($lineItems, $membershipNamesForDiscount, $discountCodeDetails);
  }

  /**
   * Gets the discount code details for a discount code.
   *
   * @param string $discountCode
   *
   * @return array
   */
  private function getDiscountDetails($discountCode) {
    $civiDiscountExtensionHelper = new wf_me_cividiscount_ext_helper();

    return $civiDiscountExtensionHelper->getDiscountCodeDetails($discountCode);
  }

  /**
   * Gets membership names for the membership Ids.
   *
   * @param array $membershipIds
   *
   * @return array|null
   */
  private function getMembershipNamesForDiscount($membershipIds) {
    $result = civicrm_api3('MembershipType', 'get', array(
      'sequential' => 1,
      'id' => ['IN' => $membershipIds]
    ));

    if ($result['count'] == 0) {
      return NULL;
    }

   return array_column($result['values'], 'name', 'id');
  }

  /**
   * Adjusts the line items for discount application to the amount.
   *
   * @param array $lineItems
   * @param array $membershipNamesForDiscount
   * @param array $discountCodeDetails
   *
   * @return array
   */
  private function adjustLineItems($lineItems, $membershipNamesForDiscount, $discountCodeDetails) {
    $lineItemsToDiscountCount = $this->getLineItemsToDiscountCount($lineItems, $membershipNamesForDiscount);
    $totalAmount = 0;
    foreach ($lineItems as $key => $lineItem) {
      $membershipID = $this->getLineItemMembershipIdForDiscount($membershipNamesForDiscount, $lineItem['label']);
      if ($membershipID) {
        $discountedAmount = 0;
        if ($discountCodeDetails['amount_type'] == self::WEBFORM_DISCOUNT_FIXED_AMOUNT) {
          $discountedAmount = $this->getFixedDiscountedAmount($lineItem['line_total'], $discountCodeDetails['amount'], $lineItemsToDiscountCount);
          $amountDiscounted = $discountCodeDetails['amount'] / $lineItemsToDiscountCount;
        }
        elseif ($discountCodeDetails['amount_type'] == self::WEBFORM_DISCOUNT_PERCENTAGE_AMOUNT) {
          $discountedAmount = $this->getPercentageDiscountedAmount($lineItem['line_total'], $discountCodeDetails['amount']);
          $amountDiscounted = $lineItem['line_total'] - $discountedAmount;
        }

        $totalAmount += $discountedAmount;
        $lineItems[$key]['unit_price'] = number_format((float) $discountedAmount, 2, '.', '');
        $lineItems[$key]['line_total'] = $discountedAmount;
        $lineItems[$key]['discount_applied'] = 1;
        $lineItems[$key]['discounted_amount'] = number_format((float) $amountDiscounted, 2, '.', '');
        $lineItems[$key]['membership_type_id'] = $membershipID;
        $lineItems[$key]['original_amount'] = $lineItem['line_total'];
        $lineItems[$key]['discount_code_amount'] = $discountCodeDetails['amount'];
      }
    }

    return ['line_items' => $lineItems, 'total_amount' => $totalAmount];
  }

  private function getLineItemsToDiscountCount($lineItems, $membershipNamesForDiscount) {
    $lineItemsToDiscountCount = 0;
    foreach ($lineItems as $key => $lineItem) {
      $membershipID = $this->getLineItemMembershipIdForDiscount($membershipNamesForDiscount, $lineItem['label']);
      if ($membershipID) {
        $lineItemsToDiscountCount++;
      }
    }

    return $lineItemsToDiscountCount;
  }

  /**
   * Returns the amount for line total after discount has been deducted for fixed discount.
   *
   * @param mixed $lineItemTotal
   * @param mixed $discountCodeAmount
   * @param mixed $lineItemsToDiscountCount
   * @return float|int
   */
  private function getFixedDiscountedAmount($lineItemTotal, $discountCodeAmount, $lineItemsToDiscountCount = 1) {
    $discountAmountPerLineItem = $discountCodeAmount/$lineItemsToDiscountCount;
    $fixedDiscountedAmount = $lineItemTotal - $discountAmountPerLineItem;

    return $fixedDiscountedAmount > 0 ? $fixedDiscountedAmount : 0;
  }

  /**
   * Returns the amount for line total after discount has been deducted for percentage discount.
   *
   * @param mixed $lineItemTotal
   * @param mixed $discountCodeAmount
   *
   * @return float|int
   */
  private function getPercentageDiscountedAmount($lineItemTotal, $discountCodeAmount) {
    $percentageDiscountedAmount = ($discountCodeAmount / 100) * $lineItemTotal;

    return ($lineItemTotal - $percentageDiscountedAmount) > 0 ? ($lineItemTotal - $percentageDiscountedAmount) : 0;
  }

  /**
   * Checks whether the current line item is of a membership type that belongs to
   * the membership list eligible for discount using the discount code and returns
   * the id of the matching membership type
   *
   * @param array $membershipNamesForDiscount
   * @param string $lineItemLabel
   *
   * @return bool
   */
  private function getLineItemMembershipIdForDiscount($membershipNamesForDiscount, $lineItemLabel) {
    // Webform civicrm module uses the (membership type name + ": " + contact name) formula as a label
    // for any membership line item, so we split here the part before the ": " to get the membership type name
    $membershipNameFromLineItemLabel = substr($lineItemLabel, 0, strpos($lineItemLabel, ': '));

    foreach ($membershipNamesForDiscount as $id => $name) {
      if (strpos($name, $membershipNameFromLineItemLabel) !== FALSE) {
        return $id;
      }
    }

    return FALSE;
  }

}
