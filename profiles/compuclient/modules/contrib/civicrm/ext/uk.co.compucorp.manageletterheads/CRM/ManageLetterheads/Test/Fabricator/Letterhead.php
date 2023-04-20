<?php

/**
 * Fabricator class for Letterhead entity.
 */
class CRM_ManageLetterheads_Test_Fabricator_Letterhead {

  /**
   * Letterhead weight.
   *
   * @var int
   */
  private static $weight = 0;

  /**
   * Fabricate a letterhead entity.
   *
   * @param array $params
   *   Parameters.
   *
   * @return mixed
   */
  public static function fabricate($params) {
    $params = array_merge(self::getDefaultParams(), $params);
    $result = civicrm_api3(
      'Letterhead',
      'create',
      $params
    );

    self::$weight++;

    return array_shift($result['values']);
  }

  /**
   * Returns default letterhead parameters.
   *
   * @return array
   *   Default letterhead parameters.
   */
  private static function getDefaultParams() {
    return [
      'description' => 'Letterhead description',
      'weight' => self::$weight,
      'is_active' => 1,
      'content' => 'Letterhead content',
    ];
  }

}
