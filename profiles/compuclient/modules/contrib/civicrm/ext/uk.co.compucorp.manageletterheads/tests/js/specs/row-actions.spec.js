(($, _, crmApi, crmConfirm, crmRefreshParent, ts) => {
  describe('Row Actions', () => {
    let fixture, letterheadId;

    beforeEach(() => {
      letterheadId = _.uniqueId();
      fixture = `
        <table>
          <tr id="Letterhead-${letterheadId}" class="crm-entity">
            <td>
              <a class="action-item letterhead-delete">Delete</a>
            </td>
          </tr>
        </table>
      `;

      $('body').append(fixture);
      $().triggerBlockedOnReadyListeners();
    });

    afterEach(() => {
      $('body').empty();
    });

    describe('when clicking a delete letterhead action', () => {
      beforeEach(() => {
        $('.letterhead-delete').click();
      });

      it('displays a confirmation dialog', () => {
        expect(crmConfirm).toHaveBeenCalledWith({
          title: ts('Warning'),
          message: ts('Are you sure you would like to delete this letterhead?'),
          options: {
            yes: ts('Yes'),
            no: ts('Cancel')
          }
        });
      });

      describe('when the dialog is confirmed', () => {
        beforeEach(() => {
          crmConfirm.$dialog.trigger('crmConfirm:yes');
        });

        /**
         * @note The last parameter sent to *crmApi* is sent to the *crmStatus* service.
         * If there is no `start` option for that parameter, a default "Saving" text will
         * be used. This is the expected behaviour according to the specs.
         */
        it('displays a deleting letterhead message', () => {
          expect(crmApi.calls.mostRecent().args[3].start).not.toBeDefined();
        });

        it('deletes the letterhead', () => {
          expect(crmApi).toHaveBeenCalledWith(
            'Letterhead',
            'delete',
            { id: letterheadId },
            jasmine.any(Object)
          );
        });

        it('displays a success message after deleting the letterhead', () => {
          expect(crmApi).toHaveBeenCalledWith(
            jasmine.any(String),
            jasmine.any(String),
            jasmine.any(Object),
            { success: ts('Letterhead deleted') }
          );
        });

        it('refreshes the letterhead entity table page', () => {
          expect(crmRefreshParent).toHaveBeenCalled();
          expect(crmRefreshParent.calls.mostRecent().args[0].is('.crm-entity'));
        });
      });
    });
  });
})(CRM.$, CRM._, CRM.api3, CRM.confirm, CRM.refreshParent, CRM.ts('uk.co.compucorp.manageletterheads'));
