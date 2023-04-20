<?php

namespace Drupal\compuclient\Setup\Step;

class ParticipantStatusesUpdateStep implements StepInterface {

  /**
   * Apply Participant Configuration
   */
  public function apply() {
    $this->enableWaitlistStatuses();
  }

  /**
   * Enable Participant Waitinglist Statuses
   */
  private function enableWaitlistStatuses() {
    $participantStatusTypes = civicrm_api3('ParticipantStatusType', 'get', [
      'return' => ["id"],
      'name' => ['IN' => ['On waitlist', 'Pending from waitlist']],
    ]);

    if (!empty($participantStatusTypes['values'])) {
      foreach ($participantStatusTypes['values'] as $statusType) {
        civicrm_api3('ParticipantStatusType', 'create', [
          'id' => $statusType['id'],
          'is_active' => 1
        ]);
      }
    }
  }

}
