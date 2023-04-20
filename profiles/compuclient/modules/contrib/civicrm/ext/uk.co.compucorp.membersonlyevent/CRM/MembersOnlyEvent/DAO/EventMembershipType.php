<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from uk.co.compucorp.membersonlyevent/xml/schema/CRM/MembersOnlyEvent/EventMembershipType.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:caab429c349c751cdb8500d03f39956f)
 */
use CRM_MembersOnlyEvent_ExtensionUtil as E;

/**
 * Database access object for the EventMembershipType entity.
 */
class CRM_MembersOnlyEvent_DAO_EventMembershipType extends CRM_Core_DAO {
  const EXT = E::LONG_NAME;
  const TABLE_ADDED = '4.4';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'membersonlyevent_event_membership_type';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = TRUE;

  /**
   * Members-only event ID.
   *
   * @var int
   */
  public $members_only_event_id;

  /**
   * Allowed Membership Type ID.
   *
   * @var int
   */
  public $membership_type_id;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'membersonlyevent_event_membership_type';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? E::ts('Event Membership Types') : E::ts('Event Membership Type');
  }

  /**
   * Returns foreign keys and entity references.
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  public static function getReferenceColumns() {
    if (!isset(Civi::$statics[__CLASS__]['links'])) {
      Civi::$statics[__CLASS__]['links'] = static::createReferenceColumns(__CLASS__);
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'members_only_event_id', 'membersonlyevent', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'membership_type_id', 'civicrm_membership_type', 'id');
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'links_callback', Civi::$statics[__CLASS__]['links']);
    }
    return Civi::$statics[__CLASS__]['links'];
  }

  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  public static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = [
        'members_only_event_id' => [
          'name' => 'members_only_event_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => E::ts('Members-only event ID'),
          'description' => E::ts('Members-only event ID.'),
          'required' => TRUE,
          'where' => 'membersonlyevent_event_membership_type.members_only_event_id',
          'table_name' => 'membersonlyevent_event_membership_type',
          'entity' => 'EventMembershipType',
          'bao' => 'CRM_MembersOnlyEvent_DAO_EventMembershipType',
          'localizable' => 0,
          'FKClassName' => 'CRM_MembersOnlyEvent_DAO_MembersOnlyEvent',
          'add' => '4.4',
        ],
        'membership_type_id' => [
          'name' => 'membership_type_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => E::ts('Membership Type ID'),
          'description' => E::ts('Allowed Membership Type ID.'),
          'required' => TRUE,
          'where' => 'membersonlyevent_event_membership_type.membership_type_id',
          'table_name' => 'membersonlyevent_event_membership_type',
          'entity' => 'EventMembershipType',
          'bao' => 'CRM_MembersOnlyEvent_DAO_EventMembershipType',
          'localizable' => 0,
          'FKClassName' => 'CRM_Member_DAO_MembershipType',
          'add' => '4.4',
        ],
      ];
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }

  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  public static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }

  /**
   * Returns the names of this table
   *
   * @return string
   */
  public static function getTableName() {
    return self::$_tableName;
  }

  /**
   * Returns if this table needs to be logged
   *
   * @return bool
   */
  public function getLog() {
    return self::$_log;
  }

  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &import($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'nlyevent_event_membership_type', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &export($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'nlyevent_event_membership_type', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of indices
   *
   * @param bool $localize
   *
   * @return array
   */
  public static function indices($localize = TRUE) {
    $indices = [
      'index_event_id_membership_type_id' => [
        'name' => 'index_event_id_membership_type_id',
        'field' => [
          0 => 'members_only_event_id',
          1 => 'membership_type_id',
        ],
        'localizable' => FALSE,
        'sig' => 'membersonlyevent_event_membership_type::0::members_only_event_id::membership_type_id',
      ],
    ];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
