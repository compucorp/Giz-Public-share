<?php

use CRM_Civicase_BAO_CaseCategoryInstance as CaseCategoryInstance;
use CRM_Civicase_Helper_CaseCategory as CaseCategory;

/**
 * Case Instance class.
 */
class CRM_Civicase_Service_CaseCategoryInstance {

  /**
   * Get case categories instances.
   *
   * @param string $instanceTypeName
   *   Case Category Instance Type name.
   */
  public function getCaseCategoryInstances($instanceTypeName = NULL) {
    $caseCategoryInstances = [];
    $caseCategoryInstance = new CaseCategoryInstance();

    if ($instanceTypeName) {
      $instanceId = civicrm_api3('OptionValue', 'get', [
        'sequential' => 1,
        'option_group_id' => 'case_category_instance_type',
        'name' => $instanceTypeName,
      ])['values'][0]['value'];

      $caseCategoryInstance->instance_id = $instanceId;
    }

    $caseCategoryInstance->find();

    while ($caseCategoryInstance->fetch()) {
      $caseCategoryInstances[$caseCategoryInstance->id] = clone $caseCategoryInstance;
    }

    return $caseCategoryInstances;
  }

  /**
   * Assigns instance to case type categories without an instance.
   *
   * Assigns `case_management` instance to the existing case type categories
   * which does not have instance assigned.
   */
  public function assignInstanceForExistingCaseCategories() {
    $caseTypeCategories = CaseCategory::getCaseCategories();

    $instances = $this->getCaseCategoryInstances();

    foreach ($caseTypeCategories as $caseTypeCategory) {
      $instanceRecord = NULL;

      foreach ($instances as $instance) {
        if ($instance->category_id == $caseTypeCategory['value']) {
          $instanceRecord = $instance;
          break;
        }
      }

      if (!$instanceRecord) {
        $instanceId = civicrm_api3('OptionValue', 'get', [
          'sequential' => 1,
          'option_group_id' => 'case_category_instance_type',
          'name' => 'case_management',
        ])['values'][0]['value'];

        $this->createInstanceTypeFor(
          $caseTypeCategory['value'],
          $instanceId
        );
      }
    }
  }

  /**
   * Creates/Edits instance for the given case type category.
   *
   * @param mixed $categoryValue
   *   Case category value.
   * @param mixed $instanceId
   *   Instance ID.
   */
  public function createInstanceTypeFor($categoryValue, $instanceId) {
    $caseCategoryInstance = new CaseCategoryInstance();
    $caseCategoryInstance->category_id = $categoryValue;
    $caseCategoryInstance->find();
    $existingInstance = $caseCategoryInstance->fetchAll();

    if (!empty($existingInstance)) {
      $caseCategoryInstance->id = $existingInstance[0]['id'];
    }

    $caseCategoryInstance->instance_id = $instanceId;
    $caseCategoryInstance->save();
  }

}
