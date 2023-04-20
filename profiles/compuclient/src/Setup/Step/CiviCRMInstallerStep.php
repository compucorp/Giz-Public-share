<?php

namespace Drupal\compuclient\Setup\Step;

use Civi\Setup;

/**
 * CiviCRM Installation Step.
 */
class CiviCRMInstallerStep implements StepInterface {

  /**
   * Contains the variables passed to the installer script.
   *
   * @var array
   */
  private $installState = [];

  /**
   * Constructor.
   *
   * @param array $installState
   *   Drupal installation states used between tasks.
   */
  public function __construct(array $installState) {
    $this->installState = $installState;
  }

  /**
   * Installs CiviCRM.
   */
  public function apply() {
    watchdog(WATCHDOG_INFO, 'Installing CiviCRM');

    // Make the settings directory writable.
    $settingsDir = DRUPAL_ROOT . '/sites/default';
    $temporaryPermissions = 0777;
    chmod($settingsDir, $temporaryPermissions);

    $setup = $this->initSetup();
    $this->checkInstallationRequirements($setup);
    $setup->installFiles();
    $setup->installDatabase();

    // Revert to recommended permissions.
    chmod($settingsDir, 0755);

    watchdog(WATCHDOG_INFO, 'CiviCRM Installed');
  }

  /**
   * Validates current setup to ensure installation can be performed.
   *
   * @param Civi\Setup $setup
   *   CivicRM setup class.
   */
  private function checkInstallationRequirements(Setup $setup) {
    if (!$setup->checkAuthorized()->isAuthorized()) {
      exit("Sorry, you are not authorized to perform installation.");
    }

    $reqs = $setup->checkRequirements();
    $errors = $reqs->getErrors();
    // Because of how the script is run any URL containing '/' will fail.
    unset($errors['cmsBaseUrl']);

    if ($errors) {
      print_r($reqs->getErrors());
      exit("Cannot install. Please address the system requirements.");
    }

    $installed = $setup->checkInstalled();
    if ($installed->isSettingInstalled() || $installed->isDatabaseInstalled()) {
      exit("Cannot install. CiviCRM has already been installed.");
    }
  }

  /**
   * Gets the CiviCRM database settings from the installer arguments.
   *
   * @return array
   *   CiviCRM database settings.
   */
  private function getCiviDbSettings() {
    $forms = $this->installState['forms'];

    if (empty($forms['database_configuration'])) {
      global $databases;
      $civiDbSettings = $databases['civicrm']['default'];
    }
    else {
      $dbSettings = $forms['database_configuration'];
      $civiDbSettings = $dbSettings['civicrm'];
    }

    $defaults = [
      'host' => $forms['database_configuration']['advanced']['host'] ?: '127.0.0.1',
      'port' => $forms['database_configuration']['advanced']['port'] ?: '3306',
      'ssl_params' => [
        'key' => $forms['database_configuration']['advanced']['ssl_key'] ?? NULL,
        'cert' => $forms['database_configuration']['advanced']['ssl_cert'] ?? NULL,
        'ca' => $forms['database_configuration']['advanced']['ssl_ca'] ?? NULL,
        'capath' => $forms['database_configuration']['advanced']['ssl_capath'] ?? NULL,
        'cipher' => $forms['database_configuration']['advanced']['ssl_cipher'] ?? NULL,
      ],
      'driver' => 'mysql',
      'prefix' => '',
    ];

    return array_merge($civiDbSettings, $defaults);
  }

  /**
   * Gets the base URL.
   *
   * The base URL which is used in creation of civicrm.settings.php
   * from the arguments passed to the script.
   *
   * @return string
   *   Sites base URL.
   */
  private function getBaseUrl() {
    $forms = $this->installState['forms'];
    $configSettings = $forms['site_configuration'];

    return $configSettings['base_url'];
  }

  /**
   * Create the setup object for installing CiviCRM.
   *
   * @return Civi\Setup
   *   CiviCRM Setup Class.
   */
  private function initSetup() {
    global $databases, $language;

    // Workaround for warning in Drupal.civi-setup.php.
    if ($language) {
      $language->langcode = 'en_US';
    }

    $civiDbSettings = $this->getCiviDbSettings();
    $databases['civicrm']['default'] = $civiDbSettings;

    $civicrmPath = dirname(drupal_get_path('module', 'civicrm'));
    Setup::assertProtocolCompatibility(1.0);
    Setup::init([
      'cms' => 'Drupal',
      'srcPath' => $civicrmPath,
    ]);

    $setup = Setup::instance();
    $model = $setup->getModel();
    $model->cmsBaseUrl = $this->getBaseUrl();
    $model->db = [
      'server' => "{$civiDbSettings['host']}:{$civiDbSettings['port']}",
      'username' => $civiDbSettings['username'],
      'password' => $civiDbSettings['password'],
      'database' => $civiDbSettings['database'],
    ];

    $sslParams = array_filter($civiDbSettings['ssl_params']);
    if (!empty($sslParams)) {
      $model->db['ssl_params'] = $sslParams;
      $model->cmsDb['ssl_params'] = $sslParams;
    }

    // This is never initialized and leads to a warning if used in foreach.
    $setup->getModel()->mandatorySettings = [];

    return $setup;
  }

}
