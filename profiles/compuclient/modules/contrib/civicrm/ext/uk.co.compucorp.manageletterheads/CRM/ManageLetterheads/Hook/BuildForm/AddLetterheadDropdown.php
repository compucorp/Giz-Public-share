<?php

/**
 * Adds the letterhead dropdown element to the Email and PDF Letter forms.
 *
 * The list of letterheads that should be visible for each form is also appended
 * as a configuration variable.
 */
class CRM_ManageLetterheads_Hook_BuildForm_AddLetterheadDropdown {

  /**
   * @var bool
   */
  private $isEmailForm = FALSE;

  /**
   * @var bool
   */
  private $isPdfLetterForm = FALSE;

  /**
   * Build Form hook handler.
   *
   * @param string $formName
   *   The name for the current form.
   * @param CRM_Core_Form $form
   *   The curernt form instance.
   */
  public function run ($formName, $form) {
    $this->isPdfLetterForm = get_class($form) === CRM_Contact_Form_Task_PDF::class;
    $this->isEmailForm = get_class($form) === CRM_Contact_Form_Task_Email::class;

    if (!$this->shouldRun()) {
      return;
    }

    $availableForName = $this->isEmailForm ? 'emails' : 'pdf_letters';
    $letterheads = $this->getLetterheadsAvailableFor($availableForName);

    $this->addListOfLetterheadOptionsToConfig($letterheads);
  }

  /**
   * Returns all the letterheads that belong to the given "Available For".
   *
   * Only active letterheads are returned, sorted by their weight.
   *
   * @param string $availableForName
   *   The "Available For" name to filter letterheads by.
   */
  private function getLetterheadsAvailableFor($availableForName) {
    $availabilityResults = civicrm_api3('LetterheadAvailability', 'get', [
      'return' => ['letterhead_id'],
      'available_for' => $availableForName,
    ]);

    if (empty($availabilityResults['values'])) {
      return [];
    }

    $letterHeadIds = array_column($availabilityResults['values'], 'letterhead_id');

    $letterheadResults = civicrm_api3('Letterhead', 'get', [
      'sequential' => '1',
      'id' => ['IN' => $letterHeadIds],
      'is_active' => '1',
      'options' => ['sort' => 'weight ASC'],
    ]);

    return $letterheadResults['values'];
  }

  /**
   * Adds the given list of letterheads to a configuration variable.
   *
   * This configuration variable can be accessed by the front-end to build
   * the dropdown for the letterheads. The letterheads are provided as a JSON
   * string to avoid CiviCRM from extending the object instead of replacing
   * it.
   *
   * The script to build this dropdown is also appended.
   *
   * @param array $letterheads
   *   A list of letterheads to add to the CiviCRM configuration.
   */
  private function addListOfLetterheadOptionsToConfig($letterheads) {
    CRM_Core_Resources::singleton()
      ->addScriptFile('uk.co.compucorp.manageletterheads', 'js/letterheads-dropdown.js')
      ->addSetting([
        'manageletterheads' => [
          'letterhead_options' => json_encode($letterheads),
        ],
      ]);
  }

  /**
   * Determines if the hook handler should run.
   *
   * Only runs for the Email or PDF Letter forms.
   *
   * @return bool
   */
  private function shouldRun () {
    return $this->isPdfLetterForm || $this->isEmailForm;
  }

}
