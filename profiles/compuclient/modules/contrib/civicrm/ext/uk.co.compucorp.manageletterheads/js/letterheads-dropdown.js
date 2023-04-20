(($, _, ManageLetterheads, ts, crmWysiwyg) => {
  var $htmlMessageEditor, $letterheadDropdown, $templateRow, $templateDropdown,
    isEmailForm;
  var letterheadOptions = JSON.parse(ManageLetterheads.letterhead_options);

  $(document).ready(function () {
    initDomElementReferences();

    var options = isEmailForm
      ? { labelTdClass: 'label' }
      : { labelClass: 'label-left' };

    appendLetterheadDropdownRow(options);
    addEventListeners();
  });

  /**
   * Adds the event listeners for the letterhead and template dropdown change.
   */
  function addEventListeners () {
    $letterheadDropdown.on('change', handleLetterheadChange);
    $templateDropdown.on('change', handleTemplateChange);
  }

  /**
   * Appends a letterhead dropdown element after the template selection field.
   *
   * @param {LetterheadDropdownRowOptions} options a list of options to use when
   *   appending the letterhead dropdown row to the form.
   */
  function appendLetterheadDropdownRow(options) {
    var $letterheadDropdownRow = $('<tr><td><label>Select Letterhead</label></td><td></td></tr>');
    $letterheadDropdown = buildLetterheadDropdown();

    $letterheadDropdownRow.find('td:first').addClass(options.labelTdClass);
    $letterheadDropdownRow.find('label').addClass(options.labelClass);
    $letterheadDropdown.appendTo($letterheadDropdownRow.find('td:last'));

    $templateRow.after($letterheadDropdownRow);
  }

  /**
   * Appends the letterhead for the given ID to the message editor. Removes
   * any previous letterhead references.
   *
   * @param {string} letterheadId the letterhead's ID to append to the message
   * editor.
   */
  function appendLetterheadToMessage (letterheadId) {
    var letterheadContent = _.find(letterheadOptions, { id: letterheadId }).content;
    var letterheadHtml = $('<div class="letterhead-element">' + letterheadContent + '</div>');
    var $messageContent = getMessageDomContent();

    removeLetterheadFromElement($messageContent);
    $messageContent.prepend(letterheadHtml);
    crmWysiwyg.setVal(
      $htmlMessageEditor,
      $messageContent.html()
    );
  }

  /**
   * @return {object} a Dropdown element with all the option values for the
   * letterheads stored in the configuration.
   */
  function buildLetterheadDropdown () {
    var noneOption = { id: '', title: ts('None') };
    var optionTemplate = _.template('<option value="<%= id %>"><%= title %></option>');
    var dropdownHtml = '<select class="crm-form-select">' +
      _.chain(noneOption)
        .concat(letterheadOptions)
        .map(optionTemplate)
        .join('')
        .value()
      + '</select>';

    return $(dropdownHtml);
  }

  /**
   * @return {object} the DOM elements belonging to the message editor.
   */
  function getMessageDomContent() {
    return $('<div>' + crmWysiwyg.getVal($htmlMessageEditor) + '</div>');
  }

  /**
   * Appends the selected letterhead. Removes any existing letterhead when
   * selecting "None".
   */
  function handleLetterheadChange () {
    var letterheadId = $letterheadDropdown.val();

    if (letterheadId) {
      appendLetterheadToMessage(letterheadId);
    } else {
      removeLetterheadFromMessage();
    }
  }

  /**
   * Keeps the selected letterhead in the message editor even after the template
   * changes. This is needed because the template change completely replaces the
   * contents of the message editor.
   *
   * We need to listen to the message editor change event because the template
   * is not inmediately changed.
   */
  function handleTemplateChange () {
    var letterheadId = $letterheadDropdown.val();

    if (!letterheadId) {
      return;
    }

    var messageEditorListener = CKEDITOR.instances.html_message
      .on('change', function () {
        messageEditorListener.removeListener();
        setTimeout(function () {
          appendLetterheadToMessage(letterheadId);
        });
      });
  }

  /**
   * Stores the DOM references to elements that will be used for letterhead
   * handling.
   *
   * It also determines the type of form we are working on after checking
   * the DOM references.
   */
  function initDomElementReferences () {
    var $emailTemplateRow = $('.crm-contactEmail-form-block-template');
    var $pdfTemplateRow = $('select[name="template"]').parents('tr');

    $templateDropdown = $('[name="template"]');
    $htmlMessageEditor = $('[name="html_message"]');
    isEmailForm = $emailTemplateRow.length > 0;
    $templateRow = isEmailForm ? $emailTemplateRow : $pdfTemplateRow;
  }

  /**
   * Removes the letterhead from the given element.
   *
   * It also removes the `letterhead-element` class from any element other than
   * the letterhead that might have gotten this class. This happens because the
   * message editor repeats the previous element's class on subsequent elements.
   *
   * @param {object} $element jQuery's element reference.
   */
  function removeLetterheadFromElement($element) {
    $element.find('.letterhead-element:first').remove();
    $element.find('.letterhead-element').removeClass('letterhead-element');
  }

  /**
   * Removes letterheads from the message editor.
   */
  function removeLetterheadFromMessage () {
    var $messageContent = getMessageDomContent();

    removeLetterheadFromElement($messageContent);
    crmWysiwyg.setVal(
      $htmlMessageEditor,
      $messageContent.html()
    );
  }

  /**
   * @typedef {object} LetterheadDropdownRowOptions
   *
   * @property {string} [labelClass] A class that will be applied directly to the label element.
   * @property {string} [labelTdClass] A class that will be applied to the label's parent TD element.
   */
})(CRM.$, CRM._, CRM.manageletterheads,
  CRM.ts('uk.co.compucorp.manageletterheads'), CRM.wysiwyg);
