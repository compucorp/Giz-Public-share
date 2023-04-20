<?php

namespace Drupal\compuclient\Setup\Step;

/**
 * CiviCRM Localisation Configuration Step.
 */
class CiviCRMLocalisationConfigurationStep implements StepInterface {

  /**
   * Applies localisation configurations.
   */
  public function apply() {
    $this->configLocalisationSettings();
    $this->setAvailableCountries();
    $this->setAvailableProvinces();
    $this->setAddressFormat();
    $this->setAddressEditingOptions();
  }

  /**
   * Updates the default localization settings which includes.
   *
   *   1- setting the default currency to GBP
   *   2- setting the default date formats
   *   3- setting the default country to UK
   *   4- setting the system language to UK english (en_GB)
   */
  private function configLocalisationSettings() {
    $settings = [
      'defaultCurrency' => 'GBP',
      'dateformatDatetime' => '%E%f %B %Y %l:%M %P',
      'dateformatFull' => '%E%f %B %Y',
      'dateformatFinancialBatch' => '%d/%m/%Y',
      'dateInputFormat' => 'dd/mm/yy',
      'timeInputFormat' => 2,
      'lcMessages' => 'en_GB',
    ];

    // Get UK Country ID.
    $ukCountry = civicrm_api3('Country', 'get', [
      'return' => ['id'],
      'iso_code' => 'GB',
      'options' => ['limit' => 1],
    ]);
    if (!empty($ukCountry['id'])) {
      $settings['defaultContactCountry'] = $ukCountry['id'];
    }

    civicrm_api3('Setting', 'create', $settings);
  }

  /**
   * Sets Available Countries to 'all countries'.
   */
  private function setAvailableCountries() {
    $countriesList = civicrm_api3('Country', 'get', [
      'sequential' => 1,
      'return' => ['id'],
      'options' => ['limit' => 0],
    ]);

    if (!empty($countriesList['values'])) {
      $countriesIDs = array_column($countriesList['values'], 'id');
      unset($countriesList);

      civicrm_api3('Setting', 'create', [
        'countryLimit' => $countriesIDs,
      ]);
    }
  }

  /**
   * Sets Available Provinces to 'all provinces'.
   */
  private function setAvailableProvinces() {
    $countries = civicrm_api3('Country', 'get', [
      'sequential' => 1,
      'options' => ['limit' => 0],
    ]);
    $countryIDs = [];

    foreach ($countries['values'] as $currentCountry) {
      $countryIDs[] = $currentCountry['id'];
    }

    if (!empty($countryIDs)) {
      civicrm_api3('Setting', 'create', ['provinceLimit' => $countryIDs]);
    }
  }

  /**
   * Set Address format.
   */
  private function setAddressFormat() {
    $addressFormat = '{contact.address_name}'
      . PHP_EOL . '{contact.street_address}'
      . PHP_EOL . '{contact.supplemental_address_1}'
      . PHP_EOL . '{contact.supplemental_address_2}'
      . PHP_EOL . '{contact.supplemental_address_3}'
      . PHP_EOL . '{contact.city}{, }{contact.state_province_name}'
      . PHP_EOL . '{contact.postal_code}';

    civicrm_api3('Setting', 'create', [
      'address_format' => $addressFormat,
      'mailing_format' => $addressFormat,
    ]);
  }

  /**
   * Sets Address Editing Options.
   */
  private function setAddressEditingOptions() {
    civicrm_api3('Setting', 'create', [
      'address_options' => [
        // Street Address.
        '1',
        // Supplemental Address 1.
        '2',
        // Supplemental Address 2.
        '3',
        // Supplemental Address 3.
        '4',
        // City.
        '5',
        // Post code.
        '6',
        // Country.
        "10",
      ],
    ]);
  }

}
