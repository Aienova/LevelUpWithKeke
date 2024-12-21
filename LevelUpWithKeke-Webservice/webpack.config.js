const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or subdirectory deploy
    //.setManifestKeyPrefix('build/')

    .copyFiles({
        from: './assets/media/',

        
       // optional target path, relative to the output dir
       to: 'media/[path][name].[ext]',

      // if versioning is enabled, add the file hash too
      //to: 'images/[path][name].[hash:8].[ext]',

        // only copy files matching this pattern
        //pattern: /\.(png|jpg|jpeg)$/
    })


    .copyFiles({
        from: './assets/fonts/',

        
       // optional target path, relative to the output dir
       to: 'fonts/[path][name].[ext]',

      // if versioning is enabled, add the file hash too
      //to: 'images/[path][name].[hash:8].[ext]',

        // only copy files matching this pattern
        //pattern: /\.(png|jpg|jpeg)$/
    })


    .copyFiles({
        from: './assets/mails/',

        
       // optional target path, relative to the output dir
       to: 'mails/[path][name].[ext]',

      // if versioning is enabled, add the file hash too
      //to: 'images/[path][name].[hash:8].[ext]',

        // only copy files matching this pattern
        //pattern: /\.(png|jpg|jpeg)$/
    })



    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('website-scripts', './assets/website.js')
    .addEntry('admin-scripts', './assets/admin.js')
    .addEntry('customer-area-scripts', './assets/customer-area.js')
    .addEntry('candidate-area-scripts', './assets/candidate-area.js')
    .addEntry('recruiter-area-scripts', './assets/recruiter-area.js')
    .addEntry('connection-scripts', './assets/connection.js')
    .addEntry('admin-connection-scripts', './assets/admin-connection.js')
    .addEntry('first-time-scripts', './assets/first-time.js')
    .addEntry('paypal-scripts', './assets/paypal.js')
    .addEntry('step', './assets/scripts/form/stepbystep.js')
    .addStyleEntry('customer-area-styles', './assets/styles/customer-area.scss')
    .addStyleEntry('website-styles', './assets/styles/website.scss')
    .addStyleEntry('pdf-styles', './assets/styles/pdf.scss') 
    .addStyleEntry('connection-styles', './assets/styles/connection.scss')
    .addStyleEntry('admin-connection-styles', './assets/styles/admin-connection.scss')
    .addStyleEntry('candidate-area-styles', './assets/styles/candidate-area.scss')
    .addStyleEntry('first-time-styles', './assets/styles/first-time.scss')
    .addStyleEntry('paypal-styles', './assets/styles/paypal.scss')
    .addStyleEntry('admin-styles', './assets/styles/admin.scss')
    .addStyleEntry('recruiter-area-styles', './assets/styles/recruiter-area.scss')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // configure Babel
    // .configureBabel((config) => {
    //     config.plugins.push('@babel/a-babel-plugin');
    // })

    // enables and configure @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
