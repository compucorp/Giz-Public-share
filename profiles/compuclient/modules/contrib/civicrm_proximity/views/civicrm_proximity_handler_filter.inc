<?php

/**
 * Base filter handler for Circular field.
 */
class civicrm_proximity_handler_filter extends views_handler_filter_numeric {

  /**
   * Exposed filter options.
   *
   * @var bool
   */
  public $no_single = FALSE;

  /**
   * {@inheritdoc}
   */
  public function op_between($field) {
    $this->op_process('between', $field);
  }

  /**
   * {@inheritdoc}
   */
  public function op_simple($field) {
    $this->op_process('simple', $field);
  }

  /**
   * Process operator.
   */
  public function op_process($op = 'simple', $field = NULL) {
    $this->secure_input();
    $this->process_location_proximity();
  }

  /**
   * Display the filter on the administrative summary.
   *
   * @see views_handler_filter_numeric::admin_summary()
   */
  public function admin_summary() {
    if (!empty($this->options['exposed'])) {
      return t('exposed');
    }

    $options = $this->operator_options('short');
    $output = check_plain($options[$this->operator]);

    if (in_array($this->operator, $this->operator_values(2))) {
      $output .= ' ' . t('@min and @max @unit from @location', [
        '@min' => $this->value['min'],
        '@max' => $this->value['max'],
        '@unit' => $this->value['unit'],
        '@location' => $this->value['location'],
      ]);
    }
    elseif (in_array($this->operator, $this->operator_values(1))) {
      $output .= ' ' . t('@value @unit from @location', [
        '@value' => $this->value['value'],
        '@unit' => $this->value['unit'],
        '@location' => $this->value['location'],
      ]);
    }

    return $output;
  }

  /**
   * Overwrite of views_handler_filter::options_defintion().
   */
  public function option_definition() {
    $options = parent::option_definition();
    $options['operator'] = ['default' => '<'];

    $unit = variable_get('civicrm_proximity_unit', CIVICRM_PROXIMITY_DEFAULT_UNIT);

    $options['value']['contains']['unit'] = ['default' => $unit];
    $options['value']['contains']['location'] = ['default' => ''];

    $options['expose']['contains']['use_unit'] = ['default' => FALSE];
    $options['expose']['contains']['unit'] = ['default' => 'unit'];
    $options['expose']['contains']['location'] = ['default' => 'location'];

    return $options;
  }

  /**
   * Provide default options for exposed filters.
   *
   * @see views_handler_filter::expose_options()
   */
  public function expose_options() {
    parent::expose_options();

    $this->options['expose']['use_unit'] = FALSE;
    $this->options['expose']['unit'] = 'unit';
    $this->options['expose']['location'] = 'location';
  }

  /**
   * Handle the "left" side of the exposed options form.
   *
   * @see views_handler_filter::expose_form()
   */
  public function expose_form(&$form, &$form_state) {
    parent::expose_form($form, $form_state);

    $this->expose_option_form($form, 'unit', 'unit of measurement');
    $this->expose_option_form($form, 'location', 'location');
  }

  /**
   * Provide a simple textfield for equality.
   *
   * @see views_handler_filter_numeric::value_form()
   */
  public function value_form(&$form, &$form_state) {
    parent::value_form($form, $form_state);

    drupal_add_css(drupal_get_path('module', 'civicrm_proximity') . '/civicrm_proximity.css');

    $form['value']['operator'] = [
      '#attributes' => [
        'class' => ['civicrm-proximity civicrm-proximity-operator'],
      ],
    ];

    $form['value']['unit'] = [
      '#title' => t('Unit of measurement'),
      '#type' => 'select',
      '#options' => civicrm_proximity_get_available_units_for_select(),
      '#default_value' => $this->options['value']['unit'],
      '#description' => t('Select unit of measurement.'),
      '#attributes' => [
        'class' => ['civicrm-proximity civicrm-proximity-unit'],
      ],
    ];

    $form['value']['location'] = [
      '#title' => t('from Location'),
      '#type' => 'textfield',
      '#size' => 20,
      '#default_value' => $this->options['value']['location'],
      '#description' => t('Where to start the search. This can be an address, city or postcode. If searching in London, try "London N1" instead of "N1".'),
      '#attributes' => [
        'class' => ['civicrm-proximity civicrm-proximity-location'],
      ],
    ];
  }

  /**
   * Provide a form for setting the operator.
   *
   * @see views_handler_filter::operator_form()
   */
  public function operator_form(&$form, &$form_state) {
    parent::operator_form($form, $form_state);

    // At the end of the day proximity search is a rough estimation.
    $unset = ['<=', '=', '!=', '>='];
    $this->unset_attributes($form['operator']['#options'], $unset);
  }

