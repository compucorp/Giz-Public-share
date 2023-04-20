<?php
use CRM_Invoicehelper_ExtensionUtil as E;

class CRM_Invoicehelper_Contribute_Form_Task_Invoice extends CRM_Contribute_Form_Task_Invoice {

  /**
   * Build the form object.
   */
  public function buildQuickForm() {
    parent::buildQuickForm();

    $this->add('text', 'emailto', ts('To'), ['class' => 'huge'], TRUE);
    $this->add('text', 'emailcc', ts('CC'), ['class' => 'huge'], FALSE);
    $this->add('select', 'template', ts('Template'), ['t' => 'test'], NULL, ['class' => 'crm-select2']);

    // For the "Use Template" widget to work, the message field must be named html_message
    $this->add('wysiwyg', 'html_message', ts('Message'));
    $this->removeElement('email_comment');

    // Remove the default cc field.
    $this->removeElement('cc_id');

    // This handles message template magic
    CRM_Mailing_BAO_Mailing::commonCompose($this);

    $cid = CRM_Utils_Request::retrieveValue('cid', 'Positive');

    if ($cid) {
      $contact = civicrm_api3('Contact', 'getsingle', [
        'id' => $cid,
        'return' => ['id', 'email', 'display_name'],
      ]);

      Civi::resources()->addSetting([
        'invoicehelper' => [
          'toContact' => [
            'text' => $contact['display_name'] . ' <' . $contact['email'] . '>',
            'id' => $contact['id'] . '::' . $contact['email'],
          ],
        ],
      ]);
    }
  }

  /**
   * Override the parent function for no reason, but otherwise our printPDF override
   * will not get called.
   *
   * Process the form after the input has been submitted and validated.
   */
  public function postProcess() {
    $params = $this->controller->exportValues($this->_name);
    self::printPDF($this->_contributionIds, $params, $this->_contactIds);
  }

