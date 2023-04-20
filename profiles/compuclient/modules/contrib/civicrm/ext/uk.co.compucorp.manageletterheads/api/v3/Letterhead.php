<?php

/**
 * Letterhead.create API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec
 *   Description of fields supported by this API call
 */
function _civicrm_api3_letterhead_create_spec(&$spec) {
  $spec['available_for'] = [
    'title' => 'What this Letterhead is available for',
    'description' => 'A array of option values from the available_for option group e.g [1, 2, 3]',
    'type' => CRM_Utils_Type::T_STRING,
    'api.required' => TRUE,
  ];
}

/**
 * Letterhead.create API
 *
 * @param array $params
 *   API parameters.
 * @return array
 *   API result descriptor
 */
function civicrm_api3_letterhead_create($params) {
  $extraFields = ['available_for'];
  foreach ($extraFields as $field) {
    if (isset($params[$field])) {
      $params[$field] = _civicrm_api3_letterhead_getParameterValue($params, $field);
    }
  }

  return _civicrm_api3_basic_create(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}

/**
 * Letterhead.delete API
 *
 * @param array $params
 *   API parameters.
 *
 * @return array
 *   API result descriptor
 */
function civicrm_api3_letterhead_delete($params) {
  $availabilityTableName = CRM_ManageLetterheads_BAO_LetterheadAvailability::getTableName();
  $query = "DELETE FROM {$availabilityTableName} WHERE letterhead_id = %1";
  $queryParams = [1 => [$params['id'], 'String']];
  CRM_Core_DAO::executeQuery($query, $queryParams);

  return _civicrm_api3_basic_delete(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}

/**
 * Letterhead.get API
 *
 * @param array $params
 *   API parameters.
 * @return array
 *   API result descriptor
 */
function civicrm_api3_letterhead_get($params) {
  return _civicrm_api3_basic_get(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}

/**
 * Gets the parameter value from $params array.
 *
 * This function is useful when we want the parameter to not support
 * any SQL operator, i.e we expect a single value or an array of values to
 * be passed in for the parameter.
 *
 * @param array $params
 *   API parameters.
 * @param string $parameterName
 *   Parameter name.
 *
 * @return array
 *   The parameter value.
 */
function _civicrm_api3_letterhead_getParameterValue(array $params, $parameterName) {
  if (empty($params[$parameterName])) {
    return [];
  }

  if (!is_array($params[$parameterName])) {
    return [$params[$parameterName]];
  }

  $acceptedSQLOperators = CRM_Core_DAO::acceptedSQLOperators();
  if (array_intersect($acceptedSQLOperators, array_keys($params[$parameterName]))) {
    throw new InvalidArgumentException("No SQL operators allowed for {$parameterName}");
  }

  return $params[$parameterName];
}
