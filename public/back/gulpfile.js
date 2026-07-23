import gulp from 'gulp';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

import { create as bsCreate } from 'browser-sync';
const browserSync = bsCreate();

import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);

import sourcemaps from 'gulp-sourcemaps';
import inject from 'gulp-inject';
import injectPartials from 'gulp-inject-partials';
import replace from 'gulp-replace';
import { deleteAsync } from 'del';
import concat from 'gulp-concat';
import rename from "gulp-rename";
import cleanCSS from 'gulp-clean-css';
import rtlcss from 'gulp-rtlcss';








// --------------------------------------------------------------------------------------------------------------
// Demo1 - Serve, Watch
// --------------------------------------------------------------------------------------------------------------

// DEMO1 - Watch for changes in the SCSS files
gulp.task('sass:demo1', () => {
    return gulp.src(
        [
            'assets/scss/demo1/**/*.scss',
            'assets/scss/common/**/*.scss'
        ]
    )
        .pipe(sourcemaps.init())
        .pipe(sass({
            includePaths: [path.join(__dirname, 'node_modules')],
            loadPaths: [path.join(__dirname, 'node_modules')],
            silenceDeprecations: ['legacy-js-api', 'color-functions', 'global-builtin', 'import', 'if-function'],
        }).on('error', sass.logError))
        .pipe(cleanCSS({ compatibility: 'ie8' })) // Minify css
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./assets/css/demo1'))
        .pipe(browserSync.reload({ stream: true }));
});

// DEMO1 - Serve and open in browser
gulp.task('serve:demo1', gulp.series(['sass:demo1'], () => {

    browserSync.init({
        server: './',
        startPath: './demo1/dashboard.html'
    });

    gulp.watch(
        [
            'assets/scss/demo1/**/*.scss',
            'assets/scss/common/**/*.scss'
        ],
        gulp.series('sass:demo1')
    )

    gulp.watch('**/*.html').on('change', browserSync.reload);
    gulp.watch('assets/js/**/*.js').on('change', browserSync.reload);
}));
// --------------------------------------------------------------------------------------------------------------








// --------------------------------------------------------------------------------------------------------------
// Demo2 - Serve, Watch
// --------------------------------------------------------------------------------------------------------------

// DEMO2 - Watch for changes in the SCSS files
gulp.task('sass:demo2', () => {
    return gulp.src(
        [
            'assets/scss/demo2/**/*.scss',
            'assets/scss/common/**/*.scss'
        ]
    )
        .pipe(sourcemaps.init())
        .pipe(sass({
            includePaths: [path.join(__dirname, 'node_modules')],
            loadPaths: [path.join(__dirname, 'node_modules')],
            silenceDeprecations: ['legacy-js-api', 'color-functions', 'global-builtin', 'import', 'if-function'],
        }).on('error', sass.logError))
        .pipe(cleanCSS({ compatibility: 'ie8' })) // Minify css
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./assets/css/demo2'))
        .pipe(browserSync.reload({ stream: true }));
});

// DEMO2 - Serve and open in browser
gulp.task('serve:demo2', gulp.series(['sass:demo2'], () => {

    browserSync.init({
        server: './',
        startPath: './demo2/dashboard.html'
    });

    gulp.watch(
        [
            'assets/scss/demo2/**/*.scss',
            'assets/scss/common/**/*.scss'
        ],
        gulp.series('sass:demo2')
    )

    gulp.watch('**/*.html').on('change', browserSync.reload);
    gulp.watch('assets/js/**/*.js').on('change', browserSync.reload);
}));
// --------------------------------------------------------------------------------------------------------------








// --------------------------------------------------------------------------------------------------------------
// Demo1 + Demo2 - Serve, Watch
// --------------------------------------------------------------------------------------------------------------

// Watch for changes in the SCSS files
gulp.task('sass', () => {
    return gulp.src('assets/scss/**/style.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({
            includePaths: [path.join(__dirname, 'node_modules')],
            loadPaths: [path.join(__dirname, 'node_modules')],
            silenceDeprecations: ['legacy-js-api', 'color-functions', 'global-builtin', 'import', 'if-function'],
        }).on('error', sass.logError))
        .pipe(cleanCSS({ compatibility: 'ie8' })) // Minify css
        // .pipe(rename({ extname: '.min.css' }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./assets/css'))
        .pipe(browserSync.reload({ stream: true }));
});

