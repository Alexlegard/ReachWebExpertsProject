const mix = require('laravel-mix');

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

mix.sass('resources/sass/main.scss', 'public/css/sass')
    .sass('resources/sass/app.scss', 'public/css/sass')
	.sass('resources/sass/base/typography.scss', 'public/css/sass/base')
	.sass('resources/sass/base/_colors.scss', 'public/css/sass/base')
	.sass('resources/sass/base/_body.scss', 'public/css/sass/base')
	.sass('resources/sass/layout/storelayout/bottom-nav.scss', 'public/css/sass/layout/storelayout')
	.sass('resources/sass/layout/userprofile/sidebar.scss', 'public/css/sass/layout/userprofile')
	.sass('resources/sass/layout/userprofile/content.scss', 'public/css/sass/layout/userprofile')
	.sass('resources/sass/components/_headers.scss', 'public/css/sass/components')
	.sass('resources/sass/components/_links.scss', 'public/css/sass/components')
	.sass('resources/sass/components/_tables.scss', 'public/css/sass/components')
	.sass('resources/sass/components/buttons.scss', 'public/css/sass/components')
	.sass('resources/sass/components/charts.scss', 'public/css/sass/components')
	.sass('resources/sass/components/content-box.scss', 'public/css/sass/components')
	.sass('resources/sass/components/store/_navbar.scss', 'public/css/sass/components/store')
	.sass('resources/sass/components/store/_top-panel.scss', 'public/css/sass/components/store')
	.sass('resources/sass/components/store/dish-details.scss', 'public/css/sass/components/store')
	.sass('resources/sass/components/icons.scss', 'public/css/sass/components')
	.sass('resources/sass/pages/checkout.scss', 'public/css/sass/pages')
	.sass('resources/sass/pages/cart.scss', 'public/css/sass/pages')
	.sass('resources/sass/pages/store/welcome.scss', 'public/css/sass/pages/store')
	.sass('resources/sass/pages/store/show-restaurant.scss', 'public/css/sass/pages/store')
	.sass('resources/sass/pages/store/_list-dishes.scss', 'public/css/sass/pages/store')
	.sass('resources/sass/pages/user-profile/profile.scss', 'public/css/sass/pages/user-profile');

// Use Font Awesome
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');