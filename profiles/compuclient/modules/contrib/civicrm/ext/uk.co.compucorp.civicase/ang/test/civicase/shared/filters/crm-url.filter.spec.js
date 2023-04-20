(function (_) {
  describe('crmUrl', function () {
    var $filter, crmUrl, civicaseCrmUrl;

    beforeEach(module('civicase'));

    beforeEach(inject(function (_$filter_, _civicaseCrmUrl_) {
      $filter = _$filter_;
      civicaseCrmUrl = _civicaseCrmUrl_;

      initCrmUrlFilter();
    }));

    describe('getting the href', function () {
      var hrefLocation, originalHref, expectedHref, expectedHrefLocation,
        expectedQuery;

      describe('when url starts with backslash', () => {
        beforeEach(function () {
          originalHref = '/civicrm/a/civicase';
          expectedHref = 'civicrm/a/civicase';
          expectedHrefLocation = 'http://civicrm.org/' + expectedHref;
          expectedQuery = { cid: _.uniqueId() };

          civicaseCrmUrl.and.returnValue(expectedHrefLocation);

          hrefLocation = crmUrl(originalHref, expectedQuery);
        });

        it('removes the slash before passing the href and query to CRM url', function () {
          expect(civicaseCrmUrl).toHaveBeenCalledWith(expectedHref, expectedQuery);
        });

        it('returns the result from CRM url', function () {
          expect(hrefLocation).toEqual(expectedHrefLocation);
        });
      });

      describe('when url doesnot start with backslash', () => {
        beforeEach(function () {
          originalHref = 'civicrm/a/civicase';
          expectedHref = 'civicrm/a/civicase';
          expectedHrefLocation = 'http://civicrm.org/' + expectedHref;
          expectedQuery = { cid: _.uniqueId() };

          civicaseCrmUrl.and.returnValue(expectedHrefLocation);

          hrefLocation = crmUrl(originalHref, expectedQuery);
        });

        it('passes the href and query to CRM url', function () {
          expect(civicaseCrmUrl).toHaveBeenCalledWith(expectedHref, expectedQuery);
        });

        it('returns the result from CRM url', function () {
          expect(hrefLocation).toEqual(expectedHrefLocation);
        });
      });
    });

    /**
     * Initializes the CRM Url filter and stores it in a variable.
     */
    function initCrmUrlFilter () {
      crmUrl = $filter('civicaseCrmUrl');
    }
  });
})(CRM._);
