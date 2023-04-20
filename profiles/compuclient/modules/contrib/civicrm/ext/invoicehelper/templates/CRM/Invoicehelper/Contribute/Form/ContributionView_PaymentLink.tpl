{crmScope extensionKey="invoicehelper"}
<div class="crm-invoicehelper-payment-links crm-section">
  <div class="label">{ts}Pay Online Link{/ts}</div>
  <div class="content">
    <a target="_blank" href="{$invoicehelper_url_en}">{$invoicehelper_url_en}</a>
    <div class="description">{ts}You can copy-paste this link in an email to the contact. It grants them access to view and pay this specific contribution.{/ts}</div>
  </div>
  <div class="clear"></div>
</div>
{/crmScope}

{literal}
<script>
(function($, _, ts) {
  // Move the link under the main contribution info block
  $('.crm-contribution-view-form-block table.crm-info-panel:first').after($('.crm-invoicehelper-payment-links'));
})(CRM.$, CRM._, CRM.ts('invoicehelper'));
</script>
{/literal}
