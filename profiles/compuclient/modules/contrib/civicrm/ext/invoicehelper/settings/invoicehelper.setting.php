<?php

use CRM_Invoicehelper_ExtensionUtil as E;

return [
  'invoicehelper_cc_membership_offline_receipt' => [
    'name' => 'invoicehelper_cc_membership_offline_receipt',
    'type' => 'String',
    'default' => null,
    'html_type' => 'text',
    'add' => '1.0',
    'title' => E::ts('CC offline membership receipts'),
    'is_domain' => 1,
    'is_contact' => 0,
    'settings_pages' => [
      'invoicehelper' => [
        'weight' => 10,
      ]
    ],
  ],
  'invoicehelper_bcc_membership_offline_receipt' => [
    'name' => 'invoicehelper_bcc_membership_offline_receipt',
    'type' => 'String',
    'default' => null,
    'html_type' => 'text',
    'add' => '1.0',
    'title' => E::ts('BCC offline membership receipts'),
    'is_domain' => 1,
    'is_contact' => 0,
    // 'description' => '',
    'settings_pages' => [
      'invoicehelper' => [
        'weight' => 10,
      ]
    ],
  ],
  'invoicehelper_alwayssend_membership_offline_receipt' => [
    'name' => 'invoicehelper_alwayssend_membership_offline_receipt',
    'default' => 0,
    'html_type' => 'select',
    'add' => '1.0',
    'title' => E::ts('Send membership receipts by default?'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => E::ts('If yes, the "Send Confirmation and Receipt?" checkbox will be checked by default.'),
    'options' => [
      0 => E::ts('No'),
      1 => E::ts('Yes'),
    ],
    'settings_pages' => [
      'invoicehelper' => [
        'weight' => 10,
      ]
    ],
  ],
  'invoicehelper_cc_contribution_offline_receipt' => [
    'name' => 'invoicehelper_cc_contribution_offline_receipt',
    'type' => 'String',
    'default' => null,
    'html_type' => 'text',
    'add' => '1.0',
    'title' => E::ts('CC offline contribution receipts'),
    'is_domain' => 1,
    'is_contact' => 0,
    // 'description' => '',
    'settings_pages' => [
      'invoicehelper' => [
        'weight' => 10,
      ]
    ],
  ],
  'invoicehelper_bcc_contribution_offline_receipt' => [
    'name' => 'invoicehelper_bcc_contribution_offline_receipt',
    'type' => 'String',
    'default' => null,
    'html_type' => 'text',
    'add' => '1.0',
    'title' => E::ts('BCC offline contribution receipts'),
    'is_domain' => 1,
    'is_contact' => 0,
    'settings_pages' => [
      'invoicehelper' => [
        'weight' => 10,
      ]
    ],
  ],
  'invoicehelper_alwayssend_contribution_offline_receipt' => [
    'name' => 'invoicehelper_alwayssend_contribution_offline_receipt',
    'default' => null,
    'html_type' => 'select',
    'add' => '1.0',
    'title' => E::ts('Send contribution receipts by default?'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => E::ts('If yes, the "Send Confirmation and Receipt?" checkbox will be checked by default.'),
    'options' => [
      0 => E::ts('No'),
      1 => E::ts('Yes'),
    ],
    'settings_pages' => [
      'invoicehelper' => [
        'weight' => 10,
      ]
    ],
  ],
  'invoicehelper_cc_contribution_invoice_receipt' => [
    'name' => 'invoicehelper_cc_contribution_invoice_receipt',
    'type' => 'String',
    'default' => null,
    'html_type' => 'text',
    'add' => '1.0',
    'title' => E::ts('CC contribution invoice receipts'),
    'is_domain' => 1,
    'is_contact' => 0,
    'settings_pages' => [
      'invoicehelper' => [
        'weight' => 10,
      ]
    ],
  ],
  'invoicehelper_bcc_contribution_invoice_receipt' => [
    'name' => 'invoicehelper_bcc_contribution_invoice_receipt',
    'type' => 'String',
    'default' => null,
    'html_type' => 'text',
    'add' => '1.0',
    'title' => E::ts('BCC contribution invoice receipts'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => E::ts('You can enter multiple emails separated by a comma.'),
    'settings_pages' => [
      'invoicehelper' => [
        'weight' => 10,
      ]
    ],
  ],
];
