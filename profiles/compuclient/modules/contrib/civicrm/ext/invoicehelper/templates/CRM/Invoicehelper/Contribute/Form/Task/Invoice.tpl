{include file="CRM/Contribute/Form/Task/Invoice.tpl"}

<table class="form-layout">
  <tr class="crm-invoicehelper-emailto">
    <td class="label">{$form.emailto.label}</td>
    <td class="html-adjust">{$form.emailto.html}</td>
  </tr>
  <tr class="crm-invoicehelper-emailcc">
    <td class="label">{$form.emailcc.label}</td>
    <td class="html-adjust">{$form.emailcc.html}</td>
  </tr>
  <tr class="crm-invoicehelper-template">
    <td class="label">{$form.template.label}</td>
    <td class="html-adjust">{$form.template.html}</td>
  </tr>
  <tr class="crm-invoicehelper-message">
    <td class="label">{ts}Message{/ts}</td> {* Override the default label, 'HTML Message' *}
    <td class="html-adjust">{$form.html_message.html}</td>
  </tr>
</table>

{* InsertTokens requires it, but hide for now because it's not implemented in our postProcess *}
<div style="display: none;">
<div id="editMessageDetails" class="section">
    <div id="updateDetails" class="section" >
  {$form.updateTemplate.html}&nbsp;{$form.updateTemplate.label}
    </div>
    <div class="section">
  {$form.saveTemplate.html}&nbsp;{$form.saveTemplate.label}
    </div>
</div>
<div id="saveDetails" class="section">
   <div class="label">{$form.saveTemplateName.label}</div>
   <div class="content">{$form.saveTemplateName.html|crmAddClass:huge}</div>
</div>
</div>

{include file="CRM/Mailing/Form/InsertTokens.tpl"}

{literal}
  <script>
    CRM.$(function($) {
      var $parent = $('#from_email_address').closest('tbody');
      $('.crm-invoicehelper-template').prependTo($parent);
      $('.crm-invoicehelper-emailcc').prependTo($parent);
      $('.crm-invoicehelper-emailto').prependTo($parent);
      $('.crm-invoicehelper-message').appendTo($parent);

      // Copied from templates/CRM/Contact/Form/Task/Email.tpl
      var $form = $("form.{/literal}{$form.formClass}{literal}");
      var sourceDataUrl = "{/literal}{crmURL p='civicrm/ajax/checkemail' q='id=1' h=0 }{literal}";

      function emailSelect(el, prepopulate) {
        $(el, $form).data('api-entity', 'contact').css({width: '40em', 'max-width': '90%'}).crmSelect2({
          minimumInputLength: 1,
          multiple: true,
          ajax: {
            url: sourceDataUrl,
            data: function(term) {
              return {
                name: term
              };
            },
            results: function(response) {
              return {
                results: response
              };
            }
          }
        }).select2('data', prepopulate);
      }

      emailSelect('#emailto', CRM.invoicehelper.toContact);
      emailSelect('#emailcc', '');
    });

  </script>
{/literal}
