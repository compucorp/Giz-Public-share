/**
 * jQuery method for submit button preventing from multi-submitting a form
 * if the submit button was clicked multiple times.
 */
jQuery.fn.webform_single_submit_handler = function() {
  // Pick up jQuery element which is assumed to be a form.
  var $form = jQuery(this);

  // Handle 'submit' action.
  if (!$form.data('single-submit-handler')) {
    $form.submit(function() {
      if ($form.data('submitted')) {
        return false;
      }

      // Set data-disable to TRUE.
      $form.data('submitted', true);
    });

    $form.data('single-submit-handler', true);
  }
};

/**
 * jQuery method for serializing an object.
 *
 * @returns object
 */
jQuery.fn.serializeObject = function()
{
  var o = {};
  var a = this.serializeArray();
  jQuery.each(a, function() {
    if (o[this.name] !== undefined) {
      if (!o[this.name].push) {
        o[this.name] = [o[this.name]];
      }
      o[this.name].push(this.value || '');
    } else {
      o[this.name] = this.value || '';
    }
  });
  return o;
};

(function ($) {
  // Create Javascript object for the module.
  Drupal.behaviors.webform_single_submit = {
    // Initially attach 'webform_single_submit_handler' function to each
    // form submit element.
    attach: function() {
      $('.webform-single-submit').webform_single_submit_handler();
    }
  };
})(jQuery);
