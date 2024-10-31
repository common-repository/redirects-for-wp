const gulp = require('gulp'),
	rename = require('gulp-rename'),
	zip = require('gulp-zip');

const name = 


// Zip files up
gulp.task('zip', function () {
	return gulp.src([
	  '*',
	  './assets/**/*',
	  './css/*',
	  './fonts/*',
	  './images/**/*',
	  './inc/**/*',
	  './js/**/*',
	  './languages/*',
	  './sass/**/*',
	  './template-parts/*',
	  './templates/*',
	  '!bower_components',
		'!node_modules',
		'!.babelrc',
		'!.editorconfig',
	  '!.eslintrc',
	  '!.eslintignore',
	  '!.gitignore',
	  '!.gitattributes',
	  '!.distignore',
	  '!.stylelintignore',
	  '!.stylelintrc.json',
	  '!composer.json',
	  '!gulpfile.js',
	  '!package-lock.json',
	  '!package.json',
	  '!phpcs.xml.dist',
	  '!phpstan.neon.dist',
	  '!postcss.config.js',
	  '!.prettierrc.json',
	  '!prepros.config',
	  '!webpack.config.js',
	  '!.eslintrc.json',
	 ], {base: "."})
	 .pipe(zip('301-redirects-for-wp.zip'))
	 .pipe(gulp.dest('../'));
});

gulp.task(
	'default',
	gulp.series(
		'zip'
	)
);
