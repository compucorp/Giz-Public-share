<?php

namespace Drupal\compuclient\Setup\Step;

/**
 * CiviCRM Customise Data and Screen Configuration Step.
 */
class CiviCRMCustomiseDataAndScreensConfigurationStep implements StepInterface {

  /**
   * Applies configurations.
   */
  public function apply() {
    $this->configLocationTypes();
    $this->configPhoneTypes();
    $this->configSocialMediaTypes();
    $this->configWebsiteTypes();
    $this->configSearchPreferences();
    $this->configDisplayPreferences();
    $this->configContactTags();
    $this->configFrontTheme();
  }

  /**
   * Configures Location types.
   */
  private function configLocationTypes() {
    civicrm_api3('LocationType', 'get', [
      'sequential' => 1,
      'display_name' => 'Work',
      'api.LocationType.create' => ['is_default' => 1],
    ]);

    civicrm_api3('LocationType', 'create', [
      'name' => 'Personal',
      'description' => 'Personal Location',
    ]);
  }

  /**
   * Configures Phone Types.
   */
  private function configPhoneTypes() {
    civicrm_api3('OptionValue', 'get', [
      'sequential' => 1,
      'option_group_id' => 'phone_type',
      'label' => ['IN' => ['Fax', 'Pager', 'Voicemail', 'Phone']],
      'api.OptionValue.delete' => [],
    ]);

    civicrm_api3('OptionValue', 'create', [
      'option_group_id' => 'phone_type',
      'label' => 'Landline',
    ]);
  }

  /**
   * Configures Social Media Types.
   */
  private function configSocialMediaTypes() {
    civicrm_api3('OptionValue', 'get', [
      'sequential' => 1,
      'option_group_id' => "instant_messenger_service",
      'api.OptionValue.delete' => [],
    ]);

    $socialMediaTypes = ['LinkedIn', 'Instagram', 'Facebook', 'Twitter'];
    foreach ($socialMediaTypes as $socialMediaType) {
      civicrm_api3('OptionValue', 'create', [
        'option_group_id' => 'instant_messenger_service',
        'label' => $socialMediaType,
      ]);
    }
  }

  /**
   * Configs website types.
   */
  private function configWebsiteTypes() {
    civicrm_api3('OptionValue', 'get', [
      'sequential' => 1,
      'option_group_id' => 'website_type',
      'label' => ['<>' => 'Main'],
      'api.OptionValue.delete' => [],
    ]);
  }

  /**
   * Configures Search Preferences.
   */
  private function configSearchPreferences() {
    $settings = [
      'includeNickNameInName' => '1',
      'quicksearch_options' => [
        'sort_name',
        'contact_id',
        'external_identifier',
        'first_name',
        'last_name',
        'email',
        'phone_numeric',
        'street_address',
        'city',
        'postal_code',
        'job_title',
      ],
      'contact_autocomplete_options' => [
      // Contact Name.
        '1',
      // Email Address.
        '2',
      // Phone.
        '3',
      // Street Address.
        '4',
      // City.
        '5',
      // County.
        '6',
      // Country.
        '7',
      // Postal Code.
        '8',
      ],
    ];

    civicrm_api3('Setting', 'create', $settings);

  }

  /**
   * Configures Display Preferences.
   */
  private function configDisplayPreferences() {
    $settings = [
      'contact_view_options' => [
    // Activities.
        '1',
    // Relationships.
        '2',
    // Groups.
        '3',
    // Tags.
        '5',
    // Change Log.
        '6',
    // Contributions.
        '7',
    // Memberships.
        '8',
    // Events.
        '9',
    // Case.
        '10',
    // Maillings.
        '14',
      ],
      'contact_edit_options' => [
      // Custom Data.
        '1',
      // Address.
        '2',
      // Communication Preferences.
        '3',
      // Demographics.
        '5',
      // Tags and Groups.
        '6',
      // Email.
        '7',
      // Phone.
        '8',
      // Social Media.
        '9',
      // Website.
        '11',
      // Prefix.
        '12',
      // First Name.
        '14',
      // Middle Name.
        '15',
      // Last Name.
        '16',
      // Suffix.
        '17',
      ],
      'advanced_search_options' => [
      // Address Fields.
        '1',
      // Custom Fields.
        '2',
      // Activities.
        '3',
      // Relationships.
        '4',
      // Change Log.
        '6',
      // Contributions.
        '7',
      // Memberships.
        '8',
      // Events.
        '9',
      // Cases.
        '10',
      // Demographics.
        '13',
      // Contact Type.
        '16',
      // Groups.
        '17',
      // Tags.
        '18',
      // Mailing.
        '19',
      ],
    ];

    civicrm_api3('Setting', 'create', $settings);

  }

  /**
   * Configures default contact tags.
   */
  private function configContactTags() {
    civicrm_api3('Tag', 'create', [
      'name' => ts('Create Drupal Account'),
      'description' => ts('When applied, this tag will create a new user account for the selected contact, which will automatically send the contact an email with a one-time login link. Note, if they already have a user account no action will occur.'),
      'parent_id' => '',
      'used_for' => 'Contacts',
      'color' => 'CCCCCC',
      'is_reserved' => 1,
      'is_selectable' => 1,
    ]);
  }

  /**
   * Configures front theme.
   *
   * To stop the CiviCRM to leak extra CSS on the public pages
   * and make our theme to take full control of the styling of the pages,
   * we set theme_frontend to none.
   */
  private function configFrontTheme() {
    civicrm_api3('Setting', 'create', [
      'theme_frontend' => 'none',
    ]);
  }

}
