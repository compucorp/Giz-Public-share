<?php

/**
 * @file
 * Admin configuration settings for Civicrm Proximity.
 */

/**
 * Menu callback for admin settings.
 */
function civicrm_proximity_admin_configure() {
  $form['civicrm_proximity_geoloc_apikey'] = [
    '#type' => 'textfield',
    '#title' => t('Google Maps API Key'),
    '#description' => t('The Google Maps API, which include geolocation services, requires either a Google API Key. Obtain a Google Maps API key <a href="!url">here</a>.', [
      '!url' => url('https://developers.google.com/maps/documentation/javascript/get-api-key'),
    ]),
    '#default_value' => variable_get('civicrm_proximity_geoloc_apikey', ''),
    '#required' => TRUE,
  ];
  return system_settings_form($form);
}
