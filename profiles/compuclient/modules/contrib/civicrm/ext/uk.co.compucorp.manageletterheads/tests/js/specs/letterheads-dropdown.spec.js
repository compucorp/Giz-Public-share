(($, crmWysiwyg) => {
  describe('Letterheads Dropdown', () => {
    let $letterheadDropdown, $letterheadDropdownRow, $templateDropdownRow, $messageEditor;

    afterEach(() => {
      $('body').empty();

      if (CKEDITOR.instances.html_message) {
        CKEDITOR.instances.html_message.destroy(true);
      }
    });

    describe('Email Form', () => {
      beforeEach(() => {
        $('body').append(getEmailFormFixture());
        $().triggerBlockedOnReadyListeners();

        $letterheadDropdownRow = $(':contains("Select Letterhead")').parents('tr');
        $templateDropdownRow = $('.crm-contactEmail-form-block-template');
      });

      it('adds the letterhead dropdown after the template field row', () => {
        expect($letterheadDropdownRow.prev().is($templateDropdownRow)).toBe(true);
      });

      it('adds a "None" option to the list of letterheads', () => {
        expect($letterheadDropdownRow.find('option[value=""]').text()).toBe('None');
      });

      it('adds the full list of letterheads to the dropdown options', () => {
        expect($letterheadDropdownRow.find('option[value=1]').text()).toBe('Letterhead (English)');
        expect($letterheadDropdownRow.find('option[value=2]').text()).toBe('Letterhead (Welsh)');
        expect($letterheadDropdownRow.find('option[value=3]').text()).toBe('Letterhead (French)');
      });
    });

    describe('PDF Form', () => {
      beforeEach(() => {
        $('body').append(getPdfFormFixture());
        $().triggerBlockedOnReadyListeners();

        $letterheadDropdownRow = $(':contains("Select Letterhead")').parents('tr');
        $templateDropdownRow = $('select[name="template"]').parents('tr');
      });

      it('adds the letterhead dropdown after the template field row', () => {
        expect($letterheadDropdownRow.prev().is($templateDropdownRow)).toBe(true);
      });

      it('adds a "None" option to the list of letterheads', () => {
        expect($letterheadDropdownRow.find('option[value=""]').text()).toBe('None');
      });

      it('adds the full list of letterheads to the dropdown options', () => {
        expect($letterheadDropdownRow.find('option[value=1]').text()).toBe('Letterhead (English)');
        expect($letterheadDropdownRow.find('option[value=2]').text()).toBe('Letterhead (Welsh)');
        expect($letterheadDropdownRow.find('option[value=3]').text()).toBe('Letterhead (French)');
      });
    });

    describe('when selecting a letterhead', () => {
      beforeEach(() => {
        $('body').append(getEmailFormFixture());
        $().triggerBlockedOnReadyListeners();

        $letterheadDropdown = $(':contains("Select Letterhead")').parents('tr').find('select');
        $messageEditor = $('.crm-form-wysiwyg');

        crmWysiwyg._create($messageEditor);
        crmWysiwyg.setVal(
          $messageEditor,
          'Example content'
        );
        $letterheadDropdown.val('2');
        $letterheadDropdown.trigger('change');
      });

      it('appends the letterhead to the message editor', () => {
        expect(crmWysiwyg.getVal($messageEditor))
          .toContain('<p>Welsh Letterhead</p>');
      });

      it('does not remove any existing content', () => {
        expect(crmWysiwyg.getVal($messageEditor))
          .toContain('Example content');
      });
    });

    describe('when selecting no letterhead', () => {
      beforeEach(() => {
        $('body').append(getEmailFormFixture());
        $().triggerBlockedOnReadyListeners();

        $letterheadDropdown = $(':contains("Select Letterhead")').parents('tr').find('select');
        $messageEditor = $('.crm-form-wysiwyg');

        crmWysiwyg._create($messageEditor);
        crmWysiwyg.setVal(
          $messageEditor,
          'Example content'
        );
        $letterheadDropdown.val('2');
        $letterheadDropdown.trigger('change');
        $letterheadDropdown.val('');
        $letterheadDropdown.trigger('change');
      });

      it('does not contain a letterhead element', () => {
        expect(crmWysiwyg.getVal($messageEditor))
          .not.toContain('<p>Welsh Letterhead</p>');
      });

      it('does not remove any existing content', () => {
        expect(crmWysiwyg.getVal($messageEditor))
          .toContain('Example content');
      });
    });

    describe('when changing the current template', () => {
      beforeEach(() => {
        jasmine.clock().install();
        $('body').append(getEmailFormFixture());

        $().triggerBlockedOnReadyListeners();

        const $templateDropdown = $('[name="template"]');
        $letterheadDropdown = $(':contains("Select Letterhead")').parents('tr').find('select');
        $messageEditor = $('.crm-form-wysiwyg');

        crmWysiwyg._create($messageEditor);
        $letterheadDropdown.val('2');
        $letterheadDropdown.trigger('change');
        crmWysiwyg.setVal(
          $messageEditor,
          'Template content'
        );
        $templateDropdown.trigger('change');
        CKEDITOR.instances.html_message.fire('change');
        jasmine.clock().tick();
      });

      afterEach(() => {
        jasmine.clock().uninstall();
      });

      it('preserves the letterhead element', () => {
        expect(crmWysiwyg.getVal($messageEditor))
          .toContain('<p>Welsh Letterhead</p>');
      });

      it('does not remove any existing content', () => {
        expect(crmWysiwyg.getVal($messageEditor))
          .toContain('Template content');
      });
    });

    /**
     * @returns {string} The HTML fixture needed to mock the Email Form.
     */
    function getEmailFormFixture() {
      return `
        <table>
          <tr class="crm-contactEmail-form-block-template">
            <td class="label">
              <label>Use Template</label>
            </td>
            <td><select name="template"></select></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2">
              <textarea name="html_message" class="crm-form-wysiwyg"></textarea>
            </td>
          </tr>
        </table>
      `;
    }

    /**
     * @returns {string} The HTML fixture needed to mock the PDF Letter Form.
     */
    function getPdfFormFixture() {
      return `
        <div class="crm-contact-task-pdf-form-block">
          <table>
            <tr>
              <td class="label-left">
                <label>Use Template</label>
              </td>
              <td><select name="template"></select></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <td colspan="2">
              <textarea name="html_message" class="crm-form-wysiwyg"></textarea>
            </td>
          </table>
        </div>
      `;
    }
  });
})(CRM.$, CRM.wysiwyg);
