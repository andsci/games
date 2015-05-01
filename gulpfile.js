var gulp = require('gulp');
var gulpif = require('gulp-if');
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');
var less = require('gulp-less');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var env = process.env.GULP_ENV;

//JAVASCRIPT TASK: write one minified js file out of jquery.js, bootstrap.js and all of my custom js files
gulp.task('js', function () {
    return gulp.src(['bower_components/jquery/dist/jquery.js',
        'bower_components/bootstrap/dist/js/bootstrap.js',
        'src/**/Resources/public/js/*.js'])
        .pipe(sourcemaps.init())
        .pipe(concat('javascript.min.js'))
        .pipe(gulpif(env === 'prod', uglify()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/assets/js'));
});

//CSS TASK: write one minified css file out of bootstrap.less and all of my custom less files
gulp.task('css', function () {
    return gulp.src([
        'bower_components/bootstrap/dist/css/bootstrap.css',
        'bower_components/bootstrap/dist/css/bootstrap-theme.css',
        'src/**/Resources/public/less/*.less'])
        .pipe(sourcemaps.init())
        .pipe(gulpif(/[.]less/, less()))
        .pipe(concat('styles.min.css'))
        .pipe(gulpif(env === 'prod', uglifycss()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/assets/css'));
});

//IMAGE TASK: Just pipe images from project folder to public web folder
gulp.task('img', function() {
    return gulp.src('src/**/Resources/public/img/*.*', { base: 'src/UserBundle/Resources/public/img' })
        .pipe(gulp.dest('web/assets/img'));
});

//
gulp.task('watch', function() {
    gulp.watch('src/**/Resources/public/less/*.less', ['css']);
    gulp.watch('src/**/Resources/public/js/*.js', ['js']);
});

//define executable tasks when running "gulp" command
gulp.task('default', ['js', 'css', 'img']);