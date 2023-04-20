<?php

/**
 * LetterheadAvailability.get API
 *
 * @param array $params
 *   API parameters.
 * @return array
 *   API result descriptor
 */
function civicrm_api3_letterhead_availability_get($params) {
  return _civicrm_api3_basic_get(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}