  /**
   * Render our chunk of the exposed filter form when selecting.
   *
   * @see views_handler_filter::exposed_form()
   */
  public function exposed_form(&$form, &$form_state) {
    if (empty($this->options['exposed'])) {
      return;
    }

    $force_operator = FALSE;
    $operators = $this->operator_options();

    if (empty($this->options['expose']['use_operator'])) {
      $this->options['expose']['use_operator'] = TRUE;
      $force_operator = TRUE;
    }

    parent::exposed_form($form, $form_state);

    if ($force_operator) {
      $operator = $this->options['expose']['operator'];

      $form[$operator]['#type'] = 'hidden';
      $op = $form[$operator]['#value'] = $form[$operator]['#default_value'];

      if (strstr($op, 'between')) {
        unset($form[$this->options['expose']['identifier']]['value']);
      }
      else {
        unset($form[$this->options['expose']['identifier']]['min']);
        unset($form[$this->options['expose']['identifier']]['max']);
      }

      $this->unset_attributes($form[$operator], ['#options']);
    }

    // When exposed pull location and unit out of value form item.
    if (!empty($this->options['expose']['identifier'])) {
      // Unset useless form elements.
      $identifier = &$form[$this->options['expose']['identifier']];

      // Expose unit of measurement form, if necessary.
      if ($this->filter_item_is_exposed('unit')) {
        $name = $this->rename_exposed_filter_item($form, 'unit');
        $this->clean_exposed_filter_item($identifier[$name]);
      }
      else {
        $this->unset_attributes($identifier, ['unit']);
      }

      // Expose location form, if necessary.
      $location = $this->options['value']['location'];

      if ($this->filter_item_is_exposed($location)) {
        $location = $this->rename_exposed_filter_item($form, $location);
        $this->clean_exposed_filter_item($identifier[$location]);

        $identifier[$location]['#weight'] = 100;
        $identifier[$location]['#field_prefix'] = t('from');
      }
      else {
        $this->unset_attributes($identifier, [$location]);

        if ($this->filter_item_is_exposed('unit')) {
          $suffix = $this->get_suffix();
          $unit_val = '<div class=" form-item">' . $suffix . '</div>';
        }
        else {
          $unit_val = '';
        }

        $identifier[$location]['#value'] = $unit_val;
      }

      // Remove "Regex" sort option.
      $op = $this->options['expose']['operator'];
      if (isset($form[$op]['#options']['regular_expression'])) {
        unset($form[$op]['#options']['regular_expression']);
      }

      // Add meaningful suffix to value.
      if (isset($identifier['value'])) {
        if ($force_operator) {
          $field_prefix = $operators[$this->options['operator']];
        }
        else {
          $field_prefix = '';
        }

        $identifier['value']['#size'] = 3;
        $identifier['value']['#field_prefix'] = $field_prefix;
        $identifier['value']['#field_suffix'] = $this->get_suffix();

      }

      // Add meaningful prefix/suffix to min max.
      if (isset($identifier['min']) && isset($filter['max'])) {
        $identifier['min']['#size'] = 3;
        $identifier['min']['#field_prefix'] = $force_operator ? $operators[$this->options['operator']] : '';

        $identifier['max']['#size'] = 3;
        $identifier['max']['#field_prefix'] = t('and');
        $identifier['max']['#field_suffix'] = $this->get_suffix();

        $this->unset_attributes($identifier['max'], ['#title', '#default_value']);
        $this->unset_attributes($identifier['min'], ['#default_value']);
      }
    }
  }

  /**
   * Validate the exposed filter form.
   */
  public function exposed_validate(&$form, &$form_state) {
    parent::exposed_validate($form, $form_state);

    // Sanitize "value", "min" and "max".
    $identifier = $this->options['expose']['identifier'];
    $operator = $this->options['expose']['operator'];
    $location = $this->options['expose']['location'];

    foreach (['value', 'min', 'max'] as $field) {
      if (isset($form_state['values'][$identifier][$field])) {
        $form_state['values'][$identifier][$field] = str_replace(',', '.', $form_state['values'][$identifier][$field]);
      }
    }

    $values = $form_state['values'];
    $op     = $values[$operator];

    // Validate "value", "min" and "max".
    $fields = ($op == 'between') ? ['min', 'max'] : ['value'];

    foreach ($fields as $key => $field) {
      if ($values[$identifier][$field]) {
        if (!is_numeric($values[$identifier][$field])) {
          form_set_error($identifier . '][' . $field, t('Please provide a valid numeric value.'));
        }
        elseif ($values[$identifier][$field] <= 0) {
          form_set_error($identifier . '][' . $field, t('Please provide a value greater than zero.'));
        }
        elseif ($key && $values[$identifier]['min'] >= $values[$identifier]['max']) {
          form_set_error($identifier . '][min', t('Please make sure that the first value is less than the second one.'));
        }
      }
    }

    // Validate location.
    if (!empty($values[$identifier]['location'])) {
      $response = civicrm_proximity_geocode($values[$identifier]['location']);
      if (!empty($response)) {
        $this->response = $response;
      }
      else {
        form_set_error($identifier . '][' . $location, t('Location not found; please try again.'));
      }
    }
  }

