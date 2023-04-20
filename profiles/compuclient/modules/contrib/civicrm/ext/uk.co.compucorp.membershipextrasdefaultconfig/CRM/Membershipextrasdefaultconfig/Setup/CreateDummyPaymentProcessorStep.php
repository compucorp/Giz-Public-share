<?php

/**
 * Class to create dummy payment processor for membership extras.
 */

class CRM_Membershipextrasdefaultconfig_Setup_CreateDummyPaymentProcessorStep {

  const PAYMENT_PROCESSOR_NAME = 'Test Payment Processor';

  public function apply() {
    if($this->paymentProcessorExists()) {
      return;
    }

    $this->createDummyPaymentProcessor(FALSE);
    $this->createDummyPaymentProcessor(TRUE);
  }

  /**
   * Create Dummy payment processor for membershipextras.
   */
  private function createDummyPaymentProcessor($isTest) {
    civicrm_api3('PaymentProcessor', 'create', [
      'payment_processor_type_id' => 'Dummy',
      'is_active' => 1,
      'is_test' => $isTest,
      'is_recur' => 1,
      'domain_id' => CIVICRM_DOMAIN_ID,
      'name' => self::PAYMENT_PROCESSOR_NAME,
      'description' => self::PAYMENT_PROCESSOR_NAME,
      'user_name' => 'username',
      'url_site' => 'https://dummy.com',
      'url_recur' => 'https://dummy.com',
      'accepted_credit_cards' => '{"Visa":"Visa","MasterCard":"MasterCard","Amex":"Amex","Discover":"Discover"}',
    ]);
  }

  /**
   * Check if payment processor already exists.
   */
  private function paymentProcessorExists() {
    $paymentProcessorCount =  civicrm_api3('PaymentProcessor', 'getcount', [
      'name' => self::PAYMENT_PROCESSOR_NAME,
    ]);

    return $paymentProcessorCount;
  }

}
