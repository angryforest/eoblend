// Gulp
var gulp = require('gulp');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var del = require('del');

// Sass/CSS stuff
var sass = require('gulp-sass');
var prefix = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');

// JavaScript
var uglify = require('gulp-uglify');

// Images
var svgmin = require('gulp-svgmin');
var imagemin = require('gulp-imagemin');

// Stats and Things
var size = require('gulp-size');

gulp.task('cl', function () {
    return del([
        './public/js/app.js',
        './public/css/app.css'
    ]);
});

gulp.task('css', function () {
    gulp.src(['./resources/sass/app.scss'])
        .pipe(sass({
            includePaths: ['./resources/sass'],
            outputStyle: 'expanded'
        }))
        .pipe(prefix("last 1 version", "> 1%", "ie 8", "ie 7"))
        .pipe(gulp.dest('./public/css'))
        .pipe(minifycss())
        .pipe(rename('app.min.css'))
        .pipe(gulp.dest('./public/css'));
});

// Uglify JS
gulp.task('js', function() {
    gulp.src([
        './resources/js/jquery-3.3.1.min.js',
        './resources/js/popper.min.js',
        './resources/js/bootstrap/index.js',
        //'./resources/js/bootstrap/tooltip.js',
        //'./resources/js/bootstrap/alert.js',
        //'./resources/js/bootstrap/button.js',
        //'./resources/js/bootstrap/carousel.js',
        './resources/js/bootstrap/collapse.js',
        //'./resources/js/bootstrap/dropdown.js',
        //'./resources/js/bootstrap/modal.js',
        //'./resources/js/bootstrap/popover.js',
        //'./resources/js/bootstrap/scrollspy.js',
        //'./resources/js/bootstrap/tab.js',
        './resources/js/bootstrap/util.js',
        './resources/js/vue/vue.js',
        './resources/js/axios.js',
        './resources/js/app.js'
    ])
        .pipe(concat('app.js'))
        .pipe(gulp.dest('./public/js'))
        .pipe(uglify())
        .pipe(rename('app.min.js'))
        .pipe(gulp.dest('./public/js'));
});