// Serve and open in browser
gulp.task('serve', gulp.series('sass', () => {

    browserSync.init({
        port: 3000,
        server: './',
        notify: true,
        ghostMode: true
    });

    gulp.watch('assets/scss/**/*.scss', gulp.series('sass'));
    gulp.watch('**/*.html').on('change', browserSync.reload);
    gulp.watch('assets/js/**/*.js').on('change', browserSync.reload);
}));
// --------------------------------------------------------------------------------------------------------------








// --------------------------------------------------------------------------------------------------------------
// Demo1-RTL - Serve, Watch
// --------------------------------------------------------------------------------------------------------------

// DEMO1-RTL - Watch for changes in the SCSS files
gulp.task('sass:demo1-rtl', () => {
    return gulp.src(
        [
            'assets/scss/demo1/**/*.scss',
            'assets/scss/common/**/*.scss'
        ]
    )
        .pipe(sass({
            includePaths: [path.join(__dirname, 'node_modules')],
            loadPaths: [path.join(__dirname, 'node_modules')],
            silenceDeprecations: ['legacy-js-api', 'color-functions', 'global-builtin', 'import', 'if-function'],
        }).on('error', sass.logError))
        .pipe(rtlcss()) // css to rtl-css
        // .pipe(cleanCSS({compatibility: 'ie8'})) // Minify css
        .pipe(rename({ suffix: '-rtl' }))
        .pipe(gulp.dest('./assets/css/demo1'))
        .pipe(browserSync.reload({ stream: true }));
});

// DEMO1-RTL - Serve and open in browser
gulp.task('serve:demo1-rtl', gulp.series(['sass:demo1-rtl'], () => {

    browserSync.init({
        server: './',
        startPath: './demo1-rtl/dashboard.html'
    });

    gulp.watch(
        [
            'assets/scss/demo1/**/*.scss',
            'assets/scss/common/**/*.scss'
        ],
        gulp.series('sass:demo1-rtl')
    )

    gulp.watch('**/*.html').on('change', browserSync.reload);
    gulp.watch('assets/js/**/*.js').on('change', browserSync.reload);
}));
// --------------------------------------------------------------------------------------------------------------








// --------------------------------------------------------------------------------------------------------------
// Demo2-RTL - Serve, Watch
// --------------------------------------------------------------------------------------------------------------

// DEMO2-RTL - Watch for changes in the SCSS files
gulp.task('sass:demo2-rtl', () => {
    return gulp.src(
        [
            'assets/scss/demo2/**/*.scss',
            'assets/scss/common/**/*.scss'
        ]
    )
        .pipe(sass({
            includePaths: [path.join(__dirname, 'node_modules')],
            loadPaths: [path.join(__dirname, 'node_modules')],
            silenceDeprecations: ['legacy-js-api', 'color-functions', 'global-builtin', 'import', 'if-function'],
        }).on('error', sass.logError))
        .pipe(rtlcss()) // css to rtl-css
        // .pipe(cleanCSS({compatibility: 'ie8'})) // Minify css
        .pipe(rename({ suffix: '-rtl' }))
        .pipe(gulp.dest('./assets/css/demo2'))
        .pipe(browserSync.reload({ stream: true }));
});

// DEMO2-RTL - Serve and open in browser
gulp.task('serve:demo2-rtl', gulp.series(['sass:demo2-rtl'], () => {

    browserSync.init({
        server: './',
        startPath: './demo2-rtl/dashboard.html'
    });

    gulp.watch(
        [
            'assets/scss/demo2/**/*.scss',
            'assets/scss/common/**/*.scss'
        ],
        gulp.series('sass:demo2-rtl')
    )

    gulp.watch('**/*.html').on('change', browserSync.reload);
    gulp.watch('assets/js/**/*.js').on('change', browserSync.reload);
}));
// --------------------------------------------------------------------------------------------------------------








