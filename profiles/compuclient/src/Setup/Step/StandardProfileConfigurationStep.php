<?php

namespace Drupal\compuclient\Setup\Step;

/**
 * Profile configuration step.
 */
class StandardProfileConfigurationStep implements StepInterface {

  /**
   * Configure Drupal with all the steps from the standard Drupal profile.
   */
  public function apply() {
    $this->setAdminTheme();
    $this->setDrupalFileScheme();
    $filteredHtmlFormat = $this->createFilteredHtmlFormat();
    $filteredHtmlPerm = filter_permission_name($filteredHtmlFormat);
    $this->createFullHtmlFormat();
    $this->createStandardBlocks();
    $this->createDefaultNodeTypes();
    $this->createRdfMappings();
    $this->configureBasicPage();
    $this->configureUserPicture();
    $this->configureAccountCreation();
    $this->createDefaultTaxonomy();
    $this->createImageField();
    $adminRole = $this->createAdminRole();
    $this->grantDefaultPermissions($filteredHtmlPerm, $adminRole);
    $this->addHomeMenuLink();
    $this->configureWebform();
    $this->configureHoneypot();
    $this->configureAdvuserModuleWeight();
  }

  /**
   * Create 'Filtered HTML' text format.
   *
   * @return object
   *   Filtered HTML format settings.
   */
  protected function createFilteredHtmlFormat() {
    $filteredHtmlFormat = [
      'format' => 'filtered_html',
      'name' => 'Filtered HTML',
      'weight' => 0,
      'filters' => [
        // URL filter.
        'filter_url' => [
          'weight' => 0,
          'status' => 1,
        ],
        // HTML filter.
        'filter_html' => [
          'weight' => 1,
          'status' => 1,
        ],
        // Line break filter.
        'filter_autop' => [
          'weight' => 2,
          'status' => 1,
        ],
        // HTML corrector filter.
        'filter_htmlcorrector' => [
          'weight' => 10,
          'status' => 1,
        ],
      ],
    ];
    $filteredHtmlFormat = (object) $filteredHtmlFormat;
    filter_format_save($filteredHtmlFormat);

    return $filteredHtmlFormat;
  }

  /**
   * Create 'Full HTML' text format.
   */
  protected function createFullHtmlFormat() {
    $fullHtmlFormat = [
      'format' => 'full_html',
      'name' => 'Full HTML',
      'weight' => 1,
      'filters' => [
        // URL filter.
        'filter_url' => [
          'weight' => 0,
          'status' => 1,
        ],
        // Line break filter.
        'filter_autop' => [
          'weight' => 1,
          'status' => 1,
        ],
        // HTML corrector filter.
        'filter_htmlcorrector' => [
          'weight' => 10,
          'status' => 1,
        ],
      ],
    ];
    $fullHtmlFormat = (object) $fullHtmlFormat;
    filter_format_save($fullHtmlFormat);
  }

