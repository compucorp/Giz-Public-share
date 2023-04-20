<?php

namespace Drupal\compuclient\Setup\Step;

class CiviCRMJobScheduleConfigurationStep implements StepInterface {

  /**
   * Apply CiviCRM Job Schedule configuration
   */
  public function apply() {
    $this->enableDefaultJobs();
    $this->disableDefaultJobs();
    $this->setAlwaysFrequentlyJobs();
    $this->setHourlyFrequentlyJobs();
    $this->setDailyFrequentlyJobs();
    $this->configCleanupJob();
  }

  /**
   * Enable default Scheduled Jobs
  */
  private function enableDefaultJobs() {
    civicrm_api3('Job', 'get', [
      'sequential' => 1,
      'name' => [
        'IN' => [
          'CiviCRM Update Check',
          'Clean-up Temporary Data and Files',
          'Disable expired relationships',
          'Fetch Bounces',
          'Geocode and Parse Addresses',
          'Mail Reports',
          'Process Inbound Emails',
          'Process Pledges',
          'Rebuild Smart Group Cache',
          'Send Scheduled Mailings',
          'Send Scheduled Reminders',
          'Update Greetings and Addressees',
          'Update Membership Statuses',
          'Update Participant Statuses',
          'Validate Email Address from Mailings.',
        ]
      ],
      'api.Job.create' => [
        'id' => '$value.id',
        'is_active' => 1,
      ],
    ]);
  }

  /**
   * Disable default Scheduled Jobs
  */
  private function disableDefaultJobs() {
    civicrm_api3('Job', 'get', [
      'sequential' => 1,
      'name' => [
        'IN' => [
          'Process Survey Respondents',
          'Send Scheduled SMS'
        ]
      ],
      'api.Job.create' => [
        'id' => '$value.id',
        'is_active' => 0,
      ],
    ]);

  }

  /**
   * Set running frequency to Always
   */
  private function setAlwaysFrequentlyJobs() {
    civicrm_api3('Job', 'get', [
      'sequential' => 1,
      'name' => [
        'IN' => [
          'Send Scheduled Mailings',
          'Send Scheduled Reminders',
        ]
      ],
      'api.Job.create' => [
        'id' => '$value.id',
        'run_frequency' => 'Always',
      ],
    ]);
  }

  /**
   * Set running frequency to Hourly
   */
  private function setHourlyFrequentlyJobs() {
    civicrm_api3('Job', 'get', [
      'sequential' => 1,
      'name' => [
        'IN' => [
          'Clean-up Temporary Data and Files',
          'Fetch Bounces',
          'Process Inbound Emails',
          'Update Membership Statuses',
          'Update Participant Statuses',
          'Validate Email Address from Mailings.',
        ]
      ],
      'api.Job.create' => [
        'id' => '$value.id',
        'run_frequency' => 'Hourly',
      ],
    ]);
  }

  /**
   * Set running frequency to Daily
   */
  private function setDailyFrequentlyJobs() {
    civicrm_api3('Job', 'get', [
      'sequential' => 1,
      'name' => [
        'IN' => [
          'CiviCRM Update Check',
          'Disable expired relationships',
          'Geocode and Parse Addresses	',
          'Mail Reports',
          'Process Pledges',
          'Rebuild Smart Group Cache',
          'Update Greetings and Addressees'
        ]
      ],
      'api.Job.create' => [
        'id' => '$value.id',
        'run_frequency' => 'Daily',
      ],
    ]);
  }

   /**
   * Looking for existing Clean up job and set parameters
   */
  private function configCleanupJob() {
    civicrm_api3('Job', 'get', [
      'sequential' => 1,
      'name' => 'Clean-up Temporary Data and Files',
      'api_entity' => 'Job',
      'api_action' => 'cleanup',
      'api.Job.create' => [
        'id' => '$value.id',
        'parameters' => 'dbCache=1',
      ],
    ]);
  }
}
