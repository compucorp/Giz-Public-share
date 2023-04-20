<?php

use CRM_ManageLetterheads_ExtensionUtil as E;
use CRM_ManageLetterheads_BAO_LetterheadAvailability as LetterheadAvailability;

/**
 * Create Letterhead Form class.
 */
class CRM_ManageLetterheads_Form_LetterheadForm extends CRM_Core_Form {

  /**
   * @var string
   *   The ID for the letterhead. Used when updating.
   */
  private $_letterheadId;

  /**
   * Adds the form fields and buttons.
   */
  public function buildQuickForm() {
    $isAddAction = $this->_action & CRM_Core_Action::ADD;

    if ($isAddAction) {
      $this->setDefaults(['is_active' => '1']);
      $this->setDefaultWeight();
    }

    $this->addFormElements();
    $this->assign('elementNames', $this->getRenderableElementNames());
    $this->preventAjaxSubmit();
    parent::buildQuickForm();
  }

  /**
   * Stores the letterhead ID internally, if provided.
   */
  public function preProcess() {
    $this->_letterheadId = CRM_Utils_Request::retrieve('id', 'Positive', $this);
  }

  /**
   * Populates the letterhead fields when using the update form.
   *
   * @return array
   */
  public function setDefaultValues() {
    $hasDefaultValues = !empty($this->defaultValues);
    $isUpdateAction = $this->_action & CRM_Core_Action::UPDATE;

    if ($hasDefaultValues || !$isUpdateAction) {
      return NULL;
    }

    $letterhead = civicrm_api3('Letterhead', 'getsingle', [
      'id' => $this->_letterheadId,
    ]);

    $letterhead['available_for'] = $this->getAvailableForValuesAsKeys(
      $letterhead['available_for']
    );

    $this->defaultValues = $letterhead;

    return $this->defaultValues;
  }

  /**
   * Handles the letterhead creation and update process.
   */
  public function postProcess() {
    $isUpdateAction = $this->_action & CRM_Core_Action::UPDATE;
    $letterhead = $this->controller->exportValues($this->_name);
    $letterhead['available_for'] = array_keys($letterhead['available_for']);

    if ($isUpdateAction) {
      $letterhead['id'] = $this->_letterheadId;
    }

    civicrm_api3('Letterhead', 'create', $letterhead);
    $this->addSuccessMessage();
    $this->redirectToLetterheadsListPage();
  }

  /**
   * Flips an array of Available For values as keys of the array.
   *
   * This is done because they are stored as [a, b, c], where a, b, and are
   * the Available For option values, but the form understands it as
   * [a => 1, b => 0, c => 1] where 1 or 0 means checked/uncheked.
   *
   * @param array $availableFor
   *   An array Available For option values.
   * @return array
   */
  private function getAvailableForValuesAsKeys(array $availableFor) {
    return array_fill_keys($availableFor, 1);
  }

  /**
   * Displays a success message after the letterhead has been created.
   */
  private function addSuccessMessage() {
    $isAddAction = $this->_action & CRM_Core_Action::ADD;
    $successMessage = $isAddAction
      ? E::ts('New letterhead created')
      : E::ts('Letterhead saved');

    CRM_Core_Session::setStatus(
      $successMessage,
      E::ts('Saved'),
      'success'
    );
  }

  /**
   * Redirects the user to the list page.
   */
  private function redirectToLetterheadsListPage() {
    $url = CRM_Utils_System::url('civicrm/letterheads/list', NULL, TRUE);

    CRM_Utils_System::redirect($url);
  }

  /**
   * Adds the form elements including fields and buttons.
   */
  private function addFormElements() {
    $this->add('text', 'title', E::ts('Title'), NULL, TRUE);
    $this->add('textarea', 'description', E::ts('Description'));
    $this->add('wysiwyg', 'content', E::ts('Content'), NULL, TRUE);
    $this->addCheckbox(
      'available_for',
      E::ts('Available For'),
      array_flip(LetterheadAvailability::buildOptions('available_for')),
      NULL,
      NULL,
      TRUE
    );
    $this->add('number', 'weight', E::ts('Order'), [], TRUE);
    $this->addElement('advcheckbox', 'is_active', E::ts('Enabled'));

    $this->addButtons([
      [
        'type' => 'submit',
        'name' => E::ts('Save'),
        'isDefault' => TRUE,
      ],
      [
        'type' => 'cancel',
        'name' => E::ts('Cancel'),
      ],
    ]);
  }

  /**
   * Sets the default value of the "order" (weight) field.
   *
   * The value is the highest weight value currently recorded, plus 1.
   */
  private function setDefaultWeight() {
    $lastLetterheadWeightValue = 0;
    $lastLetterheadByWeight = civicrm_api3('Letterhead', 'get', [
      'sequential' => 1,
      'options' => [
        'limit' => '1',
        'sort' => 'weight DESC',
      ],
    ]);

    if ($lastLetterheadByWeight['count']) {
      $lastLetterheadWeightValue = $lastLetterheadByWeight['values'][0]['weight'];
    }

    $this->setDefaults([
      'weight' => $lastLetterheadWeightValue + 1,
    ]);
  }

  /**
   * Returns the list of names of form elements that will be visible to the user.
   *
   * @return array (string)
   */
  private function getRenderableElementNames() {
    $elementNames = [];

    foreach ($this->_elements as $element) {
      $label = $element->getLabel();

      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }

    return $elementNames;
  }

}
