<?php

use CRM_ManageLetterheads_BAO_LetterheadAvailability as LetterheadAvailability;
use CRM_ManageLetterheads_BAO_Letterhead as Letterhead;

/**
 * Manage letterhead Business Access Object class.
 */
class CRM_ManageLetterheads_BAO_Letterhead extends CRM_ManageLetterheads_DAO_Letterhead {

  /**
   * Create a new Letterhead based on array-data.
   *
   * @param array $params
   *   Key-value pairs.
   *
   * @return CRM_ManageLetterheads_DAO_Letterhead
   */
  public static function create($params) {
    $entityName = 'Letterhead';
    $hook = empty($params['id']) ? 'create' : 'edit';
    self::validateParams($params);

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    self::setName($params);
    $instance = new self();
    $instance->copyValues($params);
    $instance->save();
    self::saveAvailableForValues($instance, $params);

    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  }

  /**
   * Validation function.
   *
   * @param array $params
   *   Parameters.
   */
  private static function validateParams(array &$params) {
    self::validateAvailableFor($params);
  }

  /**
   * Validate Available For options.
   *
   * @param array $params
   *   Parameters.
   */
  private static function validateAvailableFor($params) {
    if (empty($params['available_for'])) {
      return;
    }

    $availableFor = $params['available_for'];
    $validOptions = array_flip(LetterheadAvailability::buildOptions('available_for', 'validate'));
    $optionsPresent = array_intersect($validOptions, $availableFor);

    if (count($availableFor) != count($optionsPresent)) {
      throw new Exception('Please make sure all Available For Options are valid');
    }
  }

  /**
   * Saves the options for which the letterhead is available for.
   *
   * @param \CRM_ManageLetterheads_BAO_Letterhead $instance
   *   Letterhead instance.
   * @param array $params
   *   Parameters.
   */
  private static function saveAvailableForValues(Letterhead $instance, $params) {
    if (empty($params['available_for'])) {
      return;
    }
    $availabilityTableName = LetterheadAvailability::getTableName();
    CRM_Core_DAO::executeQuery("DELETE FROM {$availabilityTableName} WHERE letterhead_id = $instance->id");

    foreach ($params['available_for'] as $availableFor) {
      $createParams = [
        'letterhead_id' => $instance->id,
        'available_for' => $availableFor,
      ];

      LetterheadAvailability::create($createParams);
    }
  }

  /**
   * Sets the name value for the letterhead.
   *
   * @param array $params
   *   Parameters.
   */
  private static function setName(&$params) {
    if (empty($params['title'])) {
      return;
    }

    $params['name'] = str_replace(' ', '', strtolower($params['title']));
  }

}
