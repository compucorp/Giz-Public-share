<?php

class CRM_Medatahealthchecker_Upgrader extends CRM_Medatahealthchecker_Upgrader_Base {

  public function postInstall() {
    $this->createHealthCheckerScheduledJob();
  }

  private function createHealthCheckerScheduledJob() {
    $result = civicrm_api3('Job', 'get', [
      'name' => 'Membershipextras - data health checker',
    ]);

    if ($result['count'] > 0) {
      return;
    }

    civicrm_api3('Job', 'create', [
      'run_frequency' => 'Daily',
      'name' => 'Membershipextras - data health checker',
      'description' => ts('Perform data health checks on Membershipextras and CiviCRM financial data'),
      'api_entity' => 'MembershipextrasDataHealthChecker',
      'api_action' => 'run',
      'is_active' => 1,
    ]);
  }

  public function uninstall() {
    $this->removeHealthCheckerScheduledJob(TRUE);
  }

  private function removeHealthCheckerScheduledJob() {
    civicrm_api3('Job', 'get', [
      'name' => 'Membershipextras - data health checker',
      'api.Job.delete' => ['id' => '$value.id'],
    ]);
  }

  public function enable() {
    $this->toggleHealthCheckerScheduledJob(TRUE);
  }

  public function disable() {
    $this->toggleHealthCheckerScheduledJob(FALSE);
  }

  private function toggleHealthCheckerScheduledJob($newStatus) {
    civicrm_api3('Job', 'get', [
      'name' => 'Membershipextras - data health checker',
      'api.Job.create' => ['id' => '$value.id', 'is_active' => $newStatus],
    ]);
  }

}
