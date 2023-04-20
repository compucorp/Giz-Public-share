<?php

class CRM_Invoicehelper_Contribute_Form_Task_PrintOrEmail {

  /**
   * @see invoicehelper_civicrm_buildForm().
   */
  public static function buildForm($form) {
    $form->add('select', 'template', ts('Template'), ['t' => 'test'], NULL, ['class' => 'crm-select2']);

    $templates = CRM_Core_BAO_MessageTemplate::getMessageTemplates(FALSE);
    
    if (!empty($templates)) {
      $form->assign('templates', TRUE);
      $form->add('select', "template", ts('Use Template'),
        ['' => ts('- select -')] + $templates, FALSE,
        ['onChange' => "selectValue( this.value, '');"]
      );
    }
    
    $templatePath = CRM_Core_Resources::singleton()->getPath('invoicehelper', '/templates/CRM/Invoicehelper/Contribute/Form/Task/PrintOrEmail_MessageTemplate.tpl');

    CRM_Core_Region::instance('page-body', TRUE)->add(array(
      'template' => $templatePath
    ));
  }

  /**
   * Resolve tokens in email_comment.
   * 
   * @param array $params
   */
  public static function replaceTokens(&$param) {
    if (empty($param['tplParams']['email_comment'])) {
      return;
    }

    $param['html'] = $param['tplParams']['email_comment'];
    $param['contact_id'] = $param['contactId'];
    CRM_Invoicehelper_Contribute_Form_Task_Invoice::replaceTokens($param);
    $param['tplParams']['email_comment'] = $param['html'];
  }
}
