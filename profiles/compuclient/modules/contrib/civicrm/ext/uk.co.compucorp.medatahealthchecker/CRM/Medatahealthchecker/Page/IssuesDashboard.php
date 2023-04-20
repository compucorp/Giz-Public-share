<?php
use CRM_Medatahealthchecker_DataChecker_ErrorCodes as ErrorCodes;

class CRM_Medatahealthchecker_Page_IssuesDashboard extends CRM_Core_Page {

  public function run() {
    $this->setIssuesForEachCategory();
    parent::run();
  }

  private function setIssuesForEachCategory() {
    $issues = [];
    $issuesCategories = ErrorCodes::getAllCodesWithDescription();
    foreach ($issuesCategories as $errorCode => $description) {
      $query = "SELECT count(*) FROM medatahealthchecker_issues_log WHERE error_code = {$errorCode}";
      $issuesCount = CRM_Core_DAO::singleValueQuery($query);

      if (!empty($issuesCount)) {
        $issues[] = ['issues_count' => $issuesCount, 'description' => $description, 'error_code' => $errorCode];
      }
    }

    $this->assign('issuesCategories', $issues);
  }

}
