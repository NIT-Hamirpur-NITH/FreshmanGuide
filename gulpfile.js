var gulp = require('gulp'),
    concat = require('gulp-concat'),
    gulpif = require('gulp-if'),
    uglify = require('gulp-uglify'),
    minifyCss = require('gulp-minify-css');


// css combination for admin-css
gulp.task('admin-css', function() {
    return gulp.src([
            "resources/assets/bower/bootstrap/dist/css/bootstrap.css",
            "resources/assets/bower/metisMenu/dist/metisMenu.css",
            "resources/assets/sbadmin/css/sb-admin-2.css",
            "resouces/assets/bower/font-awesome/css/font-awesome.css",
        ])
        // .pipe(minifyCss())
        .pipe(concat('vendor.min.css'))
        .pipe(gulp.dest('public/assets/admin/'));

});

gulp.task('admin-js', function() {
    return gulp.src([
        "resources/assets/bower/jquery/dist/jquery.js",
        "resources/assets/bower/bootstrap/dist/js/bootstrap.js",
        "resources/assets/bower/metisMenu/dist/metisMenu.js",
        "resources/assets/sbadmin/js/sb-admin-2.js",
    ])
    // .pipe(uglify())
    .pipe(concat('vendor.min.js'))
    .pipe(gulp.dest('public/assets/admin/'));

});

gulp.task('fonts', function() {
    return gulp.src("resources/assets/bower/font-awesome/fonts/*")
    .pipe(gulp.dest('public/assets/fonts'));
});