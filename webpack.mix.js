const mix = require('laravel-mix');
mix.options({
    uglify: {
        uglifyOptions: {
            compress: {
                drop_console: true
            }, output: {
                comments: false
            }
        }
    }
});
mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/frontend.js', 'public/js/frontend.js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/select2/layout.scss', 'public/css/select2')
    .version();

mix.styles('public/css/digitx.css', 'public/css/survey/app.css')
    .version();