  /**
   * Enable some standard blocks.
   */
  protected function createStandardBlocks() {
    $defaultTheme = variable_get('theme_default', 'bartik');
    $adminTheme = variable_get('admin_theme', 'seven');
    $blocks = [
      [
        'module' => 'system',
        'delta' => 'main',
        'theme' => $defaultTheme,
        'status' => 1,
        'weight' => 0,
        'region' => 'content',
        'pages' => '',
        'cache' => -1,
      ],
      [
        'module' => 'search',
        'delta' => 'form',
        'theme' => $defaultTheme,
        'status' => 1,
        'weight' => -1,
        'region' => 'sidebar_first',
        'pages' => '',
        'cache' => -1,
      ],
      [
        'module' => 'node',
        'delta' => 'recent',
        'theme' => $adminTheme,
        'status' => 1,
        'weight' => 10,
        'region' => 'dashboard_main',
        'pages' => '',
        'cache' => -1,
      ],
      [
        'module' => 'system',
        'delta' => 'navigation',
        'theme' => $defaultTheme,
        'status' => 1,
        'weight' => 0,
        'region' => 'sidebar_first',
        'pages' => '',
        'cache' => -1,
      ],
      [
        'module' => 'system',
        'delta' => 'powered-by',
        'theme' => $defaultTheme,
        'status' => 1,
        'weight' => 10,
        'region' => 'footer',
        'pages' => '',
        'cache' => -1,
      ],
      [
        'module' => 'system',
        'delta' => 'help',
        'theme' => $defaultTheme,
        'status' => 1,
        'weight' => 0,
        'region' => 'help',
        'pages' => '',
        'cache' => -1,
      ],
      [
        'module' => 'system',
        'delta' => 'main',
        'theme' => $adminTheme,
        'status' => 1,
        'weight' => 0,
        'region' => 'content',
        'pages' => '',
        'cache' => -1,
      ],
      [
        'module' => 'system',
        'delta' => 'help',
        'theme' => $adminTheme,
        'status' => 1,
        'weight' => 0,
        'region' => 'help',
        'pages' => '',
        'cache' => -1,
      ],
      [
        'module' => 'user',
        'delta' => 'new',
        'theme' => $adminTheme,
        'status' => 1,
        'weight' => 0,
        'region' => 'dashboard_sidebar',
        'pages' => '',
        'cache' => -1,
      ],
      [
        'module' => 'search',
        'delta' => 'form',
        'theme' => $adminTheme,
        'status' => 1,
        'weight' => -10,
        'region' => 'dashboard_sidebar',
        'pages' => '',
        'cache' => -1,
      ],
    ];

    $fields = [
      'module',
      'delta',
      'theme',
      'status',
      'weight',
      'region',
      'pages',
      'cache',
    ];

    foreach ($blocks as $block) {
      // Check if block exists first.
      $result = db_select('block', 'b')
        ->fields('b')
        ->condition('module', $block['module'])
        ->condition('delta', $block['delta'])
        ->condition('theme', $block['theme'])
        ->execute()
        ->fetchAssoc();

      if (empty($result['bid'])) {
        db_insert('block')
          ->fields($fields)
          ->values($block)
          ->execute();
      }
    }
  }

  /**
   * Insert default pre-defined node types into the database.
   */
  protected function createDefaultNodeTypes() {
    $types = [
      [
        'type' => 'page',
        'name' => st('Basic page'),
        'base' => 'node_content',
        'description' => st("Use <em>basic pages</em> for your static content, such as an 'About us' page."),
        'custom' => 1,
        'modified' => 1,
        'locked' => 0,
      ],
      [
        'type' => 'article',
        'name' => st('Article'),
        'base' => 'node_content',
        'description' => st('Use <em>articles</em> for time-sensitive content like news, press releases or blog posts.'),
        'custom' => 1,
        'modified' => 1,
        'locked' => 0,
      ],
    ];

    foreach ($types as $type) {
      $type = node_type_set_defaults($type);
      node_type_save($type);
      node_add_body_field($type);
    }
  }

  /**
   * Insert default pre-defined RDF mapping into the database.
   */
  protected function createRdfMappings() {
    $rdfMappings = [
      [
        'type' => 'node',
        'bundle' => 'page',
        'mapping' => [
          'rdftype' => ['foaf:Document'],
        ],
      ],
      [
        'type' => 'node',
        'bundle' => 'article',
        'mapping' => [
          'field_image' => [
            'predicates' => ['og:image', 'rdfs:seeAlso'],
            'type' => 'rel',
          ],
          'field_tags' => [
            'predicates' => ['dc:subject'],
            'type' => 'rel',
          ],
        ],
      ],
    ];

    foreach ($rdfMappings as $rdf_mapping) {
      rdf_mapping_save($rdf_mapping);
    }
  }

