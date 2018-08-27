let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |


mix.js('resources/assets/js/app.js', 'public/js')
.extract(['vue']);

mix.postCss('resources/assets/css/list.css', 'public/css',[require('autoprefixer')]);
mix.options({
    postCss: [
        require('autoprefixer')({
            browsers: ['last 2 versions'],
            cascade: false
        })
    ]
});

mix.webpackConfig({
    resolve:{
        alias: {
        'vue-router$': 'vue-router/dist/vue-router.common.js'
        }
    }
});
 */

mix.js(['resources/assets/js/app.js'], 'public/js');
mix.copy(['resources/assets/js/pages/welcome.js','resources/assets/js/pages/addcate.js'],'public/js');
mix.copy(['resources/assets/css/*.css'],'public/css');

// mix.postCss('resources/assets/css/list.css', 'public/css',[require('autoprefixer')]);
mix.options({
    postCss: [
        require('autoprefixer')({
            browsers: ['last 2 versions'],
            cascade: false
        })
    ]
});