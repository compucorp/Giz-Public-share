<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 5                                                  |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2018                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
 */

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2018
 */
class CRM_MembershipLogs_Page_Logs extends CRM_Core_Page {

  /**
   * called when action is browse.
   *
   */
  public function browse() {
    $memId = CRM_Utils_Type::escape($_GET['mid'], 'Integer');
    $logs = self::getLogs($memId);
    $this->assign('logs', $logs);
  }

  /**
   * Perform actions and display for activities.
   */
  public function run() {
    $this->browse();
    return parent::run();
  }

  /**
   * Get logs of the mebership.
   *
   * @param int $memId
   *
   * @return array
   */
  public static function getLogs($memId) {
    if (empty($memId)) {
      return [];
    }
    $logs = civicrm_api3('MembershipLog', 'get', [
      'return' => [
        'end_date',
        'modified_date',
        'start_date',
        'modified_id.sort_name',
        'status_id.label',
        'membership_type_id.name',
        'modified_id',
        'max_related',
      ],
      'membership_id' => $memId,
      'options' => ['limit' => 0],
    ])['values'];

    foreach ($logs as &$log) {
      $log['sort_name'] = $log['modified_id.sort_name'];
      $log['membership_type'] = $log['membership_type_id.name'];
      $log['status'] = $log['status_id.label'];
    }
    return $logs;
  }

}
