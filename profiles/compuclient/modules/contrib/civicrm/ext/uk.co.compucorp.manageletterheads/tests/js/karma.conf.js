const cv = require('civicrm-cv')({ mode: 'sync' });

module.exports = function (config) {
  var civicrmPath = cv(`path -d '[civicrm.root]'`)[0].value;
  var extPath = cv('path -x uk.co.compucorp.manageletterheads')[0].value;

  config.set({
    basePath: civicrmPath,
    frameworks: ['jasmine'],
    files: [
      // the global dependencies
      'bower_components/jquery/dist/jquery.min.js',
      'bower_components/jquery-ui/jquery-ui.js',
      'bower_components/lodash-compat/lodash.min.js',
      'bower_components/select2/select2.min.js',
      'bower_components/jquery-validation/dist/jquery.validate.min.js',
      'bower_components/datatables/media/js/jquery.dataTables.min.js',
      'packages/jquery/plugins/jquery.blockUI.js',
      'js/Common.js',

      // Global variables that need to be accessible in the test environment
      extPath + '/tests/js/globals/**/*.js',
      extPath + '/tests/js/helpers/**/*.js',

      // CKEditor files
      'bower_components/ckeditor/ckeditor.js',
      'bower_components/ckeditor/config.js',
      'bower_components/ckeditor/lang/en.js',
      'bower_components/ckeditor/styles.js',
      'js/wysiwyg/crm.wysiwyg.js',
      'js/wysiwyg/crm.ckeditor.js',
      { pattern: 'bower_components/ckeditor/**/*.css' },

      // Source Files
      { pattern: extPath + '/js/**/*.js' },

      // Spec files
      { pattern: extPath + '/tests/js/specs/**/*.js' },
    ],
    exclude: [
    ],
    reporters: ['progress'],
    // web server port
    port: 9876,
    colors: true,
    logLevel: config.LOG_INFO,
    autoWatch: true,
    browsers: ['ChromeHeadlessBrowser'],
    customLaunchers: {
      ChromeHeadlessBrowser: {
        base: 'ChromeHeadless',
        flags: [
          '--no-sandbox',
          '--disable-dev-shm-usage'
        ]
      }
    }
  });
};
