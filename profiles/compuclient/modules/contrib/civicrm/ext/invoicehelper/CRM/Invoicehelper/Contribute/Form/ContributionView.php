<?php

use CRM_Invoicehelper_ExtensionUtil as E;

class CRM_Invoicehelper_Contribute_Form_ContributionView {

  /**
   * @see invoicehelper_civicrm_buildForm().
   */
  public static function buildForm(&$form) {
    self::addInvoicePaymentLink($form);
  }

  /**
   * Displays a link with checksum that can be sent to a contact with a pending payment.
   * Useful for copy-pasting in an email sent outside CiviCRM.
   */
  public static function addInvoicePaymentLink(&$form) {
    $contribution_id = $form->get('id');
    $contact_id = $form->get('cid');

    // Verify that contribution is pending
    $pending = civicrm_api3('Contribution', 'getvalue', [
      'return' => 'is_pay_later',
      'id' => $contribution_id,
    ]);

    $pendingStatusId = CRM_Core_PseudoConstant::getKey('CRM_Contribute_BAO_Contribution', 'contribution_status_id', 'Pending');

    $status = civicrm_api3('Contribution', 'getvalue', [
      'return' => 'contribution_status_id',
      'id' => $contribution_id,
    ]);

    if ($pending || $status == $pendingStatusId) {
      $cs = CRM_Contact_BAO_Contact_Utils::generateChecksum($contact_id);
      $contribution_form_id = Civi::settings()->get('default_invoice_page');

      // Link to contrib form
      $url_en = CRM_Utils_System::url(
        'civicrm/contribute/transact',
        'reset=1&id=' . $contribution_form_id . '&ccid=' . $contribution_id . '&cid=' . $contact_id . '&cs=' . $cs,
         TRUE,
         NULL,
         TRUE,
         TRUE,
         FALSE
       );

      $smarty = CRM_Core_Smarty::singleton();
      $smarty->assign('invoicehelper_url_en', $url_en);

      CRM_Core_Region::instance('page-body')->add([
        'template' => 'CRM/Invoicehelper/Contribute/Form/ContributionView_PaymentLink.tpl',
      ]);
    }
  }

}