  /**
   * Create a default vocabulary 'Tags', enabled for the 'article' node type.
   */
  protected function createDefaultTaxonomy() {
    $description = st('Use tags to group articles on similar topics into categories.');
    $vocabulary = (object) [
      'name' => st('Tags'),
      'description' => $description,
      'machine_name' => 'tags',
    ];
    taxonomy_vocabulary_save($vocabulary);

    $field = [
      'field_name' => 'field_' . $vocabulary->machine_name,
      'type' => 'taxonomy_term_reference',
      // Set cardinality to unlimited for tagging.
      'cardinality' => FIELD_CARDINALITY_UNLIMITED,
      'settings' => [
        'allowed_values' => [
          [
            'vocabulary' => $vocabulary->machine_name,
            'parent' => 0,
          ],
        ],
      ],
    ];
    field_create_field($field);

    $help = st('Enter a comma-separated list of words to describe your content.');
    $instance = [
      'field_name' => 'field_' . $vocabulary->machine_name,
      'entity_type' => 'node',
      'label' => 'Tags',
      'bundle' => 'article',
      'description' => $help,
      'widget' => [
        'type' => 'taxonomy_autocomplete',
        'weight' => -4,
      ],
      'display' => [
        'default' => [
          'type' => 'taxonomy_term_reference_link',
          'weight' => 10,
        ],
        'teaser' => [
          'type' => 'taxonomy_term_reference_link',
          'weight' => 10,
        ],
      ],
    ];
    field_create_instance($instance);
  }

  /**
   * Enable user picture and set the default to a square thumbnail option.
   */
  protected function configureUserPicture() {
    variable_set('user_pictures', '1');
    variable_set('user_picture_dimensions', '1024x1024');
    variable_set('user_picture_file_size', '800');
    variable_set('user_picture_style', 'thumbnail');
  }

  /**
   * Default "Basic page" to not be promoted and have comments disabled.
   */
  protected function configureBasicPage() {
    variable_set('node_options_page', ['status']);
    variable_set('comment_page', COMMENT_NODE_HIDDEN);
    variable_set('node_submitted_page', FALSE);
  }

  /**
   * Allow visitor account creation with administrative approval.
   */
  protected function configureAccountCreation() {
    variable_set('user_register', USER_REGISTER_VISITORS_ADMINISTRATIVE_APPROVAL);
  }

  /**
   * Create an image field named 'Image', enabled for the 'article' node type.
   */
  protected function createImageField() {
    $field = [
      'field_name' => 'field_image',
      'type' => 'image',
      'cardinality' => 1,
      'locked' => FALSE,
      'indexes' => ['fid' => ['fid']],
      'settings' => [
        'uri_scheme' => 'public',
        'default_image' => FALSE,
      ],
      'storage' => [
        'type' => 'field_sql_storage',
        'settings' => [],
      ],
    ];
    field_create_field($field);

    $instance = [
      'field_name' => 'field_image',
      'entity_type' => 'node',
      'label' => 'Image',
      'bundle' => 'article',
      'description' => st('Upload an image to go with this article.'),
      'required' => FALSE,

      'settings' => [
        'file_directory' => 'field/image',
        'file_extensions' => 'png gif jpg jpeg',
        'max_filesize' => '',
        'max_resolution' => '',
        'min_resolution' => '',
        'alt_field' => TRUE,
        'title_field' => '',
      ],

      'widget' => [
        'type' => 'image_image',
        'settings' => [
          'progress_indicator' => 'throbber',
          'preview_image_style' => 'thumbnail',
        ],
        'weight' => -1,
      ],

      'display' => [
        'default' => [
          'label' => 'hidden',
          'type' => 'image',
          'settings' => ['image_style' => 'large', 'image_link' => ''],
          'weight' => -1,
        ],
        'teaser' => [
          'label' => 'hidden',
          'type' => 'image',
          'settings' => ['image_style' => 'medium', 'image_link' => 'content'],
          'weight' => -1,
        ],
      ],
    ];
    field_create_instance($instance);
  }