  /**
   * Distance from a location: query is a string and it will be geolocated.
   */
  public function process_location_proximity() {
    $this->value['lat'] = $this->value['lon'] = NULL;

    if ($this->response = civicrm_proximity_geocode($this->value['location'])) {
      $this->value['lat'] = $this->response[0]['location']['lat'];
      $this->value['lon'] = $this->response[0]['location']['lng'];
    }

    drupal_alter('process_location_proximity', $this->value);
  }

  /**
   * Clean the inputs.
   */
  public function secure_input() {
    $this->value['value'] = $this->value['value'] ?? $this->options['value']['value'];
    $this->value['min'] = $this->value['min'] ?? $this->options['value']['min'];
    $this->value['max'] = $this->value['max'] ?? $this->options['value']['max'];

    $this->value['location'] = $this->value[$this->options['expose']['location']] ?? $this->options['value']['location'];
    $this->value['unit'] = $this->value[$this->options['expose']['unit']] ?? $this->options['value']['unit'];
  }

  /**
   * Unset the attributes.
   *
   * @param array $item
   *   Item information.
   * @param array $attributes
   *   Attributes to be unsetted.
   */
  public function unset_attributes(array &$item, array $attributes) {
    foreach ($attributes as $name) {
      unset($item[$name]);
    }
  }

  /**
   * Clean the exposed filters.
   *
   * @param array $item
   *   Filters to be cleaned.
   */
  public function clean_exposed_filter_item(array &$item) {
    $this->unset_attributes($item, [
      '#prefix',
      '#suffix',
      '#title',
      '#description',
    ]);
  }

  /**
   * Expose option in the given form.
   *
   * @param array $form
   *   Form to be modified.
   * @param string $name
   *   Name of the option.
   * @param string $title
   *   Title of the option.
   */
  public function expose_option_form(array &$form, string $name, string $title) {
    $form['expose'][$name] = [
      '#type' => 'checkbox',
      '#title' => t('Unlock @title', ['@title' => $title]),
      '#default_value' => $this->options['expose'][$name],
      '#description' => t('When checked, this filter will be exposed to the user'),
    ];

    $form['expose'][$name] = [
      '#type' => 'textfield',
      '#default_value' => $this->options['expose'][$name],
      '#title' => t('@title identifier', ['@title' => $title]),
      '#size' => 40,
      '#description' => t('This will appear in the URL after the ? to identify this filter.'),
    ];
  }

  /**
   * Rename exposed filter item.
   *
   * @param array $form
   *   Form to be modified.
   * @param string $name
   *   Name of the filter.
   *
   * @return mixed
   *   Value of the filter.
   */
  public function rename_exposed_filter_item(array &$form, string $name) {
    $value = $this->options['expose'][$name];
    $identifier = $this->options['expose']['identifier'];

    if ($value != $name) {
      $form[$identifier][$value] = $form[$identifier][$name];
      $this->unset_attributes($form[$identifier], [$name]);
    }

    return $value;
  }

  /**
   * Indicates if the filter is exposed.
   *
   * @param string $name
   *   Name of the filter.
   *
   * @return bool
   *   Returns TRUE if the filter is exposed.
   */
  public function filter_item_is_exposed(string $name) {
    return !empty($this->options['expose'][$name]);
  }

  /**
   * Get the suffix.
   */
  public function get_suffix() {
    $suffix = '';
    $units = civicrm_proximity_get_available_units();

    // If unit is not exposed add unit string to suffix.
    if (!$this->filter_item_is_exposed('unit')) {
      $suffix = '@unit ' . $suffix;
    }

    // phpcs:ignore Drupal.Semantics.FunctionT.NotLiteralString
    return t($suffix, [
      '@unit' => $units[$this->options['value']['unit']]['long'],
      '@location' => $this->options['value']['location'],
    ]);
  }

}
