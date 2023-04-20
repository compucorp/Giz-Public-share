<table>
  <tr class="crm-email-element crm-invoicehelper-template">
    <td class="label">{$form.template.label}</td>
    <td class="html-adjust">{$form.template.html}</td>
  </tr>
</table>

{include file="CRM/Mailing/Form/InsertTokens.tpl"}

{literal}
<script type="text/javascript">
  CRM.$(function ($) {
    $('tr.crm-invoicehelper-template').insertBefore('tr.crm-contactEmail-form-block-subject')
  })

  function selectValue( val) {
    var dataUrl = {/literal}"{crmURL p='civicrm/ajax/template' h=0 }"{literal};

    cj.post( dataUrl, {tid: val}, function( data ) {
      CRM.wysiwyg.setVal('#email_comment', data.msg_html || '');
      cj("#subject").val( data.subject || '' );
    });
  }
</script>

{/literal}
