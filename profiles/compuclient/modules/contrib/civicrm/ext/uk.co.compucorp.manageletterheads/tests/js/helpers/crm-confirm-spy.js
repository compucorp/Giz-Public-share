(() => {
  CRM.confirm = jasmine.createSpy('crmConfirm');

  CRM.confirm.and.callFake(fakeCrmConfirm);

  /**
   * A mock function for the original CRM.confirm service.
   *
   * Returns a mock dialog element that can be used to manually trigger the
   * confirm event.
   *
   * @returns {Element}
   */
  function fakeCrmConfirm () {
    CRM.confirm.$dialog = $('<div></div>');

    return CRM.confirm.$dialog;
  }
})();
