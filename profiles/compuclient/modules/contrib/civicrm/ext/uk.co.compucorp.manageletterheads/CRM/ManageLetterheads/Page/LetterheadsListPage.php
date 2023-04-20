<?php

use CRM_ManageLetterheads_ExtensionUtil as E;
use CRM_ManageLetterheads_BAO_LetterheadAvailability as LetterheadAvailability;

/**
 * LetterheadsListPage class.
 *
 * A page that displays the full list of letterheads.
 */
class CRM_ManageLetterheads_Page_LetterheadsListPage extends CRM_Core_Page {

  /**
   * @var array
   *   List of all available actions for a letterhead.
   */
  private $actions;

  /**
   * @var array
   *   List of "Available For" labels, indexed by value.
   */
  private $availableForLabels;

  /**
   * Assigns the page's template values.
   */
  public function run() {
    $this->availableForLabels = LetterheadAvailability::buildOptions('available_for');
    $pager = $this->getPager();
    list($offset, $limit) = $pager->getOffsetAndRowCount();

    $this->assign_by_ref('pager', $pager);
    $this->assign('letterheads', $this->getLetterheads($offset, $limit));

    CRM_Core_Resources::singleton()
      ->addScriptFile('uk.co.compucorp.manageletterheads', 'js/row-actions.js');

    parent::run();
  }

  /**
   * Returns the Letterhead BAO class name.
   *
   * This is used by the enable/disable CiviCRM API to handle these actions
   * automatically
   *
   * @return string
   */
  public function getBAOName() {
    return 'CRM_ManageLetterheads_BAO_Letterhead';
  }

  /**
   * Returns the pager object that can be used to paginate letterheads.
   *
   * @return CRM_Utils_Pager
   */
  private function getPager() {
    $totalLetterheads = civicrm_api3('Letterhead', 'getcount');
    $params['total'] = $totalLetterheads;
    $params['currentPage'] = $this->get(CRM_Utils_Pager::PAGE_ID);
    $params['rowCount'] = CRM_Utils_Pager::ROWCOUNT;
    $pager = new CRM_Utils_Pager($params);

    return $pager;
  }

  /**
   * Returns the full list of letterheads.
   *
   * The letterheads fields are formatted so they include values as rendered on
   * the template.
   *
   * @param $offset
   *   The offset record to start fetching letterheads from.
   * @param $limit
   *   The limit of letterheads to return.
   * @return array
   */
  private function getLetterheads($offset, $limit) {
    $letterheads = civicrm_api3('Letterhead', 'get', [
      'sequential' => 1,
      'options' => [
        'limit' => $limit,
        'offset' => $offset,
        'sort' => 'weight ASC',
      ],
    ]);

    return array_map(
      [$this, 'getLetterheadViewValues'],
      $letterheads['values']
    );
  }

  /**
   * Returns the formatted values for a given letterhead.
   *
   * It returns the available for labels instead of their values as well as
   * "Yes" or "No" for the active field instead of using numerical values.
   *
   * @param array $letterhead
   *   The letterhead data as returned by the API.
   * @return array
   *   The formatted letterhead.
   */
  private function getLetterheadViewValues(array $letterhead) {
    $availableForLabels = $this->getAvailableForLabelsFromValues(
      $letterhead['available_for']
    );

    $letterhead['available_for_text'] = implode($availableForLabels, ', ');
    $letterhead['actions'] = $this->getLetterheadActions($letterhead);
    $letterhead['is_active_text'] = $letterhead['is_active'] === '1'
      ? E::ts('Yes')
      : E::ts('No');

    return $letterhead;
  }

  /**
   * Returns the labels for the given Available For values.
   *
   * @param array $optionValues
   *   A list of Available For values.
   * @return array
   *   A list of Available For labels.
   */
  private function getAvailableForLabelsFromValues(array $optionValues) {
    return array_map(
      function ($optionValue) {
        return $this->availableForLabels[$optionValue];
      },
      $optionValues
    );
  }

  /**
   * Returns the list of actions for the given letterhead.
   *
   * @param array $letterhead
   *   The data belonging to a letterhead.
   * @return string
   *   The list of actions as an HTML string.
   */
  private function getLetterheadActions(array $letterhead) {
    $allActions = $this->getAllAvailableActions();
    $letterheadActions = array_sum(array_keys($allActions));

    if ($letterhead['is_active'] === '0') {
      $letterheadActions -= CRM_Core_Action::DISABLE;
    }
    else {
      $letterheadActions -= CRM_Core_Action::ENABLE;
    }

    return CRM_Core_Action::formLink(
      $allActions,
      $letterheadActions,
      ['id' => $letterhead['id']]
    );
  }

  /**
   * Returns the full list of actions that are available for a letterhead.
   *
   * @return array
   */
  private function getAllAvailableActions() {
    if (!$this->actions) {
      $this->actions = [
        CRM_Core_Action::UPDATE => [
          'class' => 'letterhead-edit crm-popup',
          'name' => E::ts('Edit'),
          'title' => E::ts('Edit'),
          'url' => 'civicrm/letterheads/form',
          'qs' => 'action=update&id=%%id%%&reset=1',
        ],
        CRM_Core_Action::ENABLE => [
          'class' => 'letterhead-enable crm-enable-disable',
          'name' => E::ts('Enable'),
          'title' => E::ts('Enable'),
        ],
        CRM_Core_Action::DISABLE => [
          'class' => 'letterhead-disable crm-enable-disable',
          'name' => E::ts('Disable'),
          'title' => E::ts('Disable'),
        ],
        CRM_Core_Action::DELETE => [
          'class' => 'letterhead-delete',
          'name' => E::ts('Delete'),
          'title' => E::ts('Delete'),
        ],
      ];
    }

    return $this->actions;
  }

}
