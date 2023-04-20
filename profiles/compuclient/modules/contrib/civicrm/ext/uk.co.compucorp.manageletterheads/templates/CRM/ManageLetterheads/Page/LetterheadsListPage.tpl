{crmScope extensionKey='uk.co.compucorp.manageletterheads'}
  <div class="crm-container">
    <div id="bootstrap-theme">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="text-right">
            <a
              class="crm-popup btn btn-large btn-primary"
              href="{crmURL p='civicrm/letterheads/form' q='reset=1&action=add'}"
            >
              <i class="fa fa-plus-circle"></i>
              {ts}Create new letterhead{/ts}
            </a>
          </div>
          {if !count($letterheads)}
            <div class="crm-case-custom-form-block-empty text-center clearfix">
              {ts}No Letterheads are available.{/ts}
            <div>
          {/if}
        </div>
        {if count($letterheads)}
          {* handle enable/disable actions*}
          {include file="CRM/common/enableDisableApi.tpl"}
          <table class="table table-responsive table-striped">
            <thead>
              <tr>
                <th>{ts}Title{/ts}</th>
                <th>{ts}Description{/ts}</th>
                <th>{ts}Available for{/ts}</th>
                <th>{ts}Order{/ts}</th>
                <th>{ts}Enabled{/ts}</th>
                <th>{ts}Actions{/ts}</th>
              </tr>
            </thead>
            <tbody>
              {foreach from=$letterheads item=letterhead}
                <tr id="Letterhead-{$letterhead.id}" class="crm-entity {if NOT $letterhead.is_active} disabled{/if}">
                  <td>{$letterhead.title}</td>
                  <td>{$letterhead.description}</td>
                  <td>{$letterhead.available_for_text}</td>
                  <td>{$letterhead.weight}</td>
                  <td>{$letterhead.is_active_text}</td>
                  <td>{$letterhead.actions|replace:'xx':$letterhead.id}</td>
                </tr>
              {/foreach}
            </tbody>
          </table>
        {/if}
      </div>
    </div>
    {include file="CRM/common/pager.tpl" location="bottom"}
  </div>
{/crmScope}