  /**
   * XXX: This overrides a big chunk of code from the parent class.
   * I tried do the minimum of changes to make it easier to diff later on.
   *
   * Process the PDf and email with activity and attachment on click of Print Invoices.
   *
   * @param array $contribIDs
   *   Contribution Id.
   * @param array $params
   *   Associated array of submitted values.
   * @param array $contactIds
   *   Contact Id.
   */
  public static function printPDF($contribIDs, &$params, $contactIds) {
    // get all the details needed to generate a invoice
    $messageInvoice = array();
    $invoiceTemplate = CRM_Core_Smarty::singleton();
    $invoiceElements = CRM_Contribute_Form_Task_PDF::getElements($contribIDs, $params, $contactIds);

    // gives the status id when contribution status is 'Refunded'
    $contributionStatusID = CRM_Contribute_PseudoConstant::contributionStatus(NULL, 'name');
    $refundedStatusId = CRM_Utils_Array::key('Refunded', $contributionStatusID);
    $cancelledStatusId = CRM_Utils_Array::key('Cancelled', $contributionStatusID);
    $pendingStatusId = CRM_Utils_Array::key('Pending', $contributionStatusID);

    // getting data from admin page
    $prefixValue = Civi::settings()->get('contribution_invoice_settings');

    foreach ($invoiceElements['details'] as $contribID => $detail) {
      $input = $ids = $objects = array();
      if (in_array($detail['contact'], $invoiceElements['excludeContactIds'])) {
        continue;
      }

      $input['component'] = $detail['component'];

      $ids['contact'] = $detail['contact'];
      $ids['contribution'] = $contribID;
      $ids['contributionRecur'] = NULL;
      $ids['contributionPage'] = NULL;
      $ids['membership'] = CRM_Utils_Array::value('membership', $detail);
      $ids['participant'] = CRM_Utils_Array::value('participant', $detail);
      $ids['event'] = CRM_Utils_Array::value('event', $detail);

      if (!$invoiceElements['baseIPN']->validateData($input, $ids, $objects, FALSE)) {
        CRM_Core_Error::fatal();
      }

      $contribution = &$objects['contribution'];

      $input['amount'] = $contribution->total_amount;
      $input['invoice_id'] = $contribution->invoice_id;
      $input['receive_date'] = $contribution->receive_date;
      $input['contribution_status_id'] = $contribution->contribution_status_id;
      $input['organization_name'] = $contribution->_relatedObjects['contact']->organization_name;

      $objects['contribution']->receive_date = CRM_Utils_Date::isoToMysql($objects['contribution']->receive_date);

      $addressParams = array('contact_id' => $contribution->contact_id);
      $addressDetails = CRM_Core_BAO_Address::getValues($addressParams);

      // to get billing address if present
      $billingAddress = array();
      foreach ($addressDetails as $address) {
        if (($address['is_billing'] == 1) && ($address['is_primary'] == 1) && ($address['contact_id'] == $contribution->contact_id)) {
          $billingAddress[$address['contact_id']] = $address;
          break;
        }
        elseif (($address['is_billing'] == 0 && $address['is_primary'] == 1) || ($address['is_billing'] == 1) && ($address['contact_id'] == $contribution->contact_id)) {
          $billingAddress[$address['contact_id']] = $address;
        }
      }

      if (!empty($billingAddress[$contribution->contact_id]['state_province_id'])) {
        $stateProvinceAbbreviation = CRM_Core_PseudoConstant::stateProvinceAbbreviation($billingAddress[$contribution->contact_id]['state_province_id']);
      }
      else {
        $stateProvinceAbbreviation = '';
      }

      if ($contribution->contribution_status_id == $refundedStatusId || $contribution->contribution_status_id == $cancelledStatusId) {
        if (is_null($contribution->creditnote_id)) {
          $creditNoteId = CRM_Contribute_BAO_Contribution::createCreditNoteId();
          CRM_Core_DAO::setFieldValue('CRM_Contribute_DAO_Contribution', $contribution->id, 'creditnote_id', $creditNoteId);
        }
        else {
          $creditNoteId = $contribution->creditnote_id;
        }
      }
      if (!$contribution->invoice_number) {
        $contribution->invoice_number = CRM_Contribute_BAO_Contribution::getInvoiceNumber($contribution->id);
      }

      //to obtain due date for PDF invoice
      $contributionReceiveDate = date('F j,Y', strtotime(date($input['receive_date'])));
      $invoiceDate = date("F j, Y");
      $dueDate = date('F j, Y', strtotime($contributionReceiveDate . "+" . $prefixValue['due_date'] . "" . $prefixValue['due_date_period']));

      if ($input['component'] == 'contribute') {
        $lineItem = CRM_Price_BAO_LineItem::getLineItemsByContributionID($contribID);
      }
      else {
        $eid = $contribution->_relatedObjects['participant']->id;
        $lineItem = CRM_Price_BAO_LineItem::getLineItems($eid, 'participant', NULL, TRUE, FALSE, TRUE);
      }

      $resultPayments = civicrm_api3('Payment', 'get', array(
            'sequential' => 1,
            'contribution_id' => $contribID,
      ));
      $amountPaid = 0;
      foreach ($resultPayments['values'] as $singlePayment) {
        // Only count payments that have been (status =) completed.
        if ($singlePayment['status_id'] == 1) {
          $amountPaid += $singlePayment['total_amount'];
        }
      }
      $amountDue = ($input['amount'] - $amountPaid);

      // retrieving the subtotal and sum of same tax_rate
      $dataArray = array();
      $subTotal = 0;
      foreach ($lineItem as $taxRate) {
        if (isset($dataArray[(string) $taxRate['tax_rate']])) {
          $dataArray[(string) $taxRate['tax_rate']] = $dataArray[(string) $taxRate['tax_rate']] + CRM_Utils_Array::value('tax_amount', $taxRate);
        }
        else {
          $dataArray[(string) $taxRate['tax_rate']] = CRM_Utils_Array::value('tax_amount', $taxRate);
        }
        $subTotal += CRM_Utils_Array::value('subTotal', $taxRate);
      }

      // to email the invoice
      $mailDetails = array();
      $values = array();
      if ($contribution->_component == 'event') {
        $daoName = 'CRM_Event_DAO_Event';
        $pageId = $contribution->_relatedObjects['event']->id;
        $mailElements = array(
          'title',
          'confirm_from_name',
          'confirm_from_email',
          'cc_confirm',
          'bcc_confirm',
        );
        CRM_Core_DAO::commonRetrieveAll($daoName, 'id', $pageId, $mailDetails, $mailElements);
        $values['title'] = CRM_Utils_Array::value('title', $mailDetails[$contribution->_relatedObjects['event']->id]);
        $values['confirm_from_name'] = CRM_Utils_Array::value('confirm_from_name', $mailDetails[$contribution->_relatedObjects['event']->id]);
        $values['confirm_from_email'] = CRM_Utils_Array::value('confirm_from_email', $mailDetails[$contribution->_relatedObjects['event']->id]);
        $values['cc_confirm'] = CRM_Utils_Array::value('cc_confirm', $mailDetails[$contribution->_relatedObjects['event']->id]);
        $values['bcc_confirm'] = CRM_Utils_Array::value('bcc_confirm', $mailDetails[$contribution->_relatedObjects['event']->id]);

        $title = CRM_Utils_Array::value('title', $mailDetails[$contribution->_relatedObjects['event']->id]);
      }
      elseif ($contribution->_component == 'contribute') {
        $daoName = 'CRM_Contribute_DAO_ContributionPage';
        $pageId = $contribution->contribution_page_id;
        $mailElements = array(
          'title',
          'receipt_from_name',
          'receipt_from_email',
          'cc_receipt',
          'bcc_receipt',
        );
        CRM_Core_DAO::commonRetrieveAll($daoName, 'id', $pageId, $mailDetails, $mailElements);

        $values['title'] = CRM_Utils_Array::value('title', CRM_Utils_Array::value($contribution->contribution_page_id, $mailDetails));
        $values['receipt_from_name'] = CRM_Utils_Array::value('receipt_from_name', CRM_Utils_Array::value($contribution->contribution_page_id, $mailDetails));
        $values['receipt_from_email'] = CRM_Utils_Array::value('receipt_from_email', CRM_Utils_Array::value($contribution->contribution_page_id, $mailDetails));
        $values['cc_receipt'] = CRM_Utils_Array::value('cc_receipt', CRM_Utils_Array::value($contribution->contribution_page_id, $mailDetails));
        $values['bcc_receipt'] = CRM_Utils_Array::value('bcc_receipt', CRM_Utils_Array::value($contribution->contribution_page_id, $mailDetails));

        $title = CRM_Utils_Array::value('title', CRM_Utils_Array::value($contribution->contribution_page_id, $mailDetails));
      }
      $source = $contribution->source;

      $config = CRM_Core_Config::singleton();
      if (!isset($params['forPage'])) {
        $config->doNotAttachPDFReceipt = 1;
      }

      // get organization address
      $domain = CRM_Core_BAO_Domain::getDomain();
      $locParams = array('contact_id' => $domain->contact_id);
      $locationDefaults = CRM_Core_BAO_Location::getValues($locParams);
      if (isset($locationDefaults['address'][1]['state_province_id'])) {
        $stateProvinceAbbreviationDomain = CRM_Core_PseudoConstant::stateProvinceAbbreviation($locationDefaults['address'][1]['state_province_id']);
      }
      else {
        $stateProvinceAbbreviationDomain = '';
      }
      if (isset($locationDefaults['address'][1]['country_id'])) {
        $countryDomain = CRM_Core_PseudoConstant::country($locationDefaults['address'][1]['country_id']);
      }
      else {
        $countryDomain = '';
      }

      // parameters to be assign for template
      $tplParams = array(
        'title' => $title,
        'component' => $input['component'],
        'id' => $contribution->id,
        'source' => $source,
        'invoice_number' => $contribution->invoice_number,
        'invoice_id' => $contribution->invoice_id,
        'resourceBase' => $config->userFrameworkResourceURL,
        'defaultCurrency' => $config->defaultCurrency,
        'amount' => $contribution->total_amount,
        'amountDue' => $amountDue,
        'amountPaid' => $amountPaid,
        'invoice_date' => $invoiceDate,
        'dueDate' => $dueDate,
        'notes' => CRM_Utils_Array::value('notes', $prefixValue),
        'display_name' => $contribution->_relatedObjects['contact']->display_name,
        'lineItem' => $lineItem,
        'dataArray' => $dataArray,
        'refundedStatusId' => $refundedStatusId,
        'pendingStatusId' => $pendingStatusId,
        'cancelledStatusId' => $cancelledStatusId,
        'contribution_status_id' => $contribution->contribution_status_id,
        'contributionStatusName' => CRM_Core_PseudoConstant::getName('CRM_Contribute_BAO_Contribution', 'contribution_status_id', $contribution->contribution_status_id),
        'subTotal' => $subTotal,
        'street_address' => CRM_Utils_Array::value('street_address', CRM_Utils_Array::value($contribution->contact_id, $billingAddress)),
        'supplemental_address_1' => CRM_Utils_Array::value('supplemental_address_1', CRM_Utils_Array::value($contribution->contact_id, $billingAddress)),
        'supplemental_address_2' => CRM_Utils_Array::value('supplemental_address_2', CRM_Utils_Array::value($contribution->contact_id, $billingAddress)),
        'supplemental_address_3' => CRM_Utils_Array::value('supplemental_address_3', CRM_Utils_Array::value($contribution->contact_id, $billingAddress)),
        'city' => CRM_Utils_Array::value('city', CRM_Utils_Array::value($contribution->contact_id, $billingAddress)),
        'stateProvinceAbbreviation' => $stateProvinceAbbreviation,
        'postal_code' => CRM_Utils_Array::value('postal_code', CRM_Utils_Array::value($contribution->contact_id, $billingAddress)),
        'is_pay_later' => $contribution->is_pay_later,
        'organization_name' => $contribution->_relatedObjects['contact']->organization_name,
        'domain_organization' => $domain->name,
        'domain_street_address' => CRM_Utils_Array::value('street_address', CRM_Utils_Array::value('1', $locationDefaults['address'])),
        'domain_supplemental_address_1' => CRM_Utils_Array::value('supplemental_address_1', CRM_Utils_Array::value('1', $locationDefaults['address'])),
        'domain_supplemental_address_2' => CRM_Utils_Array::value('supplemental_address_2', CRM_Utils_Array::value('1', $locationDefaults['address'])),
        'domain_supplemental_address_3' => CRM_Utils_Array::value('supplemental_address_3', CRM_Utils_Array::value('1', $locationDefaults['address'])),
        'domain_city' => CRM_Utils_Array::value('city', CRM_Utils_Array::value('1', $locationDefaults['address'])),
        'domain_postal_code' => CRM_Utils_Array::value('postal_code', CRM_Utils_Array::value('1', $locationDefaults['address'])),
        'domain_state' => $stateProvinceAbbreviationDomain,
        'domain_country' => $countryDomain,
        'domain_email' => CRM_Utils_Array::value('email', CRM_Utils_Array::value('1', $locationDefaults['email'])),
        'domain_phone' => CRM_Utils_Array::value('phone', CRM_Utils_Array::value('1', $locationDefaults['phone'])),
      );

      if (isset($creditNoteId)) {
        $tplParams['creditnote_id'] = $creditNoteId;
      }

      $pdfFileName = $contribution->invoice_number . ".pdf";
      $sendTemplateParams = array(
        'groupName' => 'msg_tpl_workflow_contribution',
        'valueName' => 'contribution_invoice_receipt',
        'contactId' => $contribution->contact_id,
        'tplParams' => $tplParams,
        'PDFFilename' => $pdfFileName,
      );

      // from email address
      $fromEmailAddress = html_entity_decode(CRM_Utils_Array::value('from_email_address', $params));

      // condition to check for download PDF Invoice or email Invoice
      if ($invoiceElements['createPdf']) {
        list($sent, $subject, $message, $html) = CRM_Core_BAO_MessageTemplate::sendTemplate($sendTemplateParams);
        if (isset($params['forPage'])) {
          return $html;
        }
        else {
          $mail = array(
            'subject' => $subject,
            'body' => $message,
            'html' => $html,
          );
          if ($mail['html']) {
            $messageInvoice[] = $mail['html'];
          }
          else {
            $messageInvoice[] = nl2br($mail['body']);
          }
        }
      }
      elseif ($contribution->_component == 'contribute') {
        $email = CRM_Contact_BAO_Contact::getPrimaryEmail($contribution->contact_id);

        $sendTemplateParams['tplParams'] = array_merge($tplParams, array('email_comment' => $invoiceElements['params']['email_comment']));
        $sendTemplateParams['from'] = $fromEmailAddress;
        $sendTemplateParams['toEmail'] = $email;
        $sendTemplateParams['cc'] = CRM_Utils_Array::value('cc_receipt', $values);
        $sendTemplateParams['bcc'] = CRM_Utils_Array::value('bcc_receipt', $values);

        // [ML] SYMBIOTIC Override some values from the fields we added to the form
        self::overrideEmailParameters($params, $sendTemplateParams);
        self::sendInvoiceEmail($sendTemplateParams);

        // [ML] Do not use this, because it does not let us change the subject
        // list($sent, $subject, $message, $html) = CRM_Core_BAO_MessageTemplate::sendTemplate($sendTemplateParams);
      }
      elseif ($contribution->_component == 'event') {
        $email = CRM_Contact_BAO_Contact::getPrimaryEmail($contribution->contact_id);

        $sendTemplateParams['tplParams'] = array_merge($tplParams, array('email_comment' => $invoiceElements['params']['email_comment']));
        $sendTemplateParams['from'] = $fromEmailAddress;
        $sendTemplateParams['toEmail'] = $email;
        $sendTemplateParams['cc'] = CRM_Utils_Array::value('cc_confirm', $values);
        $sendTemplateParams['bcc'] = CRM_Utils_Array::value('bcc_confirm', $values);

        // [ML] SYMBIOTIC Override some values from the fields we added to the form
        self::overrideEmailParameters($params, $sendTemplateParams);
        self::sendInvoiceEmail($sendTemplateParams);

        // [ML] Do not use this, because it does not let us change the subject
        // list($sent, $subject, $message, $html) = CRM_Core_BAO_MessageTemplate::sendTemplate($sendTemplateParams);
      }
      $invoiceTemplate->clearTemplateVars();
    }

    if ($invoiceElements['createPdf']) {
      if (isset($params['forPage'])) {
        return $html;
      }
      else {
        CRM_Utils_PDF_Utils::html2pdf($messageInvoice, $pdfFileName, FALSE, array(
          'margin_top' => 10,
          'margin_left' => 65,
          'metric' => 'px',
        ));
        // functions call for adding activity with attachment
        $fileName = self::putFile($html, $pdfFileName);
        self::addActivities($subject, $contactIds, $fileName, $params);
        unlink($fileName);

        CRM_Utils_System::civiExit();
      }
    }
    else {
      if ($invoiceElements['suppressedEmails']) {
        $status = ts('Email was NOT sent to %1 contacts (no email address on file, or communication preferences specify DO NOT EMAIL, or contact is deceased).', array(1 => $invoiceElements['suppressedEmails']));
        $msgTitle = ts('Email Error');
        $msgType = 'error';
      }
      else {
        $status = ts('Your mail has been sent.');
        $msgTitle = ts('Sent');
        $msgType = 'success';
      }
      CRM_Core_Session::setStatus($status, $msgTitle, $msgType);
    }


    // Redirect back to the contact record
    // (by default it redirects to a full-page "view contribution", which is weird since we were in a popup)
    // FIXME: will this be annoying if used from Find Contributions?
    if (count($contactIds) == 1) {
      $cid = array_pop($contactIds);
      $url = CRM_Utils_System::url('civicrm/contact/view', ['reset' => 1, 'cid' => $cid, 'action' => 'browse', 'selectedChild' => 'activity']);
      CRM_Utils_System::redirect($url);
    }
  }

