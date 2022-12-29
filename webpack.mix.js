let mix = require('laravel-mix');
let polyfill = require('laravel-mix-polyfill');
let del = require('del');

mix
    .setResourceRoot('../')

    .scripts([
        // Vendors
        'resources/assets/vendor/jquery.min.js',
        'resources/assets/vendor/jquery-ui/jquery-ui.js',
        'resources/assets/vendor/jquery.ui.touch-punch.min.js',
        'resources/assets/vendor/jquery.mask.min.js',
        'resources/assets/vendor/jquery.maskMoney.min.js',
        'resources/assets/vendor/popper.min.js',
        'resources/assets/vendor/bootstrap/bootstrap.js',
        'node_modules/bootbox/dist/bootbox.all.min.js',
        'resources/assets/vendor/toastr.js/toastr.min.js',

        // App
        'resources/assets/js/app.js',
    ], 'public/js/main.js')

    .scripts([
        // Vendors
        'resources/assets/vendor/jquery.min.js',
        'resources/assets/vendor/jquery-ui/jquery-ui.js',
        'resources/assets/vendor/jquery.ui.touch-punch.min.js',
        'resources/assets/vendor/jquery.mask.min.js',
        'resources/assets/vendor/jquery.maskMoney.min.js',
        'resources/assets/vendor/popper.min.js',
        'resources/assets/vendor/bootstrap/bootstrap.js',
        'node_modules/bootbox/dist/bootbox.all.min.js',
        'resources/assets/vendor/toastr.js/toastr.min.js',
        'resources/assets/vendor/unison-js/unison-js.min.js',
        'resources/assets/vendor/feather-icons/feather-icons.min.js',
        'resources/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js',
        'resources/assets/vendor/dropzone/dropzone.js',
        'resources/assets/vendor/jquery.loading.js',

        // Theme
        'resources/assets/vendor/vuexy/js/core/app-menu.js',
        'resources/assets/vendor/vuexy/js/core/app.js',

        // Common
        'resources/assets/js/app.js',

        // App
        'resources/assets/js/admin-dashboard/functions.js',
        'resources/assets/js/admin-dashboard/common.js',

        // Custom
        'resources/assets/js/admin-dashboard/media-upload.js'
    ], 'public/js/admin-dashboard.js')

    .scripts([
        // Vendors
        'resources/assets/vendor/jquery.min.js',
        'resources/assets/vendor/jquery-ui/jquery-ui.js',
        'resources/assets/vendor/jquery.ui.touch-punch.min.js',
        'resources/assets/vendor/jquery.mask.min.js',
        'resources/assets/vendor/jquery.maskMoney.min.js',
        'resources/assets/vendor/popper.min.js',
        'resources/assets/vendor/bootstrap/bootstrap.js',
        'node_modules/bootbox/dist/bootbox.all.min.js',
        'node_modules/sweetalert2/dist/sweetalert2.all.js',
        'resources/assets/vendor/toastr.js/toastr.min.js',
        'resources/assets/vendor/unison-js/unison-js.min.js',
        'resources/assets/vendor/feather-icons/feather-icons.min.js',
        'resources/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js',
        'resources/assets/vendor/jquery.loading.js',

        // Theme
        'resources/assets/vendor/vuexy/js/core/app-menu.js',
        'resources/assets/vendor/vuexy/js/core/app.js',

        // Common
        'resources/assets/js/app.js',

        // App
        'resources/assets/js/player-dashboard/common.js',

        // Custom
        // 'resources/assets/js/player-dashboard/custom.js'
    ], 'public/js/player-dashboard.js')

    .sass('resources/assets/scss/admin-dashboard/admin-dashboard.scss', 'public/css/admin-dashboard--compiled.css')
    .sass('resources/assets/scss/player-dashboard/player-dashboard.scss', 'public/css/player-dashboard--compiled.css')

    .styles([

        // Vendors
        'resources/assets/vendor/bootstrap/bootstrap.css',
        'resources/assets/vendor/fontawesome/css/all.css',
        'resources/assets/vendor/jquery-ui/jquery-ui.css',
        'resources/assets/vendor/toastr.js/toastr.min.css',
        'resources/assets/vendor/feather-icons/feather-icons.min.css',
        'resources/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.css',
        'resources/assets/vendor/dropzone/dropzone.css',

        // Theme
        'resources/assets/vendor/vuexy/css/bootstrap-extended.css',
        'resources/assets/vendor/vuexy/css/colors.css',
        'resources/assets/vendor/vuexy/css/components.css',
        'resources/assets/vendor/vuexy/css/themes/dark-layout.css',
        'resources/assets/vendor/vuexy/css/themes/bordered-layout.css',
        'resources/assets/vendor/vuexy/css/themes/semi-dark-layout.css',
        'resources/assets/vendor/vuexy/css/core/menu/menu-types/vertical-menu.css',
        'resources/assets/vendor/vuexy/css/plugins/forms/form-validation.css',
        'resources/assets/vendor/vuexy/css/pages/page-auth.css',

        // Compiled
        'public/css/admin-dashboard--compiled.css',

    ], 'public/css/admin-dashboard.css').then(() => {
        del('public/css/admin-dashboard--compiled.css');
    })

    .styles([

        // Vendors
        'resources/assets/vendor/bootstrap/bootstrap.css',
        'resources/assets/vendor/fontawesome/css/all.css',
        'resources/assets/vendor/jquery-ui/jquery-ui.css',
        'resources/assets/vendor/toastr.js/toastr.min.css',
        'resources/assets/vendor/feather-icons/feather-icons.min.css',
        'resources/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.css',
        'node_modules/sweetalert2/dist/sweetalert2.min.css',

        // Theme
        'resources/assets/vendor/vuexy/css/bootstrap-extended.css',
        'resources/assets/vendor/vuexy/css/colors.css',
        'resources/assets/vendor/vuexy/css/components.css',
        'resources/assets/vendor/vuexy/css/themes/dark-layout.css',
        'resources/assets/vendor/vuexy/css/themes/bordered-layout.css',
        'resources/assets/vendor/vuexy/css/themes/semi-dark-layout.css',
        'resources/assets/vendor/vuexy/css/core/menu/menu-types/horizontal-menu.css',
        'resources/assets/vendor/vuexy/css/plugins/forms/form-validation.css',
        'resources/assets/vendor/vuexy/css/pages/page-auth.css',

        // Compiled
        'public/css/player-dashboard--compiled.css',

    ], 'public/css/player-dashboard.css').then(() => {
        del('public/css/player-dashboard--compiled.css');
    })

    .polyfill({
        enabled: true,
        useBuiltIns: "usage",
        targets: {"firefox": "50", "ie": 11}
    })

    .copyDirectory('resources/assets/vendor/fontawesome/webfonts', 'public/fonts/fontawesome')

    .version();