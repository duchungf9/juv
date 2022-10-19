let mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
require('laravel-mix-merge-manifest');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Fo development Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
   plugins: [
      new BrowserSyncPlugin({
         files: [
            './resources/**/*.blade.php',
            './resources/**/*.js',
            './resources/**/*.scss',
            './resources/**/*.css',
         ],
         host: 'localhost',
         port: 3000,
         proxy: 'https://fromsky.com'
      })
   ],
});


//if (mix.inProduction()) {
mix.sass('resources/sass/admin/vendor.scss', 'public/cms/css/')
   .js('resources/js/admin/cmsvendor.js', 'public/cms/js/cmsvendor.js')
   .version();
/*
 |--------------------------------------------------------------------------
 | Admin
 |--------------------------------------------------------------------------
 */

mix.sass('resources/sass/admin/app.scss', 'public/cms/css/')
   .js('resources/js/admin/cms.js', 'public/cms/js/cms.js')
   .js('resources/js/admin/header.js', 'public/cms/js/header.js')
   .js('resources/js/admin/lara-file-manager.js', 'public/cms/js')
   .js('resources/js/admin/appcms.js', 'public/cms/js/').vue();

//} else {
mix.options({
   processCssUrls: false,
});
//}

/*
 |--------------------------------------------------------------------------
 | Website
 |--------------------------------------------------------------------------
 */

/*mix.sass('resources/sass/website/vendor.scss', 'public/website/css')
   .js('resources/js/website/vendor.js', 'public/website/js')*/

/* mix.autoload({
      jquery: ['$', 'window.jQuery']
}); */
mix.sass('resources/sass/website/css/app.scss', 'public/css')
   .options({
      processCssUrls: true,
      postCss: [tailwindcss('./tailwind.config.js')],
   }).version();
mix.js('resources/js/website/app.js', 'public/js').react().version();
// mix.js('resources/js/plugins/sweetalert2.min.js', 'public/plugins/js');
// mix.js('resources/js/website/cart.js', 'public/website/js').vue();
// mix.js("resources/js/website/home/searchbox.js", 'public/website/js/home/').react().version();
// mix.js("resources/js/website/home/youtube_home.js", 'public/js/home/').react().version();;
mix.copyDirectory("resources/sass/website/images/icons", 'public/images/');

mix.mergeManifest();
