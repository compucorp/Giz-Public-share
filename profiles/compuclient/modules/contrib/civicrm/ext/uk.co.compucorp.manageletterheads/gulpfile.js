'use strict';

var gulp = require('gulp');

var testTask = require('./gulp-tasks/karma-unit-test.js');

/**
 * Runs Karma unit tests
 */
gulp.task('test', testTask);
