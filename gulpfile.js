var gulp = require('gulp');
var sass = require('gulp-sass');
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');
var rjs = require('gulp-requirejs');
var browserify = require('gulp-browserify');


gulp.task('default', ['matScss', 'watch', 'minifycss'], function(){

});


gulp.task('mainScss', function () {
  return gulp.src('./sass/main.scss')
    .pipe(sass())
    .pipe(rename('main.css'))
    .pipe(gulp.dest('./css/'));
});

gulp.task('matScss', function (){
  return gulp.src('./sass/materialize.scss')
    .pipe(sass())
    .pipe(rename('materialize.css'))
    .pipe(gulp.dest('./css/'));
});

gulp.task('minifycss', ['mainScss'], function(){
  return gulp.src('./css/*.css')
    .pipe(cleanCSS())
    .pipe(gulp.dest('./styles/'));
});

gulp.task('compreq', function() {
    return gulp.src('./js/fetchReq.js')
		.pipe(browserify({
		  insertGlobals : true,
		}))
        .pipe(rename('all.min.js'))
		.pipe(gulp.dest('./js/compiled/'));
});

gulp.task('watch', function() {
    gulp.watch('./sass/main.scss', ['minifycss']);
    gulp.watch('./js/apps.js', ['compreq']);
    gulp.watch('./js/angular/**/*.js', ['compreq']);
});
