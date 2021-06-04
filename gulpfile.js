/**
 * Setup
 */

// Requiring gulp
const { series, src, dest, watch, task } = require('gulp');
const gulp = require('gulp');


// Plugins
const newer = require('gulp-newer');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const notify = require('gulp-notify');
const browserSync = require('browser-sync').create();
const imagesConvert = require('gulp-images-convert');
const imageMin = require('gulp-imagemin');

const uglify = require('gulp-uglify-es').default;
const concat = require('gulp-concat');
const babel = require('gulp-babel');

const sass = require('gulp-sass');
sass.compiler = require('node-sass');
const cleanCSS = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer');

// Paths
const imagePath = 'library/images/';
const scriptPath = 'library/js/';
const stylesPath = 'library/scss/';
const outputPath = 'library/dist/';


/**
 * Image Compression
 * Images in /raw will be compressed and placed in /compressed
 */

// Compress and move to /images/compressed
function images() {
  return src(imagePath + 'raw/*')
    .pipe( newer(imagePath + 'compressed/') )
    .pipe( imageMin( {
      optimizationLevel: 4,
      verbose: true
    } ) )
    .pipe( dest(imagePath + 'compressed/') )
    .pipe( notify({ message: '\n\n✅  ===> Images Compressed!\n', onLast: true }) );
};


/**
 * PNG to JPEG Conversion
 */

function pngToJpeg() {
  return src(imagePath + 'png/*.png')
    .pipe( imagesConvert({targetType: 'jpg'}) )
    .pipe( rename({extname: '.jpg'}) )
    .pipe( dest(imagePath + 'compressed/') )
    .pipe( notify({ message: '\n\n✅  ===> PNGs converted to JPG!\n', onLast: true }) );
};


/**
 * Javascript
 */

// Concatenate and uglify js. Move to /dist/
function scripts() {
  return src([scriptPath + '*.js', scriptPath + 'page/*.js', scriptPath + 'vendor/*.js', scriptPath + 'animation/*.js'])
    .pipe(sourcemaps.init())
    // .pipe(babel({
      // presets: ['@babel/preset-env'],
    // }))
    .pipe(uglify())
    .pipe(concat('main.js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(sourcemaps.write())
    .pipe( dest(outputPath + 'js/') )
    .pipe( notify({ message: '\n\n✅  ===> Javascript concatenated and minified!\n', onLast: true }) );
};



/**
 * CSS
 */

// Compile SASS to CSS. Writes a sourcemap. Autoprefix.
// Minify CSS. Add suffix '.min'. Move to /css/min
function styles() {
    return src(stylesPath + 'styles.scss')
      .pipe( sourcemaps.init() )
      .pipe( sass().on('error', sass.logError) )
      .pipe( cleanCSS({compatibility: 'ie8'}) )
      .pipe( autoprefixer() )
      .pipe( rename({suffix: '.min'}) )
      .pipe( sourcemaps.write('./') )
      .pipe( dest(outputPath + 'css/') )
      .pipe( notify({ message: '\n\n✅  ===> SASS compiled, modernized and minified!\n', onLast: true }) );
};


/**
 * BrowserSync Browser Auto-Refresh
 */




/**
 * Watch
 */

 // Watch all sass files
 watch([stylesPath + '**/*.scss', stylesPath + 'styles.scss'], styles);

 // Watch js files, ignoring subfolders
 watch([scriptPath + '*.js'], scripts);

 // Watch all images in /raw
 watch([imagePath + 'raw/*'], images);

 // Watch images in /png
 watch([imagePath + 'png/*'], pngToJpeg);

/**
 * Create gulp commands
 */

exports.images = images;
exports.scripts = scripts;
exports.styles = styles;
exports.default = series(scripts, styles, images);

// exports.default = function() {
//   watch(stylesPath + 'sass/**/*.scss', styles);
// }
