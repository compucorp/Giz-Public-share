<?php

/**
 * Class to create sample contribution page for membership extras.
 */

class CRM_Membershipextrasdefaultconfig_Setup_CreateSampleContributionPageStep {

  const CONTRIBUTION_PAGE_TITLE = 'Compuclient default contribution page';

  /**
   * Main method that will apply all changes.
   * This is called inside public function install of
   * class CRM_Membershipextrasdefaultconfig_Upgrader
   */
  public function apply() {
    if($this->contributionPageExists()) {
      return;
    }

    civicrm_api3('ContributionPage', 'create', [
      'title' => self::CONTRIBUTION_PAGE_TITLE,
      'financial_type_id' => 1,
      'is_active' => 1,
      'currency' => 'GBP',
      'payment_processor' => $this->getActivePaymentProcessors(),
      'is_email_receipt' => 1,
      'receipt_from_name' => 'Compuclient example receipt',
      'receipt_from_email' => 'email@example.com',
      'is_allow_other_amount' => 1,
    ]);
  }

  /**
   * Return all active payment processor names.
   */
  private function getActivePaymentProcessors() {
    $paymentProcessorNames = [];

    $activePaymentProcessors = civicrm_api3('PaymentProcessor', 'get', [
      'sequential' => 1,
      'return' => ['name'],
      'is_test' => 1,
      'is_active' => 1,
    ]);

    if(!$activePaymentProcessors['is_error']) {
      foreach ($activePaymentProcessors['values'] as $paymentProcessor) {
        $paymentProcessorNames[] = $paymentProcessor['name'];
      }
    }

    return $paymentProcessorNames;
  }

  /**
   * Check if contribution page already exists.
   */
  private function contributionPageExists() {
    $contributionPageCount = civicrm_api3('ContributionPage', 'getcount', [
      'title' => self::CONTRIBUTION_PAGE_TITLE,
    ]);

    return $contributionPageCount;
  }

}
