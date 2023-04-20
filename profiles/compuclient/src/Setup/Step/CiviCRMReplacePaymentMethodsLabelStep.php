<?php

namespace Drupal\compuclient\Setup\Step;

class CiviCRMReplacePaymentMethodsLabelStep implements StepInterface {

  /**
   * Apply replacing payment method labels
   */
  public function apply() {
    $this->setPaymentMethodLabel();
  }

  /**
   * set Payment method
   */
  private function setPaymentMethodLabel() {
    civicrm_api3('OptionValue', 'get', [
      'return' => ['id'],
      'option_group_id' => 'payment_instrument',
      'name' => 'Check',
      'api.OptionValue.create' => ['id' => '$value.id', 'label' => 'Cheque'],
    ]);

    civicrm_api3('OptionValue', 'get', [
      'return' => ["id"],
      'option_group_id' => 'payment_instrument',
      'name' => 'EFT',
      'api.OptionValue.create' => ['id' => '$value.id', 'label' => 'Bank Transfer'],
    ]);
  }


}