// --------------------------------------------------------------------------------------------------------------
// DEMO1-RTL + DEMO2-RTL - Serve, Watch
// --------------------------------------------------------------------------------------------------------------

// Watch for changes in the SCSS files
gulp.task('scss:rtl', () => {
    return gulp.src('assets/scss/**/style.scss')
        .pipe(sass({
            includePaths: [path.join(__dirname, 'node_modules')],
            loadPaths: [path.join(__dirname, 'node_modules')],
            silenceDeprecations: ['legacy-js-api', 'color-functions', 'global-builtin', 'import', 'if-function'],
        }).on('error', sass.logError))
        .pipe(rtlcss()) // css to rtl-css
        // .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(rename({ suffix: '-rtl' }))
        .pipe(gulp.dest('./assets/css'))
        .pipe(browserSync.reload({ stream: true }));
});

// Serve and open in browser
gulp.task('serve:rtl', gulp.series('scss:rtl', () => {

    browserSync.init({
        port: 3000,
        server: './',
        startPath: './demo1-rtl/dashboard.html',
        notify: false,
        ghostMode: true
    });

    gulp.watch('assets/scss/**/*.scss', gulp.series('scss:rtl'));
    gulp.watch('**/*.html').on('change', browserSync.reload);
    gulp.watch('assets/js/**/*.js').on('change', browserSync.reload);
}));
// --------------------------------------------------------------------------------------------------------------








// --------------------------------------------------------------------------------------------------------------
// Inject partials, Replace paths, Inject common assets
// --------------------------------------------------------------------------------------------------------------

// Inject navbar, sidebar, footer - START
gulp.task('injectPartials', () => {
    return gulp.src("./**/*.html", { base: "./" })
        .pipe(injectPartials())
        .pipe(gulp.dest("."));
});

// Replace link paths after inject navbar, sidebar - START
gulp.task('replacePaths', gulp.parallel(
    () => gulp.src('./*/pages/*/*.html', { base: './' })
        .pipe(replace('="assets/', '="../../../assets/'))
        .pipe(replace('href="demo', 'href="../../../demo'))
        .pipe(replace('href="pages/', 'href="../../pages/'))
        .pipe(replace('href="dashboard.html', 'href="../../dashboard.html'))
        .pipe(gulp.dest('.')),
    () => gulp.src('./*/pages/*.html', { base: './' })
        .pipe(replace('="assets/', '="../../assets/'))
        .pipe(replace('href="demo', 'href="../../demo'))
        .pipe(replace('href="pages/', 'href="../../pages/'))
        .pipe(replace('href="dashboard.html', 'href="../dashboard.html'))
        .pipe(gulp.dest('.')),
    () => gulp.src('./*/*.html', { base: './' })
        .pipe(replace('="assets/', '="../assets/'))
        .pipe(replace('href="demo', 'href="../demo'))
        .pipe(gulp.dest('.'))
));

// Inject essential assets - START
gulp.task('injectCommonAssets', () => {
    return gulp.src(['./**/*.html', '!node_modules/**/*.html', '!assets/**/*.html'])
        .pipe(inject(gulp.src([
            './assets/vendors/core/core.css',
            './assets/vendors/core/core.js'
        ], { read: false }), { name: 'core', relative: true }))
        .pipe(inject(gulp.src(['./assets/js/color-modes.js'], { read: false }), { name: 'color-modes', relative: true }))
        .pipe(inject(gulp.src([
            './assets/js/app.js',
        ], { read: false }), { relative: true }))
        .pipe(gulp.dest('.'));
});

gulp.task('inject', gulp.series('injectPartials', 'replacePaths', 'injectCommonAssets'));
// --------------------------------------------------------------------------------------------------------------








// --------------------------------------------------------------------------------------------------------------
// Clean vendors, Build core css, Build core js, Copy Addons
// --------------------------------------------------------------------------------------------------------------

// Remove all from vendors folder - START
gulp.task('cleanVendors', () => {
    return deleteAsync([
        './assets/vendors/**/*'
    ]);
});

