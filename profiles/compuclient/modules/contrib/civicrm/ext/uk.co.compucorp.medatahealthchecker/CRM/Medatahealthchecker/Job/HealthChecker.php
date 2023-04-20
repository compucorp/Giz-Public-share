<?php

class CRM_Medatahealthchecker_Job_HealthChecker {

  public function run() {
    $dataChecker = new CRM_Medatahealthchecker_DataChecker_Main();
    $dataChecker->validateData();
  }

}
