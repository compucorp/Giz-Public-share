<?php

use CRM_Invoicehelper_ExtensionUtil as E;

class CRM_Invoicehelper_Admin_Form_Setting extends CRM_Admin_Form_Generic {

  /**
   * Build the form object.
   */
  public function buildQuickForm() {
    parent::buildQuickForm();

    Civi::resources()->addStyleFile('invoicehelper', 'css/admin.css');
    $this->addFormRule(['CRM_Invoicehelper_Admin_Form_Setting', 'formRule'], $this);
  }

  /**
   * Validation.
   *
   * @param array $params
   *   (ref.) an assoc array of name/value pairs.
   * @param $files
   * @param $self
   *
   * @return bool|array
   *   mixed true or array of errors
   */
  public static function formRule($params, $files, $self) {
    $errors = [];

    // Validate email fields
    foreach ($params as $key => $val) {
      if (empty($val) || !preg_match('/^invoicehelper_(cc|bcc)_/', $key)) {
        continue;
      }

      $val = trim($val);
      $all = explode(',', $val);

      foreach ($all as $email) {
        $email = trim($email);

        if (!CRM_Utils_Rule::email($email)) {
          $errors[$key] = E::ts('Invalid email: %1', [1 => $email]);
          break;
        }
      }
    }

    return empty($errors) ? true : $errors;
  }

}
