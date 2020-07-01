let gulp = require('gulp');
let sass = require('gulp-sass');
let uglify = require('gulp-uglify');


gulp.task('sass', function(){
	return gulp.src('src/sass/albus-style.scss')
		.pipe(sass())
		.pipe(gulp.dest('./'));
});


gulp.task('js', function() {
	return gulp.src(['src/js/*.js'])
		.pipe(uglify())
		.pipe(gulp.dest('js'));
});
