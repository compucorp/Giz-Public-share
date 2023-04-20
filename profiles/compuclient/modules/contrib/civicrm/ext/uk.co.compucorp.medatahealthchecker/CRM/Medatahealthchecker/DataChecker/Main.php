<?php

use CRM_Medatahealthchecker_DataChecker_ErrorCodes as ErrorCodes;

class CRM_Medatahealthchecker_DataChecker_Main {

  public function validateData() {
    $this->emptyDataIssuesTable();

    $this->checkContributionsPaidByDirectDebitButWithoutPaymentPlan();
    $this->checkMissingFinancialTransactionRecordsOnContributions();
    $this->checkMissingLineItemsOnContributions();
    $this->checkMissingFinancialItemRecordsOnLineItems();
    $this->checkContributionsWithMismatchedLineItemsAmount();
    $this->checkContributionsWithMismatchedLineItemsTax();
    $this->checkOfflinePaymentPlansWithNoRelatedMemberships();
    $this->checkOfflinePaymentPlansWithAutoRenewFlagNotTrue();
    $this->checkOfflinePaymentPlansWithNoSubscriptionLineItems();
    $this->checkDirectDebitPaymentPlansWithNoMandates();
    $this->checkDirectDebitContributionsWithNoMandates();
  }

  private function emptyDataIssuesTable() {
    $query = "TRUNCATE TABLE medatahealthchecker_issues_log";
    CRM_Core_DAO::executeQuery($query);
  }

  private function checkContributionsPaidByDirectDebitButWithoutPaymentPlan() {
    $ddPaymentMethodId = $this->getDirectDebitPaymentMethodId();

    $errorCode = ErrorCodes::DD_PAYMENT_METHOD_WITH_NO_PAYMENT_PLAN;

    $query = "INSERT INTO medatahealthchecker_issues_log
              (entity_id, entity_table, error_code, contact_id)
              SELECT id, 'civicrm_contribution', {$errorCode}, contact_id FROM civicrm_contribution
              WHERE payment_instrument_id = {$ddPaymentMethodId} AND contribution_recur_id IS NULL";
    CRM_Core_DAO::executeQuery($query);
  }

  private function checkMissingFinancialTransactionRecordsOnContributions() {
    $errorCode = ErrorCodes::MISSING_FINANCIAL_TRANSACTION_RECORDS_ON_CONTRIBUTION;

    $query = "INSERT INTO medatahealthchecker_issues_log
              (entity_id, entity_table, error_code, contact_id)
              SELECT cc.id, 'civicrm_contribution', {$errorCode}, cc.contact_id FROM civicrm_contribution cc
              LEFT JOIN civicrm_entity_financial_trxn eft ON cc.id = eft.entity_id AND eft.entity_table = 'civicrm_contribution'
              WHERE eft.id IS NULL OR eft.financial_trxn_id IS NULL
              GROUP BY cc.id";
    CRM_Core_DAO::executeQuery($query);
  }

  private function checkMissingLineItemsOnContributions() {
    $errorCode = ErrorCodes::MISSING_LINE_ITEMS_ON_CONTRIBUTION;

    $query = "INSERT INTO medatahealthchecker_issues_log
              (entity_id, entity_table, error_code, contact_id)
              SELECT cc.id, 'civicrm_contribution', {$errorCode}, cc.contact_id FROM civicrm_contribution cc
              LEFT JOIN civicrm_line_item cli ON cc.id = cli.contribution_id
              WHERE cli.id IS NULL
              GROUP BY cc.id";
    CRM_Core_DAO::executeQuery($query);
  }

