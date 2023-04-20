<?php

/**
 * Class CRM_AdditionalSearchParams_Hook_BuildForm_SetBasicSearchUrlParamsAsDefault
 */
class CRM_AdditionalSearchParams_Hook_BuildForm_SetBasicSearchUrlParamsAsDefault {

  /**
   * URL parameters that will be used to replace form defaults.
   *
   * @var array
   *   The key is the param name and value is param type.
   */
  private $urlParameters = [
    'contact_type' => 'String',
    'group' => 'CommaSeparatedIntegers',
    'tag' => 'CommaSeparatedIntegers'
  ];

  /**
   * Function that runs when hook is called.
   *
   * @param CRM_Core_Form $form
   *   Form Class object.
   * @param string $formName
   *   Form Name.
   */
  public function run(CRM_Core_Form &$form, $formName) {
    if (!$this->shouldRun($formName)) {
      return;
    }

    $this->setDefaultsForUrlParams($form);
  }

  /**
   * Sets defaults for form elements from URL parameters.
   *
   * @param CRM_Core_Form $form
   *   Form Class object.
   */
  private function setDefaultsForUrlParams($form) {
    foreach ($this->urlParameters as $paramName => $paramType) {
      $paramValue = CRM_Utils_Request::retrieve($paramName, $paramType);
      if ($paramValue) {
        $form->setDefaults([$paramName => $paramValue]);
      }
    }
  }

  /**
   * Determines if the hook will run.
   *
   * @param string $formName
   *   Form name.
   *
   * @return bool
   *   returns TRUE or FALSE.
   */
  private function shouldRun($formName) {
    return $formName == 'CRM_Contact_Form_Search_Basic';
  }

}
