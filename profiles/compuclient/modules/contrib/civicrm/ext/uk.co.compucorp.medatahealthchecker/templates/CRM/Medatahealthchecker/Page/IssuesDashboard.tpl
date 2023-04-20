<div><b style="color:red;">These issues might require your attention:</b></div><br>

{foreach from=$issuesCategories item=item key=n}
  <div class="issues-category">
    <h3 class="crm-severity-warning">
      <i class="crm-i fa-exclamation-triangle" aria-hidden="true"></i>
      [{$item.issues_count} record(s)] => {$item.description}
      <div class="css_right">
        <a href="/civicrm/medatahealthchecker/search-error?error_code={$item.error_code}">Export Results</a>
      </div>
    </h3>
  </div>
{/foreach}