// Build essential styles - START
gulp.task('buildCoreCss', () => {
    return gulp.src([
        './node_modules/perfect-scrollbar/css/perfect-scrollbar.css'
    ])
        .pipe(cleanCSS({ compatibility: 'ie8' }))
        .pipe(concat('core.css'))
        .pipe(gulp.dest('./assets/vendors/core'));
});

// Built essential script - START
gulp.task('buildCoreJs', () => {
    return gulp.src([
        './node_modules/lucide/dist/umd/lucide.min.js',
        './node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
        './node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js',
    ])
        .pipe(concat('core.js'))
        .pipe(gulp.dest('./assets/vendors/core'));
});

// Copy css and js files of npm packages from node_modules folder to assets/vendors folder - START
gulp.task('copyAddons', gulp.parallel(
    () => gulp.src('./node_modules/@mdi/font/css/materialdesignicons.min.css').pipe(gulp.dest('./assets/vendors/mdi/css')),
    () => gulp.src('./node_modules/@mdi/font/fonts/*', { encoding: false }).pipe(gulp.dest('./assets/vendors/mdi/fonts')),
    () => gulp.src('./node_modules/@simonwep/pickr/dist/pickr.min.js').pipe(gulp.dest('./assets/vendors/pickr')),
    () => gulp.src('./node_modules/@simonwep/pickr/dist/themes/*').pipe(gulp.dest('./assets/vendors/pickr/themes')),
    () => gulp.src('./node_modules/ace-builds/src-min/**/*').pipe(gulp.dest('./assets/vendors/ace-builds/src-min')),
    () => gulp.src('./node_modules/animate.css/animate.min.css').pipe(gulp.dest('./assets/vendors/animate.css')),
    () => gulp.src('./node_modules/apexcharts/dist/apexcharts.min.js').pipe(gulp.dest('./assets/vendors/apexcharts')),
    () => gulp.src('./node_modules/bootstrap-maxlength/dist/bootstrap-maxlength.min.js').pipe(gulp.dest('./assets/vendors/bootstrap-maxlength')),
    () => gulp.src('./node_modules/chart.js/dist/chart.umd.js').pipe(gulp.dest('./assets/vendors/chartjs')),
    () => gulp.src('./node_modules/clipboard/dist/clipboard.min.js').pipe(gulp.dest('./assets/vendors/clipboard')),
    () => gulp.src(['./node_modules/cropperjs/dist/cropper.min.js']).pipe(gulp.dest('./assets/vendors/cropperjs')),
    () => gulp.src('./node_modules/datatables.net/js/dataTables.js').pipe(gulp.dest('./assets/vendors/datatables.net')),
    () => gulp.src(['./node_modules/datatables.net-bs5/css/dataTables.bootstrap5.css', './node_modules/datatables.net-bs5/js/dataTables.bootstrap5.js']).pipe(gulp.dest('./assets/vendors/datatables.net-bs5')),
    () => gulp.src(['./node_modules/dropify/dist/css/dropify.min.css', './node_modules/dropify/dist/js/dropify.min.js']).pipe(gulp.dest('./assets/vendors/dropify/dist')),
    () => gulp.src('./node_modules/dropify/dist/fonts/*', { encoding: false }).pipe(gulp.dest('./assets/vendors/dropify/fonts')),
    () => gulp.src(['./node_modules/dropzone/dist/dropzone.css', './node_modules/dropzone/dist/dropzone-min.js']).pipe(gulp.dest('./assets/vendors/dropzone')),
    () => gulp.src(['./node_modules/easymde/dist/easymde.min.css', './node_modules/easymde/dist/easymde.min.js']).pipe(gulp.dest('./assets/vendors/easymde')),
    () => gulp.src('./node_modules/flag-icons/css/flag-icons.min.css').pipe(gulp.dest('./assets/vendors/flag-icons/css')),
    () => gulp.src('./node_modules/flag-icons/flags/**/*').pipe(gulp.dest('./assets/vendors/flag-icons/flags')),
    () => gulp.src(['./node_modules/flatpickr/dist/flatpickr.min.css', './node_modules/flatpickr/dist/flatpickr.min.js']).pipe(gulp.dest('./assets/vendors/flatpickr')),
    () => gulp.src('./node_modules/font-awesome/css/font-awesome.min.css').pipe(gulp.dest('./assets/vendors/font-awesome/css')),
    () => gulp.src('./node_modules/font-awesome/fonts/*').pipe(gulp.dest('./assets/vendors/font-awesome/fonts')),
    () => gulp.src('./node_modules/fullcalendar/index.global.min.js').pipe(gulp.dest('./assets/vendors/fullcalendar')),
    () => gulp.src('./node_modules/inputmask/dist/jquery.inputmask.min.js').pipe(gulp.dest('./assets/vendors/inputmask')),
    () => gulp.src('./node_modules/jquery/dist/jquery.min.js').pipe(gulp.dest('./assets/vendors/jquery')),
    () => gulp.src('./node_modules/jquery-mousewheel/jquery.mousewheel.js').pipe(gulp.dest('./assets/vendors/jquery-mousewheel')),
    () => gulp.src('./node_modules/jquery-sparkline/jquery.sparkline.min.js').pipe(gulp.dest('./assets/vendors/jquery-sparkline')),
    () => gulp.src(['./node_modules/jquery-steps/demo/css/jquery.steps.css', './node_modules/jquery-steps/build/jquery.steps.min.js']).pipe(gulp.dest('./assets/vendors/jquery-steps')),
    () => gulp.src('./node_modules/jquery-tags-input/dist/*').pipe(gulp.dest('./assets/vendors/jquery-tags-input')),
    () => gulp.src('./node_modules/jquery-validation/dist/jquery.validate.min.js').pipe(gulp.dest('./assets/vendors/jquery-validation')),
    () => gulp.src(['./node_modules/jquery.flot/jquery.flot.js', './node_modules/jquery.flot/jquery.flot.resize.js', './node_modules/jquery.flot/jquery.flot.pie.js', './node_modules/jquery.flot/jquery.flot.categories.js']).pipe(gulp.dest('./assets/vendors/jquery.flot')),
    () => gulp.src('./node_modules/moment/min/moment.min.js').pipe(gulp.dest('./assets/vendors/moment')),
    () => gulp.src(['./node_modules/owl.carousel/dist/assets/owl.carousel.min.css', './node_modules/owl.carousel/dist/assets/owl.theme.default.min.css', './node_modules/owl.carousel/dist/owl.carousel.min.js']).pipe(gulp.dest('./assets/vendors/owl.carousel')),
    () => gulp.src('./node_modules/peity/jquery.peity.min.js').pipe(gulp.dest('./assets/vendors/peity')),
    () => gulp.src('./node_modules/prismjs/prism.js').pipe(gulp.dest('./assets/vendors/prismjs')),
    () => gulp.src('./node_modules/prism-themes/themes/prism-coldark-dark.css').pipe(gulp.dest('./assets/vendors/prism-themes')),
    () => gulp.src(['./node_modules/select2/dist/css/select2.min.css', './node_modules/select2/dist/js/select2.min.js']).pipe(gulp.dest('./assets/vendors/select2')),
    () => gulp.src('./node_modules/sortablejs/Sortable.min.js').pipe(gulp.dest('./assets/vendors/sortablejs')),
    () => gulp.src(['./node_modules/sweetalert2/dist/sweetalert2.min.css', './node_modules/sweetalert2/dist/sweetalert2.min.js']).pipe(gulp.dest('./assets/vendors/sweetalert2')),
    () => gulp.src('./node_modules/tinymce/**/*').pipe(gulp.dest('./assets/vendors/tinymce')),
    () => gulp.src('./node_modules/typeahead.js/dist/typeahead.bundle.min.js').pipe(gulp.dest('./assets/vendors/typeahead.js'))
));

gulp.task('copyVendors', gulp.series('cleanVendors', 'buildCoreCss', 'buildCoreJs', 'copyAddons'));
// --------------------------------------------------------------------------------------------------------------





// Default task
gulp.task('default', gulp.series('serve:demo1'));