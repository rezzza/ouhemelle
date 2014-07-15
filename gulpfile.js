var gulp = require('gulp');

var path = require('path');
var gutil = require('gulp-util');
var rimraf = require('gulp-rimraf');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var less = require('gulp-less');
var changed = require('gulp-changed');
var watch = require('gulp-watch');



gulp.task('default', ['clean', 'build']);

gulp.task('build', ['app:css', 'vendor:css', 'app:js', 'vendor:js', 'vendor:js']);

gulp.task('clean', function () {
    return gulp.src('web/statics/', {read: false})
        .pipe(rimraf());
});

gulp.task('app:css', ['clean'], function () {
    return gulp.src([
        'src/statics/main.css'
    ])
        .pipe(concat('app.css'))
        .pipe(gulp.dest('web/statics/'))
        .on('error', gutil.log);
});

gulp.task('vendor:css', ['clean'], function () {
    return gulp
        .src([
            'bower_components/bootstrap/dist/css/bootstrap.css',
            'bower_components/bootstrap/dist/css/bootstrap-theme.css'
        ])
        .pipe(concat('vendor.css'))
        .pipe(gulp.dest('web/statics/'))
        .on('error', gutil.log);
});

gulp.task('app:js', ['clean'], function () {
    return gulp
        .src([
            'src/statics/main.js'
        ])
        .pipe(concat('app.js'))
        .pipe(gulp.dest('web/statics/'))
        .on('error', gutil.log);
});

gulp.task('vendor:js', ['clean'], function () {
    return gulp
        .src([
            'bower_components/html5shiv/dist/html5shiv.js',
            'bower_components/respond/dest/respond.src.js',
            'bower_components/jquery/dist/jquery.js',
            'bower_components/bootstrap/dist/js/bootstrap.js',
            'bower_components/underscore/underscore.js',
            'bower_components/raphael/raphael.js',
            'bower_components/js-sequence-diagrams/build/sequence-diagram-min.js'
        ])
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest('web/statics/'))
        .on('error', gutil.log);
});


gulp.task('vendor:js', ['clean'], function () {
    return gulp
        .src([
            'bower_components/js-sequence-diagrams/build/sequence-diagram-min.js'
        ])
        .pipe(gulp.dest('web/statics/'))
        .on('error', gutil.log);
});

gulp.task('watch', ['clean', 'build'], function () {
    watch({
        glob: 'src/statics/*',
        emit: 'one',
        emitOnGlob: false
    }, ['build']);
});
