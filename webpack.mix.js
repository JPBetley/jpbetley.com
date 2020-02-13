let mix = require('laravel-mix');
let build = require('./tasks/build.js');
let tailwindcss = require('tailwindcss');
require('laravel-mix-purgecss');

mix.disableSuccessNotifications();
mix.setPublicPath('src/assets/build/');
mix.webpackConfig({
    plugins: [
        build.jigsaw,
        build.browserSync(),
        build.watch([
            'config.php',
            'src/**/*.md',
            'src/**/*.php',
            'src/**/*.scss',
        ]),
    ],
});

mix.js('src/_assets/js/main.js', 'js')
    .sourceMaps()
    .sass('src/_assets/sass/main.scss', 'css/main.css')
    .sourceMaps()
    .options({
        processCssUrls: false,
        postCss: [tailwindcss()],
    })
    .purgeCss({
        extensions: ['html', 'md', 'js', 'php', 'vue'],
        folders: ['source'],
        whitelistPatterns: [/language/, /hljs/, /mce/],
    })
    .version();
