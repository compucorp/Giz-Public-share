(function ($, crmApi, crmConfirm, crmRefreshParent, ts) {
  $(document).ready(function () {
    $('.action-item.letterhead-delete').click(handleLetterheadDeleteAction);
  });

  /**
   * Deletes the letterhead for the given ID.
   *
   * @param {string} letterheadId The letterhead ID.
   * @return {Promise} resolved after deleting the letterhead successfully
   */
  function deleteLetterhead (letterheadId) {
    return CRM.api3(
      'Letterhead',
      'delete',
      { id: letterheadId },
      { success: ts('Letterhead deleted') }
    );
  }

  /**
   * Confirms the letterhead delete. Sends the data to the API and refreshes the
   * list of letterheads after done.
   *
   * @param {object} event Click event object.
   */
  function handleLetterheadDeleteAction (event) {
    var $entityRow = $(this).closest('.crm-entity');
    var letterheadId = $entityRow.attr('id').split('-')[1];

    event.preventDefault();
    displayDeleteLetterheadConfirmationDialog()
      .on('crmConfirm:yes', function () {
        deleteLetterhead(letterheadId)
          .done(function () {
            crmRefreshParent($entityRow);
          });
      });
  }

  /**
   * Displays a delete letterhead confirmation dialog.
   *
   * @returns {Element} A dialog element that can be used to listen to
   *   the confirm event.
   */
  function displayDeleteLetterheadConfirmationDialog () {
    return crmConfirm({
      title: ts('Warning'),
      message: ts('Are you sure you would like to delete this letterhead?'),
      options: {
        yes: ts('Yes'),
        no: ts('Cancel')
      }
    });
  }
})(CRM.$, CRM.api3, CRM.confirm, CRM.refreshParent, CRM.ts('uk.co.compucorp.manageletterheads'));
