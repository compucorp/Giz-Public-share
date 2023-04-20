(function (angular, _) {
  var module = angular.module('civicase');

  module.service('CasesUtils', function (ContactsCache) {
    /**
     * @param {object} role role object
     * @returns {boolean} if its a client role
     */
    this.isClientRole = function (role) {
      return !role.relationship_type_id;
    };

    /**
     * Fetch additional information about the contacts
     *
     * @param {Array} cases list of cases
     */
    this.fetchMoreContactsInformation = function (cases) {
      var contacts = [];

      _.each(cases, function (caseObj) {
        contacts = contacts.concat(getAllContactIdsForCase(caseObj));
      });

      ContactsCache.add(contacts);
    };

    /**
     * Get all the contacts of the given case
     *
     * @param {object} caseObj - case object to be processed
     *
     * @returns {Array} of all contact ids
     */
    function getAllContactIdsForCase (caseObj) {
      var contacts = [];

      _.each(caseObj.contacts, function (currentCase) {
        contacts.push(currentCase.contact_id);
      });

      _.each(caseObj.activity_summary, function (activityGroup) {
        _.each(activityGroup, function (activity) {
          contacts = contacts.concat(activity.assignee_contact_id);
          contacts = contacts.concat(activity.target_contact_id);
          contacts.push(activity.source_contact_id);
        });
      });

      return contacts;
    }
  });
})(angular, CRM._);
