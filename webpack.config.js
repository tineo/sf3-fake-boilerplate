/*var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/build')

    // read main.js     -> output as web/build/app.js
    .addEntry('app', './assets/js/main.js')
    // read global.scss -> output as web/build/global.css
    .addStyleEntry('global', './assets/css/global.scss')

    // enable features!
    .enableSassLoader()
    .autoProvidejQuery()
    .enableReactPreset()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning() // hashed filenames (e.g. main.abc123.js)
;

module.exports = Encore.getWebpackConfig();
*/

// webpack.config.js
var Encore = require('@symfony/webpack-encore');

Encore
// directory where all compiled assets will be stored
    .setOutputPath('web/build/')

    // what's the public path to this directory (relative to your project's document root dir)
    .setPublicPath('/build')

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // will output as web/build/app.js
    .addEntry('app', './assets/js/main.js')

    // will output as web/build/global.css
    .addStyleEntry('global', './assets/css/global.scss')

    // allow sass/scss files to be processed
    .enableSassLoader()

    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()


    .configureBabel(function(babelConfig) {
      // add additional presets
      babelConfig.presets.push('es2017');

      // no plugins are added by default, but you can add some
      //babelConfig.plugins.push('styled-jsx/babel');
    })

    .enableSourceMaps(!Encore.isProduction())

    .enableSassLoader(function(sassOptions) {}, {
        resolve_url_loader: false
    })
    .enableReactPreset()

    .autoProvidejQuery()

// create hashed filenames (e.g. app.abc123.css)
// .enableVersioning()
;

// export the final configuration
module.exports = Encore.getWebpackConfig();