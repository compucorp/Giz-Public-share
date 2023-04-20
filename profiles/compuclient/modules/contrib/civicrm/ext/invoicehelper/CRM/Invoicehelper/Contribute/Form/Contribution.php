<?php

use CRM_Invoicehelper_ExtensionUtil as E;

class CRM_Invoicehelper_Contribute_Form_Contribution {

  /**
   * @see invoicehelper_civicrm_buildForm().
   */
  public static function buildForm(&$form) {
    if (Civi::settings()->get('invoicehelper_alwayssend_contribution_offline_receipt')) {
      $form->setDefaults([
        'is_email_receipt' => 1,
      ]);
    }
  }

}
