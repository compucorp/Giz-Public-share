<?php

use CRM_ManageLetterheads_Test_Fabricator_Letterhead as LetterheadFabricator;

/**
 * Letterhead API test class
 *
 * @group headless
 */
class api_v3_LetterheadTest extends BaseHeadlessTest {

  /**
   * Test exception is thrown when available_for not present.
   */
  public function testCreateThrowsAnExceptionWhenAvailableForFieldIsNotPresent() {
    $this->expectException(CiviCRM_API3_Exception::class);
    $this->expectExceptionMessage('Mandatory key(s) missing from params array: available_for');
    civicrm_api3('Letterhead', 'create', [
      'title' => 'Test title',
      'weight' => 1,
      'content' => 'Letterhead content',
    ]);
  }

  /**
   * Test delete also deletes associated data.
   */
  public function testDeleteAlsoDeletesAssociatedAvailableForFields() {
    $letterhead = LetterheadFabricator::fabricate(
      [
        'title' => 'Test Title',
        'name' => 'Test name',
        'available_for' => [1, 2],
      ]
    );

    civicrm_api3('Letterhead', 'delete', ['id' => $letterhead['id']]);
    $availabilityCount = civicrm_api3('LetterheadAvailability', 'getcount', ['letterhead_id' => $letterhead['id']])['result'];
    $this->assertEquals(0, $availabilityCount);
  }

  /**
   * Check that the available for field is returned with Letterhead.get
   */
  public function testGetAlsoReturnsAssociatedAvailableForFields() {
    $availableFor = [1, 2];
    $letterhead = LetterheadFabricator::fabricate(
      [
        'title' => 'Test Title',
        'name' => 'Test name',
        'available_for' => $availableFor,
      ]
    );

    $result = civicrm_api3('Letterhead', 'get', ['id' => $letterhead['id'], 'sequential' => 1]);

    $this->assertEquals($availableFor, $result['values'][0]['available_for']);
  }

  /**
   * Verifies that SQL operators are not allowed for the `available_for` parameter.
   *
   * @param  string $sqlOperator
   *   Sql operator.
   *
   * @dataProvider invalidAvailableForLetterheadOptionOperators
   */
  public function testExceptionIsThrownWhenPassingAnInvalidOperatorForAvailableFor($sqlOperator) {
    $this->expectException(CiviCRM_API3_Exception::class);
    $this->expectExceptionMessage('No SQL operators allowed for available_for');
    civicrm_api3('Letterhead', 'create', [
      'title' => 'Test title',
      'available_for' => [$sqlOperator => [1]],
      'weight' => 1,
      'content' => 'Letterhead content',
    ]);
  }

  /**
   * Returns the invalid operators not allowed when passing the `available for` parameter.
   *
   * @return array
   *   Array of invalid operators.
   */
  public function invalidAvailableForLetterheadOptionOperators() {
    $acceptedSQLOperators = CRM_Core_DAO::acceptedSQLOperators();
    $invalidSqlOperators = [];

    foreach ($acceptedSQLOperators as $sqlOperator) {
      $invalidSqlOperators[] = [$sqlOperator];
    }

    return $invalidSqlOperators;
  }

}
