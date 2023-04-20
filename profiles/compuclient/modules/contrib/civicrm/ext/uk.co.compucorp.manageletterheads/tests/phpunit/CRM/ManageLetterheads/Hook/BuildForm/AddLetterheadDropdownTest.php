<?php

use CRM_ManageLetterheads_Test_Fabricator_Letterhead as LetterheadFabricator;
use CRM_ManageLetterheads_Hook_BuildForm_AddLetterheadDropdown as AddLetterheadDropdown;

/**
 * Add Letterhead Dropdown hook test.
 *
 * @group headless
 */
class CRM_ManageLetterheads_Hook_BuildForm_AddLetterheadDropdownTest extends BaseHeadlessTest {

  /**
   * Tests that email letterheads are added to the CRM config when sending emails.
   */
  public function testEmailFormsWhenThereAreEmailLetterheads () {
    $this->fabricateEmailLetterhead('Email Letterhead');
    $this->fabricatePdfLetterhead('PDF Letterhead');
    $this->fabricateGenericLetterhead('Generic Letterhead');

    $hook = new AddLetterheadDropdown();
    $hook->run(
      'CRM_Contact_Form_Task_Email',
      new CRM_Contact_Form_Task_Email()
    );

    $letterheadOptions = $this->getLetterheadOptions();

    $this->assertCount(2, $letterheadOptions);
    $this->assertEquals('Email Letterhead', $letterheadOptions[0]->title);
    $this->assertContains('Generic Letterhead', $letterheadOptions[1]->title);
  }

  /**
   * Tests that no letterheads are added when sending an email and there are no email letterheads.
   */
  public function testEmailFormsWhenThereAreNoEmailLetterheads () {
    $this->fabricatePdfLetterhead('PDF Letterhead');

    $hook = new AddLetterheadDropdown();
    $hook->run(
      'CRM_Contact_Form_Task_Email',
      new CRM_Contact_Form_Task_Email()
    );

    $letterheadOptions = $this->getLetterheadOptions();

    $this->assertCount(0, $letterheadOptions);
  }

  /**
   * Tests that PDF letterheads are added to the CRM config when creating PDF letters.
   */
  public function testPdfFormsWhenThereArePdfLetterheads () {
    $this->fabricateEmailLetterhead('Email Letterhead');
    $this->fabricatePdfLetterhead('PDF Letterhead');
    $this->fabricateGenericLetterhead('Generic Letterhead');

    $hook = new AddLetterheadDropdown();
    $hook->run(
      'CRM_Contact_Form_Task_PDF',
      new CRM_Contact_Form_Task_PDF()
    );

    $letterheadOptions = $this->getLetterheadOptions();

    $this->assertCount(2, $letterheadOptions);
    $this->assertEquals('PDF Letterhead', $letterheadOptions[0]->title);
    $this->assertContains('Generic Letterhead', $letterheadOptions[1]->title);
  }

  /**
   * Tests that no letterheads are added when creating a PDF letter and there are no PDF letterheads.
   */
  public function testPdfFormsWhenThereAreNoPdfLetterheads () {
    $this->fabricateEmailLetterhead('Email Letterhead');

    $hook = new AddLetterheadDropdown();
    $hook->run(
      'CRM_Contact_Form_Task_PDF',
      new CRM_Contact_Form_Task_PDF()
    );

    $letterheadOptions = $this->getLetterheadOptions();

    $this->assertCount(0, $letterheadOptions);
  }

  /**
   * Tests that no letterheads are added when using non Email or PDF Letter forms.
   */
  public function testNoLetterheadsWhenUsingNonEmailOrPdfForms () {
    $this->fabricateEmailLetterhead('Email Letterhead');
    $this->fabricatePdfLetterhead('PDF Letterhead');
    $this->fabricateGenericLetterhead('Generic Letterhead');

    $hook = new AddLetterheadDropdown();
    $hook->run(
      'CRM_Contact_Form_Contact',
      new CRM_Contact_Form_Contact()
    );

    $letterheadOptions = $this->getLetterheadOptions();

    $this->assertCount(0, $letterheadOptions);
  }

  /**
   * Fabricates an email letterhead.
   *
   * @param string $title
   *   The letterhead title.
   * @return array
   *   The letterhead as returned by the API.
   */
  private function fabricateEmailLetterhead($title) {
    return LetterheadFabricator::fabricate([
      'title' => $title,
      'available_for' => [1],
    ]);
  }

  /**
   * Fabricates a PDF letterhead.
   *
   * @param string $title
   *   The letterhead title.
   * @return array
   *   The letterhead as returned by the API.
   */
  private function fabricatePdfLetterhead($title) {
    return LetterheadFabricator::fabricate([
      'title' => $title,
      'available_for' => [2],
    ]);
  }

  /**
   * Fabricates a letterhead that can be used for emails and PDF letters.
   *
   * @param string $title
   *   The letterhead title.
   * @return array
   *   The letterhead as returned by the API.
   */
  private function fabricateGenericLetterhead($title) {
    return LetterheadFabricator::fabricate([
      'title' => $title,
      'available_for' => [1, 2],
    ]);
  }

  /**
   * Returns the letterhead options stored in the CRM settings.
   *
   * The options are decoded since they are stored as a JSON string. If no
   * options are stored, it will return an empty array.
   *
   * @return array
   *   An array of letterhead objects.
   */
  private function getLetterheadOptions() {
    $crmSettings = CRM_Core_Resources::singleton()->getSettings();

    return isset($crmSettings['manageletterheads'])
      ? json_decode($crmSettings['manageletterheads']['letterhead_options'])
      : [];
  }

}
