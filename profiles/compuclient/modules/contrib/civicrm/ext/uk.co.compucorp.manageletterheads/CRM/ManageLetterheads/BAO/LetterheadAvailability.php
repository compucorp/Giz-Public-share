<?php

/**
 * Letterhead Availability Business Access Object class.
 */
class CRM_ManageLetterheads_BAO_LetterheadAvailability extends CRM_ManageLetterheads_DAO_LetterheadAvailability {

  /**
   * Create a new LetterheadAvailability based on array-data
   *
   * @param array $params
   *   Key-value pairs.
   *
   * @return CRM_ManageLetterheads_DAO_LetterheadAvailability
   */
  public static function create($params) {
    $entityName = 'LetterheadAvailability';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new self();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  }

}