  /**
   * Enable default permissions for system roles.
   *
   * @param string $filteredHtmlPerm
   *   The 'use text format filtered_html' permission name.
   * @param object $adminRole
   *   Administrator role object.
   */
  protected function grantDefaultPermissions($filteredHtmlPerm, $adminRole) {
    $anonymousPerms = ['access content', 'access comments', $filteredHtmlPerm];
    $authenticatedPerms = [
      'access content',
      'access comments',
      'post comments',
      'skip comment approval',
      $filteredHtmlPerm,
    ];
    $adminPerms = array_keys(module_invoke_all('permission'));

    user_role_grant_permissions(DRUPAL_ANONYMOUS_RID, $anonymousPerms);
    user_role_grant_permissions(DRUPAL_AUTHENTICATED_RID, $authenticatedPerms);
    user_role_grant_permissions($adminRole->rid, $adminPerms);
  }

  /**
   * Create a default role for site administrators.
   *
   * @return object
   *   Administrator role object.
   */
  protected function createAdminRole() {
    $adminRole = new \stdClass();
    $adminRole->name = 'administrator';
    $adminRole->weight = 2;
    user_role_save($adminRole);

    // Set this as the administrator role.
    variable_set('user_admin_role', $adminRole->rid);

    // Assign user 1 the "administrator" role.
    db_insert('users_roles')
      ->fields(['uid' => 1, 'rid' => $adminRole->rid])
      ->execute();

    return $adminRole;
  }

  /**
   * Create a Home link in the main menu.
   */
  protected function addHomeMenuLink() {
    $item = [
      'link_title' => st('Home'),
      'link_path' => '<front>',
      'menu_name' => 'main-menu',
    ];
    menu_link_save($item);

    // Update the menu router information.
    menu_rebuild();
  }

  /**
   * Enable the admin theme.
   */
  protected function setAdminTheme() {
    db_update('system')
      ->fields(['status' => 1])
      ->condition('type', 'theme')
      ->condition('name', 'seven')
      ->execute();
    variable_set('admin_theme', 'seven');
    variable_set('node_admin_theme', '1');
  }

  /**
   * Configure webform.
   */
  protected function configureWebform() {
    variable_set('node_submitted_webform', 0);
  }

  /**
   * Configure honeypot module.
   */
  protected function configureHoneypot() {
    // The honeypot module generates small css file to hide it's field from form
    // and this file is saved to sites/default/files folder.
    // But url to that file is generated using drupal default file scheme, which
    // is 'private'. As a result css file is not loaded and field is visible
    // on the form.
    // To workaround that honeypot module provides a variable to specify file
    // scheme for css file - we just need to set it 'public'.
    variable_set('honeypot_file_default_scheme', 'public');

    // Enable honeypot configuration for user registration form,
    // user password reset form and all webforms.
    variable_set('honeypot_form_user_register_form', 1);
    variable_set('honeypot_form_user_pass', 1);
    variable_set('honeypot_form_webforms', 1);

    // Set honeypot time limit to 2 seconds to prevent 'Please wait and retry'
    // error: https://www.drupal.org/project/webform/issues/2906236
    variable_set('honeypot_time_limit', 2);
  }

  /**
   * Configure default file scheme for Drupal.
   */
  protected function setDrupalFileScheme() {
    variable_set('file_default_scheme', 'private');
  }

  /**
   * Update Advanced User Management module weight.
   */
  protected function configureAdvuserModuleWeight() {
    // Update Advanced User Management module weight so that it can
    // load after User module is loaded as Advuser module has user
    // entity tokens that tries to load before User module tokens
    // are loaded which causes issues with tokens getting missed
    // when we execute Flush All Cache from Drupal Admin menu.
    // We can refer that under Status report which has all the
    // missing tokens reported after Flush All Cache.
    db_update('system')
      ->fields(array('weight' => 1))
      ->condition('name', 'advuser')
      ->execute();
  }

}