  /**
   *
   */
  static private function overrideEmailParameters($params, &$sendTemplateParams) {
    $email_overrides = [
      'emailto' => 'toEmail',
      'emailcc' => 'cc',
    ];

    // This gets used for token replacements
    $first_contact_id = null;

    foreach ($email_overrides as $key => $val) {
      if ($t = CRM_Utils_Array::value($key, $params)) {
        $all_emails = explode(',', $t);
        $fixed = [];

        foreach ($all_emails as $tt) {
          list($contact_id, $email) = explode('::', $tt);

          if (!$first_contact_id) {
            $first_contact_id = $contact_id;
          }

          $display_name = civicrm_api3('Contact', 'getsingle', [
            'id' => $contact_id,
            'return' => 'display_name',
          ])['display_name'];

          $fixed[] = "$display_name <$email>";
        }

        $sendTemplateParams[$val] = implode(',', $fixed);
      }
    }

    // Insert the message into the 'email_comment' field
    $sendTemplateParams['html'] = $params['html_message'];
    $sendTemplateParams['subject'] = $params['subject'];
    $sendTemplateParams['contactId'] = $first_contact_id; // [ML] probably not used
    $sendTemplateParams['contact_id'] = $first_contact_id;

    // FIXME: will this work for event invoices? (c.f. $sendTemplateParams['tplParams']['id'] is the component/contribution ID)
    $pdfHtml = CRM_Contribute_BAO_ContributionPage::addInvoicePdfToEmail($sendTemplateParams['tplParams']['id'], $sendTemplateParams['contactId']);

    if (empty($sendTemplateParams['attachments'])) {
      $sendTemplateParams['attachments'] = [];
    }

    $pdfFileName = $sendTemplateParams['tplParams']['invoice_number'] . '.pdf';
    $sendTemplateParams['attachments'][] = CRM_Utils_Mail::appendPDF($pdfFileName, $pdfHtml, $mailContent['format']);
  }