  private function checkMissingFinancialItemRecordsOnLineItems() {
    $errorCode = ErrorCodes::MISSING_FINANCIAL_ITEM_RECORDS_ON_LINE_ITEM;

    $query = "INSERT INTO medatahealthchecker_issues_log
              (entity_id, entity_table, error_code, contact_id)
              SELECT cc.id, 'civicrm_contribution', {$errorCode}, cc.contact_id FROM civicrm_contribution cc
              INNER JOIN civicrm_line_item cli ON cc.id = cli.contribution_id
              LEFT JOIN civicrm_financial_item cfi ON cli.id = cfi.entity_id AND cfi.entity_table = 'civicrm_line_item'
              LEFT JOIN civicrm_entity_financial_trxn eft ON cfi.id = eft.entity_id AND eft.entity_table = 'civicrm_financial_item'
              WHERE cfi.id IS NULL OR eft.id IS NULL
              GROUP BY cc.id";
    CRM_Core_DAO::executeQuery($query);
  }

  private function checkContributionsWithMismatchedLineItemsAmount() {
    $errorCode = ErrorCodes::CONTRIBUTIONS_WITH_MISMATCHED_LINE_ITEMS_AMOUNT;

    $query = "INSERT INTO medatahealthchecker_issues_log
              (entity_id, entity_table, error_code, contact_id)
              SELECT id, 'civicrm_contribution', {$errorCode}, contact_id FROM (
              SELECT cc.id, cc.total_amount, (SUM(cli.line_total) + SUM(IFNULL(cli.tax_amount, 0))) as line_items_sum, cc.contact_id FROM civicrm_contribution cc
              INNER JOIN civicrm_line_item cli ON cc.id = cli.contribution_id
              group by cc.id
              ) as result_set WHERE result_set.total_amount != line_items_sum";
    CRM_Core_DAO::executeQuery($query);
  }

  private function checkContributionsWithMismatchedLineItemsTax() {
    $errorCode = ErrorCodes::CONTRIBUTIONS_WITH_MISMATCHED_LINE_ITEMS_TAX;

    $query = "INSERT INTO medatahealthchecker_issues_log
              (entity_id, entity_table, error_code, contact_id)
              SELECT id, 'civicrm_contribution', {$errorCode}, contact_id FROM (
              SELECT cc.id, IFNULL(cc.tax_amount, 0) as tax_amount, (SUM(IFNULL(cli.tax_amount, 0))) as line_items_tax_sum, cc.contact_id FROM civicrm_contribution cc
              INNER JOIN civicrm_line_item cli ON cc.id = cli.contribution_id
              group by cc.id
              ) as result_set WHERE result_set.tax_amount != result_set.line_items_tax_sum";
    CRM_Core_DAO::executeQuery($query);
  }

  private function checkOfflinePaymentPlansWithNoRelatedMemberships() {
    $errorCode = ErrorCodes::OFFLINE_PAYMENT_PLANS_WITH_NO_MEMBERSHIPS;

    $query = "INSERT INTO medatahealthchecker_issues_log
              (entity_id, entity_table, error_code, contact_id)
              SELECT ccr.id, 'civicrm_contribution_recur', {$errorCode}, ccr.contact_id FROM civicrm_contribution_recur ccr
              INNER JOIN civicrm_payment_processor cpp ON ccr.payment_processor_id = cpp.id AND cpp.class_name = 'Payment_Manual'
              INNER JOIN civicrm_contribution cc ON ccr.id = cc.contribution_recur_id
              LEFT JOIN civicrm_membership_payment cmp ON cc.id = cmp.contribution_id
              WHERE cmp.id IS NULL
              GROUP BY ccr.id";
    CRM_Core_DAO::executeQuery($query);
  }

  private function checkOfflinePaymentPlansWithAutoRenewFlagNotTrue() {
    $errorCode = ErrorCodes::OFFLINE_PAYMENT_PLANS_WITH_AUTORENEW_FLAG_FALSE;

    $query = "INSERT INTO medatahealthchecker_issues_log
              (entity_id, entity_table, error_code, contact_id)
              SELECT ccr.id, 'civicrm_contribution_recur', {$errorCode}, ccr.contact_id FROM civicrm_contribution_recur ccr
              INNER JOIN civicrm_payment_processor cpp ON ccr.payment_processor_id = cpp.id AND cpp.class_name = 'Payment_Manual'
              WHERE ccr.auto_renew = 0
              GROUP BY ccr.id";
    CRM_Core_DAO::executeQuery($query);
  }

