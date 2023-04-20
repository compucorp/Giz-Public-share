<?php

/**
 * Data health checker scheduled job API
 *
 * @param $params
 * @return array
 */
function civicrm_api3_membershipextras_data_health_checker_run($params) {
  try {
    $dataHealthChecker = new CRM_Medatahealthchecker_Job_HealthChecker();
    $dataHealthChecker->run();
  }
  catch (Exception $exception) {
    return civicrm_api3_create_error($exception->getMessage());
  }
}