  /**
   *
   */
  static public function replaceTokens(&$params) {
    // Assuming we need token info only for the main 'to' contact
    // This gets set by self::overrideEmailParameters()
    $contactIds = [$params['contact_id']];
    $contributionIds = [];

    $subject = $params['subject'];
    $text = ''; // we don't care about this
    $html = $params['html'];

    if ($params['tplParams']['component'] == 'contribute') {
      $contributionIds[] = $params['tplParams']['id'];
    }
    elseif ($params['tplParams']['component'] == 'event' && !empty($params['tplParams']['invoice_number'])) {
      // [ML] Added this so that we can use contribution tokens for participant invoices
      // Ex: {contribution.invoice_number} or {contribution.receive_date}
      $contribution_id = CRM_Core_DAO::singleValueQuery('SELECT id FROM civicrm_contribution WHERE invoice_number = %1', [
        1 => [$params['tplParams']['invoice_number'], 'String'],
      ]);

      if ($contribution_id) {
        $contributionIds[] = $contribution_id;
      }
    }

    $contactDetails = [];
    $contactDetails[] = civicrm_api3('Contact', 'getsingle', [
      'id' => $params['contact_id'],
    ]);

    // This is based on CRM_Activity_BAO_Activity::sendEmail()
    // Maybe we should call that function, but it does a lot of other things.
    $subjectToken = CRM_Utils_Token::getTokens($params['subject']);
    $messageToken = CRM_Utils_Token::getTokens($params['html']);
    $allTokens = array_merge($messageToken, $subjectToken);

    $returnProperties = [];

    if (isset($messageToken['contact'])) {
      foreach ($messageToken['contact'] as $key => $value) {
        $returnProperties[$value] = 1;
      }
    }

    if (isset($subjectToken['contact'])) {
      foreach ($subjectToken['contact'] as $key => $value) {
        if (!isset($returnProperties[$value])) {
          $returnProperties[$value] = 1;
        }
      }
    }

    // get token details for contacts, call only if tokens are used
    $details = [];

    if (!empty($returnProperties) || !empty($tokens) || !empty($allTokens)) {
      list($details) = CRM_Utils_Token::getTokenDetails(
        $contactIds,
        $returnProperties,
        NULL, NULL, FALSE,
        $allTokens,
        'CRM_Activity_BAO_Activity'
      );
    }

    // call token hook
    $tokens = [];
    CRM_Utils_Hook::tokens($tokens);
    $categories = array_keys($tokens);

    $escapeSmarty = FALSE;
    if (defined('CIVICRM_MAIL_SMARTY') && CIVICRM_MAIL_SMARTY) {
      $smarty = CRM_Core_Smarty::singleton();
      $escapeSmarty = TRUE;
    }

    $contributionDetails = [];
    if (!empty($contributionIds)) {
      $contributionDetails = CRM_Contribute_BAO_Contribution::replaceContributionTokens(
        $contributionIds,
        $subject,
        $subjectToken,
        $text,
        $html,
        $messageToken,
        $escapeSmarty
      );
    }

    foreach ($contactDetails as $values) {
      $contactId = $values['contact_id'];
      $emailAddress = $values['email'];

      if (!empty($contributionDetails)) {
        $subject = $contributionDetails[$contactId]['subject'];
        $text = $contributionDetails[$contactId]['text'];
        $html = $contributionDetails[$contactId]['html'];
      }

      if (!empty($details) && is_array($details["{$contactId}"])) {
        // unset email from details since it always returns primary email address
        unset($details["{$contactId}"]['email']);
        unset($details["{$contactId}"]['email_id']);
        $values = array_merge($values, $details["{$contactId}"]);
      }

      $tokenSubject = CRM_Utils_Token::replaceContactTokens($subject, $values, FALSE, $subjectToken, FALSE, $escapeSmarty);
      $tokenSubject = CRM_Utils_Token::replaceHookTokens($tokenSubject, $values, $categories, FALSE, $escapeSmarty);

      $tokenHtml = CRM_Utils_Token::replaceContactTokens($html, $values, TRUE, $messageToken, FALSE, $escapeSmarty);
      $tokenHtml = CRM_Utils_Token::replaceHookTokens($tokenHtml, $values, $categories, TRUE, $escapeSmarty);

      if (defined('CIVICRM_MAIL_SMARTY') && CIVICRM_MAIL_SMARTY) {
        // also add the contact tokens to the template
        $smarty->assign_by_ref('contact', $values);

        $tokenSubject = $smarty->fetch("string:$tokenSubject");
        $tokenText = $smarty->fetch("string:$tokenText");
        $tokenHtml = $smarty->fetch("string:$tokenHtml");
      }
    }

    // [ML] Set things back for the parent
    $params['subject'] = $tokenSubject;
    $params['html'] = $tokenHtml;
  }

