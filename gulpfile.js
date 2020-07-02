let gulp = require('gulp');
let sass = require('gulp-sass');
let uglify = require('gulp-uglify');
let sourcemaps = require('gulp-sourcemaps');

gulp.task('sass', function(){
	return gulp.src('src/sass/albus-style.scss')
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('.'));
});


gulp.task('js', function() {
	return gulp.src(['src/js/*.js'])
		.pipe(uglify())
		.pipe(gulp.dest('js'));
});


gulp.task('watch', function() {
	gulp.watch('src/js/*.js', gulp.series('js'));
	gulp.watch('src/sass/**/*.scss', gulp.series('sass'));
});


gulp.task('default', gulp.series('sass', 'js', 'watch'));
