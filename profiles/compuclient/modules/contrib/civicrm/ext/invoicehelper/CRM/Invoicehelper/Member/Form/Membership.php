<?php

use CRM_Invoicehelper_ExtensionUtil as E;

class CRM_Invoicehelper_Member_Form_Membership {

  /**
   * @see invoicehelper_civicrm_buildForm().
   */
  public static function buildForm(&$form) {
    if (Civi::settings()->get('invoicehelper_alwayssend_membership_offline_receipt')) {
      $form->setDefaults([
        'send_receipt' => 1,
      ]);
    }
  }

}
