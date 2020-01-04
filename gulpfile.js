var gulp = require( 'gulp' );
var plumber = require( 'gulp-plumber' );
var sass = require( 'gulp-sass' );
var watch = require( 'gulp-watch' );
var rename = require( 'gulp-rename' );
var concat = require( 'gulp-concat' );
var uglify = require( 'gulp-uglify' );
var sourcemaps = require( 'gulp-sourcemaps' );
var cleanCSS = require( 'gulp-clean-css' );
var gulpSequence = require( 'gulp-sequence' );
var autoprefixer = require( 'gulp-autoprefixer' );
var scrape = require('website-scraper');
var purgecss = require('gulp-purgecss');
var log = require('fancy-log');
var cfg = require( './gulpconfig.json' );
var paths = cfg.paths;


gulp.task( 'sass', function() {
    var stream = gulp.src( paths.sass + '/*.scss' )
        .pipe( plumber( {
            errorHandler: function( err ) {
                console.log( err );
                this.emit( 'end' );
            }
        } ) )
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe( sass( { errLogToConsole: true } ) )
        .pipe( autoprefixer( 'last 2 versions' ) )
        .pipe(sourcemaps.write(undefined, { sourceRoot: null }))

        .pipe( gulp.dest( paths.css ) )
    return stream;
});

gulp.task( 'watch', function() {
    gulp.watch( paths.sass + '/**/*.scss', ['styles'] );
    gulp.watch( [paths.dev + '/js/**/*.js', 'js/**/*.js', '!js/theme.js', '!js/theme.min.js'], ['scripts'] );
});


gulp.task( 'cssnano', function() {
  return gulp.src( paths.css + '/theme.css' )
    .pipe( sourcemaps.init( { loadMaps: true } ) )
    .pipe( plumber( {
            errorHandler: function( err ) {
                console.log( err );
                this.emit( 'end' );
            }
        } ) )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( cssnano( { discardComments: { removeAll: true } } ) )
    .pipe( sourcemaps.write( './' ) )
    .pipe( gulp.dest( paths.css ) );
});

gulp.task( 'minifycss', function() {
  return gulp.src( paths.css + '/theme.css' )
  .pipe( sourcemaps.init( { loadMaps: true } ) )
    .pipe( cleanCSS( { compatibility: '*' } ) )
    .pipe( plumber( {
            errorHandler: function( err ) {
                console.log( err ) ;
                this.emit( 'end' );
            }
        } ) )
    .pipe( rename( { suffix: '.min' } ) )
     .pipe( sourcemaps.write( './' ) )
    .pipe( gulp.dest( paths.css ) );
});

gulp.task( 'styles', function( callback ) {
   gulpSequence( 'sass', 'minifycss' )( callback );
} );


gulp.task( 'scripts', function() {
    var scripts = [
        paths.dev + '/js/jquery-3.4.1.js',
        paths.dev + '/js/isotope.js',
        paths.dev + '/js/balancetext.js',
        paths.dev + '/js/materialize-css/materialize.js',
        paths.dev + '/js/lazyload.js',
        paths.dev + '/js/custom-javascript.js'
    ];
  gulp.src( scripts )
    .pipe( concat( 'theme.min.js' ) )
    .pipe( uglify() )
    .pipe( gulp.dest( paths.js ) );

  gulp.src( scripts )
    .pipe( concat( 'theme.js' ) )
    .pipe( gulp.dest( paths.js ) );
});

class MyPlugin {
    apply(registerAction) {
        registerAction('getReference', async ({resource, parentResource, originalReference}) => {

            if(originalReference.indexOf('.wof2') ||
                originalReference.indexOf('.jpg') ||
                originalReference.indexOf('.png'))
            {
                return null;
            }
        })
    }
}

gulp.task( 'scrape', function() {
    scrape({
        urls: ['https://carmacodes.sk'],
        directory: './purgecss/scrape/',
        plugins: [ new MyPlugin() ],
        recursive: true,
        maxRecursiveDepth: 1,
        urlFilter: function(url){
            return url.indexOf('carmacodes.sk') !== -1;
        },

    }, (error, result) => {
        console.log(error);
    });
    return;
});



gulp.task('purgecss', () => {
    return gulp
        .src('./purgecss/scrape/css/*.css')
        .pipe(
            purgecss({
                content: ['./purgecss/scrape/*.html'],
                whitelist: ['hiddendiv', 'common'],
                whitelistPatternsChildren: [/invalid$/,/valid$/,/contact-form-response$/],
            })
        )
        .pipe(gulp.dest('./purgecss/'))
})

gulp.task('default', ['watch']);

