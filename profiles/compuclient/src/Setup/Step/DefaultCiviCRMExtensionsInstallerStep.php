<?php

namespace Drupal\compuclient\Setup\Step;

/**
 * Default CiviCRM Extensions Installer Step.
 */
class DefaultCiviCRMExtensionsInstallerStep implements StepInterface {

  /**
   * Contains the extension manager.
   *
   * @var \CRM_Extension_Manager
   */
  private $extensionManager;

  /**
   * Enables/Disables all required or unneeded CiviCRM extensions.
   */
  public function apply() {
    $this->setExtensionManager();

    $this->enableExtensions();
    $this->disableExtensions();
  }

  /**
   * Sets the extension manager for enabling and disabling extensions.
   */
  private function setExtensionManager() {
    // Civi caches the configuration in memory when it bootstraps,
    // so, in order to fetch the new extension path, we need to clear
    // the configuration cached in memory.
    \CRM_Core_Config::singleton()->free();

    // Next, we need to make the extension system to use this new value.
    // The only way to do it, is by instantiating a new one, without any
    // params. This will make it load values from the configuration we
    // have just cleared, meaning it will reload things from DB.
    $extensionSystem = new \CRM_Extension_System();

    // Finally, get the manager directly from this extension we've just
    // instantiated. We cannot use the API here because it would use the
    // extension system that was instantiated during the CiviCRM bootstrap
    // and that still holds the old extension path.
    $this->extensionManager = $extensionSystem->getManager();
  }

  /**
   * Enables extensions.
   */
  private function enableExtensions() {
    $this->extensionManager->install([
      'org.civicrm.shoreditch',
      'uk.co.compucorp.usermenu',
      'uk.co.compucorp.civicase',
      'uk.co.compucorp.civiawards',
      'uk.co.compucorp.civicrm.prospect',
      'uk.co.compucorp.civicrm.pivotreport',
      'uk.co.compucorp.additionalsearchparams',
      'uk.co.compucorp.civicrm.giftaid',
      'uk.co.compucorp.membershipextras',
      'uk.co.compucorp.membershipextrasdefaultconfig',
      'uk.co.compucorp.medatahealthchecker',
      'org.civicoop.civirules',
      'nz.co.fuzion.csvimport',
      'org.civicrm.module.cividiscount',
      'biz.jmaconsulting.lineitemedit',
      'nz.co.fuzion.extendedreport',
      'org.civicrm.flexmailer',
      'uk.co.vedaconsulting.mosaico',
      'io.compuco.custommosaico',
      'uk.co.compucorp.eventsextras',
      'uk.compucorp.civicrm.amazonsns',
      'uk.co.compucorp.certificate',
      'mosaicoextras',
      'uk.co.compucorp.membersonlyevent',
    ]);
  }

  /**
   * Disables extensions.
   *
   * Some core extensions are enabled by default,
   * here we get the opportunity to disable them
   * if the functionally provided by them is not desired
   * by us.
   */
  private function disableExtensions() {
    $this->extensionManager->disable([
      'contributioncancelactions',
    ]);
  }

}
