<div class="crm-content-block crm-block">
  <div class="form-item">
    <table class="membership-log-selector-{$context} selector row-highlight">
      <thead>
        <tr>
          <th data-data="sort_name" class="crm-membership-log-sort_name">{ts}Modified By{/ts}</th>
          <th data-data="membership_type" class="crm-membership-log_membership_type">{ts}Type{/ts}</th>
          <th data-data="status" class="crm-membership-log-status">{ts}Status{/ts}</th>
          <th data-data="start_date" class="crm-membership-log-start_date">{ts}Start Date{/ts}</th>
          <th data-data="end_date" class="crm-membership-log-end_date">{ts}End Date{/ts}</th>
          <th data-data="modified_date" class="crm-membership-log-modified_date">{ts}Max Related{/ts}</th>
          <th data-data="modified_date" class="crm-membership-log-modified_date">{ts}Modified Date{/ts}</th>
        </tr>
      </thead>
      {if $logs}
        {foreach from =$logs item=log}
          <tr class="log_type_id-{$log.id} {cycle values="odd-row,even-row"}">
            <td class="crm-membership-log-sort_name">
              <a href='{crmURL p="civicrm/contact/view" q="reset=1&cid=`$log.modified_id`"}'>{$log.sort_name}</a>
            </td>
            <td class="crm-membership-log_membership_type">{$log.membership_type}</td>
            <td class="crm-membership-log-status">{$log.status}</td>
            <td class="crm-membership-log-start_date">{$log.start_date|crmDate}</td>
            <td class="crm-membership-log-end_date">{$log.end_date|crmDate}</td>
            <td class="crm-membership-log-status">{$log.max_related}</td>
            <td class="crm-membership-log-modified_date">{$log.modified_date|crmDate}</td>
          </tr>
        {/foreach}
      {else}
        <tr class="odd">
          <td colspan="8" class="dataTables_empty" valign="top">{ts}None logs found.{/ts}</td>
        </tr>
      {/if}
    </table>
  </div>
</div>