  /**
   *
   */
  static public function sendInvoiceEmail($params) {
    self::replaceTokens($params);
    $sent = CRM_Utils_Mail::send($params);

    // Create an activity
    $contact_id = $params['contact_id'];
    $subject = $params['subject'];
    $params['details'] = $params['html'];

    // There should always be an attachment
    if (!empty($params['attachments'][0]['fullPath'])) {
      $fileName = $params['attachments'][0]['fullPath'];
      self::addActivities($subject, $contact_id, $fileName, $params);
      unlink($fileName);
    }

    return $sent;
  }

  /**
   * Add activity for Email Invoice and the PDF Invoice.
   *
   * [ML] This overrides the parent function in order to save the 'details',
   * i.e. the body of the message sent. We should send a patch upstream.
   *
   * @param string $subject
   *   Activity subject.
   * @param array $contactIds
   *   Contact Id.
   * @param string $fileName
   *   Gives the location with name of the file.
   * @param array $params
   *   For invoices.
   *
   */
  static public function addActivities($subject, $contactIds, $fileName, $params) {
    $session = CRM_Core_Session::singleton();
    $userID = $session->get('userID');
    $config = CRM_Core_Config::singleton();
    $config->doNotAttachPDFReceipt = 1;

    if (!empty($params['output']) && $params['output'] == 'pdf_invoice') {
      $activityTypeID = CRM_Core_PseudoConstant::getKey(
        'CRM_Activity_DAO_Activity',
        'activity_type_id',
        'Downloaded Invoice'
      );
    }
    else {
      $activityTypeID = CRM_Core_PseudoConstant::getKey(
        'CRM_Activity_DAO_Activity',
        'activity_type_id',
        'Emailed Invoice'
      );
    }

    $activityParams = array(
      'subject' => $subject,
      'source_contact_id' => $userID,
      'target_contact_id' => $contactIds,
      'activity_type_id' => $activityTypeID,
      'activity_date_time' => date('YmdHis'),
      'attachFile_1' => array(
        'uri' => $fileName,
        'type' => 'application/pdf',
        'location' => $fileName,
        'upload_date' => date('YmdHis'),
      ),
    );

    // [ML] This is the code added
    if (!empty($params['details'])) {
      $activityParams['details'] = $params['details'];
    }

    CRM_Activity_BAO_Activity::create($activityParams);
  }

}
