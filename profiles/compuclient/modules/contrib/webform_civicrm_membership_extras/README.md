# Webform CiviCRM Membership Extras

Support drupal module for [uk.co.compucorp.membershipextras](https://github.com/compucorp/uk.co.compucorp.membershipextras) extension that handle the creation of upfront contributions after submitting a civicrm webform.

## Do I need This Module?
If you're using Membership Extras extension to manage memberships and payment plans, and you would like to allow your users to sign-up for those memberships via a webform, then yes! This module is required, as it will add the necessary form controls to let visitors to your site to choose the number of installments in which they would like to pay for the membership and handle the creation of those contributions and associate them to the payment plan.

## Requirements
This module works in tandem with membership extras CiviCRM extension. Aside from that, you will also need to install a patched version of the [CiviCRM webforms module v7.x-4.28](https://github.com/compucorp/webform_civicrm/releases/tag/7.x-4.28-patch1) which has several features and fixes done in order to support the creation of payment plans and memberships via a webform:

- [Patch #1](https://github.com/colemanw/webform_civicrm/pull/180): Use Selected Payment Processor, Instead Default
- [Patch #2](https://github.com/colemanw/webform_civicrm/pull/274): Support for Membership Autorenewal
- [Patch #3](https://github.com/colemanw/webform_civicrm/pull/275): Improve Autorenewal UX
- [Patch #4](https://github.com/colemanw/webform_civicrm/pull/280): Improve Accuracy Calculations Done on Values with Decimals
- [Patch #5](https://github.com/colemanw/webform_civicrm/pull/282): Fixes Line Items View When Selecting Memberships via Checkbox
- [Patch #6](https://github.com/colemanw/webform_civicrm/pull/284): Autofills Related Contacts on Same Page

### Patches
#### Patch #1: Use Selected Payment Processor, Instead Default
If you had a payment processor with the payment method configured, then generated contribution after submitting the webform would always use the default payment method instead of the payment processor's payment method.

This patch fixes the problem in [this PR](https://github.com/colemanw/webform_civicrm/pull/274), and is available on v7.x-5.x of the civicrm webform module. This is also related to a [CiviCRM Core issue](https://github.com/civicrm/civicrm-core/pull/13073), fixed and available since CiviCRM v5.9.0.

#### Patch #2: Support for Membership Autorenewal
Adds support to allow users to autorenew their memberships when they pay using any offline payment method.

[In this patch](https://github.com/colemanw/webform_civicrm/pull/274), we've added a field that allow the administrator or the user to select if the membership should be autorenewed or not. This feature has been merged into v7.x-5.x of the CiviCRM webform module. To configure a membership to be autorenewed the following conditions need to be met:

1. Have this field selected and set to Yes.
2. A frequency interval and unit fields to be set.
3. The membership is paid using an offline payment processor (either "manual payment" or any payment processor that implements "Payment_Manual" core class).

If the conditions above are met then the membership will be autorenewed.

#### Patch #3: Improves Autorenewal UX
[This patch](https://github.com/colemanw/webform_civicrm/pull/275) adds a warning when the admin tries to configure a webform with more than one membership with autorenew support, telling the user that both frequency interval and unit of the membership types should be the same in order for the autorenewal to work well.

The patch is already part of v7.x-5.x of CiviCRM webform module, but we need to have it in v7.x-4.28.

#### Patch #4: Improve Accuracy Calculations Done on Values with Decimals
Calculation of the total amount per installment was being done in two different ways, resulting in different values when floating point representation of decimals differred. For example, a membershipe with a full price of $55.68 resulted in the creation a a recurring contribution with $4.75 per installment, and a price of $4.64 on each contribution. Both are wrong, as `55.68 / 12 = 4.64`.

This issue was fixed in [this patch](https://github.com/compucorp/webform_civicrm/commit/f748c2439ae84b590d4eabf96fa91f76cbe4285f), by calculating the amounts per installment in a single, consistent way. This is not yet part of the main CiviCrm Webform module yet.

#### Patch #5: Fixes Line Items View When Selecting Memberships via Checkbox
If the configured membership field type is "checkbox", then the membership will not appear for the user during the webform submission, though it will end up getting created in CiviCRM backend just fine.

[This patch](https://github.com/colemanw/webform_civicrm/pull/282) fixes this, showing selected memberships normally at the line items view during the webform submission.

The patch has been merged into v7.x-5.x of CiviCRM Webforms module.

#### Patch #6: Autofills Related Contacts on Same Page

Webforms can be configured so when a contact is chosen, related contacts can be auto-filled on the rest of the form. For example, if I have a webform with 5 contacts with the following relationships:

- Contact 1 (individual)
- Contact 2 (Organization) is an Employer of Contact 1 (individual)
- Contact 3 (Individual) is Parent of Contact 1 (Individual)
- Contact 5 (Organization) is an Employer of Contact 4 (Individual)

In this scenario, choosing contact 1 should autofill contact 2. Contact 3 should get auto-filled with the parent of contact 1. And contact 5 should get auto-filled with the employer of contact 4. However, this was not happenning.

[This fix](https://github.com/colemanw/webform_civicrm/pull/284) solves the problem by eliminating a condition that caused only the first related contact to be loaded into the form.
