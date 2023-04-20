# Membershipextras Data Health Checker

This extension performs regular data health checks on Membershipextras and CiviCRM
financial data.

### Overview

The extension defines a new scheduled job called : "Membershipextras - data health checker" that runs
daily and update the database with the health check results. To access the results you can go
to "Administer >> CiviContribute >> Data Health Checker Dashboard", which will show different
type of issues in the existing data categorized by their type along with the number of the affected
records, from there you can export any category records.

Currently, we are checking for the following type of errors:

- Contributions paid with Direct Debit but with no related Payment Plan: Direct debit payments are mostly paid with Payment Plans, so if a
  direct debit contribution does not have a linked payment-plan then probably there is an issue in that contribution.
- Missing financial transaction records on contributions: Contributions should at least have one financial transaction record and one entity
  finincal transaction record, but if the contribution have non, then there is an issue with it.
- Missing line items on contributions: Any contribution should at least have one line item.
- Missing financial items on line items: Line items should at least have one financial item and entity financial transaction record.
- Contributions with mismatched line items amount: Contribution amount should equal the sum of all its line items amounts plus taxes.
- Contributions with mismatched line items tax amount: Contribution tax amount should equal the sum of all its line items tax amounts.
- Offline payment plans but with no related memberships: So far we only support payment plans with memberships, if there is a payment plan but it does not
  have a linked membership then it means there is an issue with it.
- Offline payment plans but with auto-renew flag set to False: All payment plans should be renewable
- Offline payment plans but without any subscription line items: Each payment plan should at least have one subscription line item
- Direct debit payment plans but with no related mandate: Payment plans paid with direct debit should have a mandate linked to them.
- Direct debit contributions but with no related mandate: Contributions paid with direct debit should have a mandate linked to them.
