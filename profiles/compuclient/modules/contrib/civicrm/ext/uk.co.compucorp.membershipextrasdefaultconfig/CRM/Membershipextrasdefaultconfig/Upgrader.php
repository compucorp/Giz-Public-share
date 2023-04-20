<?php
use CRM_Membershipextrasdefaultconfig_ExtensionUtil as E;
use CRM_Membershipextrasdefaultconfig_Setup_CreateSampleContributionPageStep as CreateSampleContributionPageStep;
use CRM_Membershipextrasdefaultconfig_Setup_CreateDummyPaymentProcessorStep as CreateDummyPaymentProcessorStep;

/**
 * Collection of upgrade steps.
 */
class CRM_Membershipextrasdefaultconfig_Upgrader extends CRM_Membershipextrasdefaultconfig_Upgrader_Base {

  public function Install() {
    $steps = [
      new CreateDummyPaymentProcessorStep(),
      new CreateSampleContributionPageStep(),
    ];

    foreach ($steps as $step) {
      $step->apply();
    }
  }

}