  private function checkOfflinePaymentPlansWithNoSubscriptionLineItems() {
    $errorCode = ErrorCodes::OFFLINE_PAYMENT_PLANS_WITH_NO_SUBSCRIPTION_LINE_ITEMS;

    $query = "INSERT INTO medatahealthchecker_issues_log
              (entity_id, entity_table, error_code, contact_id)
              SELECT ccr.id, 'civicrm_contribution_recur', {$errorCode}, ccr.contact_id FROM civicrm_contribution_recur ccr
              INNER JOIN civicrm_payment_processor cpp ON ccr.payment_processor_id = cpp.id AND cpp.class_name = 'Payment_Manual'
              LEFT JOIN membershipextras_subscription_line msl ON ccr.id = msl.contribution_recur_id
              WHERE msl.id IS NULL OR msl.line_item_id IS NULL
              GROUP BY ccr.id";
    CRM_Core_DAO::executeQuery($query);
  }

  private function checkDirectDebitPaymentPlansWithNoMandates() {
    $ddPaymentProcessorId = $this->getDirectDebitPaymentProcessorId();

    $errorCode = ErrorCodes::DIRECT_DEBIT_PAYMENT_PLANS_WITH_NO_MANDATES;

    $query = "INSERT INTO medatahealthchecker_issues_log
              (entity_id, entity_table, error_code, contact_id)
              SELECT ccr.id, 'civicrm_contribution_recur', {$errorCode}, ccr.contact_id FROM civicrm_contribution_recur ccr
              LEFT JOIN dd_contribution_recurr_mandate_ref recur_mandate ON ccr.id = recur_mandate.recurr_id
              WHERE recur_mandate.id IS NULL AND ccr.payment_processor_id = {$ddPaymentProcessorId}
              GROUP BY ccr.id";
    CRM_Core_DAO::executeQuery($query);
  }

  private function checkDirectDebitContributionsWithNoMandates() {
    $ddPaymentMethod = $this->getDirectDebitPaymentMethodId();

    $errorCode = ErrorCodes::DIRECT_DEBIT_CONTRIBUTIONS_WITH_NO_MANDATES;

    $query = "INSERT INTO medatahealthchecker_issues_log
              (entity_id, entity_table, error_code, contact_id)
              SELECT cc.id, 'civicrm_contribution', {$errorCode}, cc.contact_id FROM civicrm_contribution cc
              LEFT JOIN civicrm_value_dd_information cc_mandate ON cc.id = cc_mandate.entity_id
              WHERE cc_mandate.mandate_id IS NULL AND cc.payment_instrument_id = {$ddPaymentMethod}
              GROUP BY cc.id";
    CRM_Core_DAO::executeQuery($query);
  }

  private function getDirectDebitPaymentMethodId() {
    $ddPaymentMethodId = civicrm_api3('OptionValue', 'get', [
      'sequential' => 1,
      'return' => ['value'],
      'option_group_id' => "payment_instrument",
      'name' => "direct_debit",
    ]);
    if (empty($ddPaymentMethodId['values'][0]['value'])) {
      return 'NULL';
    }

    return $ddPaymentMethodId['values'][0]['value'];
  }

  private function getDirectDebitPaymentProcessorId() {
    $ddPaymentProcessorId = civicrm_api3('PaymentProcessor', 'get', [
      'sequential' => 1,
      'return' => ['id'],
      'name' => 'Direct Debit',
      'is_test' => 0,
    ]);
    if (empty($ddPaymentProcessorId['values'][0]['id'])) {
      return 'NULL';
    }

    return $ddPaymentProcessorId['values'][0]['id'];
  }

}
