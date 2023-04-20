<?php

/**
 * @file
 * Define views filter and field.
 */

/**
 * Implements hook_views_data_alter().
 */
function civicrm_proximity_views_data_alter(&$data) {
  $data['civicrm_address']['circle'] = [
    'title' => t('Circular search'),
    'help' => t('Uses the great-circle distance formula to return locations within a circular area.'),
    'filter' => [
      'handler' => 'civicrm_proximity_handler_filter_circle',
    ],
  ];

  $data['civicrm_address']['distance'] = [
    'title' => t('Distance'),
    'help' => t('Search radius for addresses in results'),
    'field' => [
      'handler' => 'civicrm_proximity_handler_field',
      'click sortable' => TRUE,
    ],
  ];

  return $data;
}
