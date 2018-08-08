let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
let { exec } = require('child_process');

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

mix.webpackConfig({
    resolve: {
        alias: {
            '~': path.resolve(__dirname, "resources/assets/js")
        }
    }
})

mix.setPublicPath('public')

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('tailwind.js')],
    })

if (mix.inProduction()) {
    mix.version()
} else {
    mix.sourceMaps()
        .disableSuccessNotifications()
}

mix.then(() => {
    exec('php artisan vendor:publish --force --provider AdamJedlicka\Admin\ServiceProvider')
})
