var gulp = require('gulp'),
    connect = require('gulp-connect-php'),
    browserSync = require('browser-sync');

gulp.task('connect-sync', function() {
    connect.server({}, function (){
        browserSync({
            directory: '.',
            proxy: '127.0.0.1:8000'
        });
    });

    gulp.watch('**/*').on('change', function () {
        browserSync.reload();
    });
});
