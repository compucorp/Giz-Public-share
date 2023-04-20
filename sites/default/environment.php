<?php

# Create shorthand function for getting Envrionent Variables and allow a default value
if (!function_exists('ge')) {
    function ge($v, $default = false)
    {
        if ($default) {
            return (getenv($v)) ? getenv($v) : $default;
        } else {
            return (getenv($v)) ? getenv($v) : die("Env var $v not defined.\n");
        }
    }
};

# Set variables from environment
$environment = ge("CC_ENV");
$site_url = ge("SITE_URL");
$site_name = ge("SITE_NAME");
$use_https = ge("USE_HTTPS");
$http_protocol = ($use_https == "True") ? 'https' : 'http';
$drupal_db_name = ge("DRUPAL_DB_NAME");
$drupal_db_user = ge("DRUPAL_DB_USER");
$drupal_db_pass = ge("DRUPAL_DB_PASS");
$drupal_db_host = ge("DRUPAL_DB_HOST");
$drupal_db_port = ge("DRUPAL_DB_PORT");
$drupal_hash_salt = ge("DRUPAL_HASH_SALT");
$civicrm_db_name = ge("CIVICRM_DB_NAME");
$civicrm_db_user = ge("CIVICRM_DB_USER");
$civicrm_db_pass = ge("CIVICRM_DB_PASS");
$civicrm_db_host = ge("CIVICRM_DB_HOST");
$civicrm_db_port = ge("CIVICRM_DB_PORT");
$civicrm_site_key = ge("CIVICRM_SITE_KEY");
# Settings for stripe civicrm extension. Remove if not installed
$stripe_live_pk = ge("STRIPE_LIVE_PK");
$stripe_live_sk = ge("STRIPE_LIVE_SK");
$stripe_test_pk = ge("STRIPE_TEST_PK");
$stripe_test_sk = ge("STRIPE_TEST_SK");
