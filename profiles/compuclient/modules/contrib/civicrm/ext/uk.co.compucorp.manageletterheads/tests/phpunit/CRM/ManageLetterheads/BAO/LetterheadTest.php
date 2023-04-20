<?php

use CRM_ManageLetterheads_Test_Fabricator_Letterhead as LetterheadFabricator;

/**
 * Letterhead BAO test class
 *
 * @group headless
 */
class CRM_ManageLetterheads_BAO_LetterheadTest extends BaseHeadlessTest {

  /**
   * Test that an exception is thrown for invalid available for option value.
   */
  public function createThrowsAnExceptionWhenAvailableForValuesAreNotValid() {
    $this->expectException(new Exception('Please make sure all Available For Options are valid'));
    LetterheadFabricator::fabricate(['title' => 'Letter Title', 'available_for' => ['blabla', 1]]);
  }

  /**
   * Test that the name field is properly populated and is not manipulated.
   *
   * @param string $title
   *   Letterhead title.
   * @param string $expectedName
   *   Letterhead name.
   *
   * @dataProvider getDataForPopulatingNameField
   */
  public function testThatTheNameFieldIsPopulatedAndCanNotBeManipulated($title, $expectedName) {
    $letterhead = LetterheadFabricator::fabricate(
      [
        'title' => $title,
        'name' => 'Test name',
        'available_for' => [1],
      ]
    );

    $this->assertEquals($expectedName, $letterhead['name']);
  }

  /**
   * Tests that available for is saved properly in the letterheadavailability entity.
   */
  public function testAvailableForValuesIsSavedCorrectlyForALetterhead() {
    $availableForExpected = [1, 2];
    $letterhead = LetterheadFabricator::fabricate(
      [
        'title' => 'Test name',
        'available_for' => $availableForExpected,
      ]
    );

    $availability = civicrm_api3('LetterheadAvailability', 'get', ['letterhead_id' => $letterhead['id']]);
    $availableFor = array_column($availability['values'], 'available_for');
    $this->assertEquals($availableForExpected, $availableFor);
  }

  /**
   * Provides data for testing the name field population.
   *
   * @return array
   *   List of title an expected name.
   */
  public function getDataForPopulatingNameField() {
    return [
      ['New Title', 'newtitle'],
      ['Test a new Title', 'testanewtitle'],
      ['Test_a new-Title', 'test_anew-title'],
    ];
  }

}
