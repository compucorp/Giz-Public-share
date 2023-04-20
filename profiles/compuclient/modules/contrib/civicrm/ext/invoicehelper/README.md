# Invoice Helper

![Screenshot](/images/screenshot.png)

Alters the "Email Invoice" form to add a few fields similar to other email forms:

* Email To: allows sending to multiple people (defaults to the primary email)
* Email Cc: add other contacts in CC
* Email subject: supports tokens
* Use Template: use a message template for the message subject and body

Small changes to workflow:

* After sending a single invoice (from Contact > View Contribution > Send Invoice), it redirects back to the Activity Tab of the contact.
* The body of the message sent is saved in the activity details.

Other features:

* On the View Contribution page, if the contribution is in a pending status, it
  will display a customized payment link (with a contact checksum) that can be
  copy-pasted in an email.
* Has global settings to always CC/BCC specific emails on offline receipts, such
  as membership or contribution receipts (todo: events).
* Has a global setting to change the default "Send Confirmation and Receipt?" option
  so that CiviCRM defaults to sending email receipts when adding contributions or
  memberships. This default to the current CiviCRM behaviour (no receipt).

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v7.0+
* CiviCRM 5.latest

## Installation

Install as a regular CiviCRM extension.

Invoice Helper settings are accessible from Administer > CiviContribute > Invoice Helper.

## Support

Please post bug reports in the issue tracker of this project on CiviCRM's Gitlab:  
https://lab.civicrm.org/extensions/invoicehelper/issues

This extension was written thanks to the financial support of organisations
using it, as well as the very helpful and collaborative CiviCRM community.

While we do our best to provide free community support for this extension,
please consider financially contributing to support or development of this
extension.

Support via Coop Symbiotic:  
https://www.symbiotic.coop/en

Coop Symbiotic is a worker-owned co-operative based in Canada. We have a strong
experience working with non-profits and CiviCRM. We provide affordable, fast,
turn-key hosting with regular upgrades and proactive monitoring, as well as custom
development and training.
