<?php

class CRM_Medatahealthchecker_DataChecker_ErrorCodes {

  const DD_PAYMENT_METHOD_WITH_NO_PAYMENT_PLAN = 100;

  const MISSING_FINANCIAL_TRANSACTION_RECORDS_ON_CONTRIBUTION = 200;

  const MISSING_LINE_ITEMS_ON_CONTRIBUTION = 300;

  const MISSING_FINANCIAL_ITEM_RECORDS_ON_LINE_ITEM = 400;

  const CONTRIBUTIONS_WITH_MISMATCHED_LINE_ITEMS_AMOUNT = 500;

  const CONTRIBUTIONS_WITH_MISMATCHED_LINE_ITEMS_TAX = 600;

  const OFFLINE_PAYMENT_PLANS_WITH_NO_MEMBERSHIPS = 700;

  const OFFLINE_PAYMENT_PLANS_WITH_AUTORENEW_FLAG_FALSE = 800;

  const OFFLINE_PAYMENT_PLANS_WITH_NO_SUBSCRIPTION_LINE_ITEMS = 900;

  const DIRECT_DEBIT_PAYMENT_PLANS_WITH_NO_MANDATES = 1000;

  const DIRECT_DEBIT_CONTRIBUTIONS_WITH_NO_MANDATES = 1100;

  public static function getAllCodesWithDescription() {
    return [
      self::DD_PAYMENT_METHOD_WITH_NO_PAYMENT_PLAN => 'Contributions paid with Direct Debit but with no related Payment Plan',
      self::MISSING_FINANCIAL_TRANSACTION_RECORDS_ON_CONTRIBUTION => 'Missing financial transaction records on contributions',
      self::MISSING_LINE_ITEMS_ON_CONTRIBUTION => 'Missing line items on contributions',
      self::MISSING_FINANCIAL_ITEM_RECORDS_ON_LINE_ITEM => 'Missing financial items on line items',
      self::CONTRIBUTIONS_WITH_MISMATCHED_LINE_ITEMS_AMOUNT => 'Contributions with mismatched line items amount',
      self::CONTRIBUTIONS_WITH_MISMATCHED_LINE_ITEMS_TAX => 'Contributions with mismatched line items tax amount',
      self::OFFLINE_PAYMENT_PLANS_WITH_NO_MEMBERSHIPS => 'Offline payment plans but with no related memberships',
      self::OFFLINE_PAYMENT_PLANS_WITH_AUTORENEW_FLAG_FALSE => 'Offline payment plans but with auto-renew flag set to False',
      self::OFFLINE_PAYMENT_PLANS_WITH_NO_SUBSCRIPTION_LINE_ITEMS => 'Offline payment plans but without any subscription line items',
      self::DIRECT_DEBIT_PAYMENT_PLANS_WITH_NO_MANDATES => 'Direct debit payment plans but with no related mandate',
      self::DIRECT_DEBIT_CONTRIBUTIONS_WITH_NO_MANDATES => 'Direct debit contributions but with no related mandate',
    ];
  }

}
