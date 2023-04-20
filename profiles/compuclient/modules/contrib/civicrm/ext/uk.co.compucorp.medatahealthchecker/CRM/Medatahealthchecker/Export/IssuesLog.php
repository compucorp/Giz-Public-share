<?php

class CRM_Medatahealthchecker_Export_IssuesLog {

  public static function export() {
    $errorCode = CRM_Utils_Request::retrieve('error_code', 'Integer');
    if (empty($errorCode)) {
      return;
    }

    $csvHeaders = [
      'entity_table',
      'entity_id',
      'contact_id',
      'created_at',
    ];

    $query = "SELECT entity_table, entity_id, contact_id, created_at FROM medatahealthchecker_issues_log WHERE error_code = %1";
    $dao = CRM_Core_DAO::executeQuery($query, [1 => [$errorCode, 'Integer']]);

    $csvRows = [];
    while ($dao->fetch()) {
      $csvRows[] = [$dao->entity_table, $dao->entity_id, $dao->contact_id, $dao->created_at];
    }

    CRM_Core_Report_Excel::writeCSVFile('ME_Health_Checker_Code_' . $errorCode, $csvHeaders, $csvRows);
    CRM_Utils_System::civiExit();
  }

}
