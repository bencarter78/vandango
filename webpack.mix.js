const {mix} = require('laravel-mix')
const tailwindcss = require('tailwindcss')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({output: {publicPath: '/'}})
  .js('resources/assets/js/main.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')
  .options({
    processCssUrls: false,
    postCss: [tailwindcss('./tailwind.js')]
  })
  .browserSync('vandango.test')
  .copy('node_modules/ace-builds/src-min', 'public/js/vendor/ace-editor')
  .copy('public/img/', 'public/build/img/')
  .copy('public/fonts/', 'public/build/fonts/')

if (mix.inProduction()) {
  mix.babel(['public/js/main.js'], 'public/js/main.js')
}

mix.version()
