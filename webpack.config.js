const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
module.exports = {
  mode: 'development',
  watch: true,
  entry: {
    'js/app' : './src/js/app.js',
    'js/inicio' : './src/js/inicio.js',
    'js/login/index' : './src/js/login/index.js',
    'js/protocolos/index' : './src/js/protocolos/index.js',
    'js/casamientos/index' : './src/js/casamientos/index.js',
    'js/salidapaises/index' : './src/js/salidapaises/index.js',
    'js/motivos/index' : './src/js/motivos/index.js',
    'js/articulos/index' : './src/js/articulos/index.js',
    'js/transportes/index' : './src/js/transportes/index.js',
    'js/tiposol/index' : './src/js/tiposol/index.js',
    'js/busquedasc/index' : './src/js/busquedasc/index.js',
    'js/busquedaslict/index' : './src/js/busquedaslict/index.js',
    'js/busquedasalpais/index' : './src/js/busquedasalpais/index.js',
    'js/busquedasproto/index' : './src/js/busquedasproto/index.js',
    'js/licencias/index' : './src/js/licencias/index.js',
    'js/administraciones/index' : './src/js/administraciones/index.js',
    'js/administraciones/estadistica' : './src/js/administraciones/estadistica.js',
    'js/administraciones/direcciongeneral' : './src/js/administraciones/direcciongeneral.js',
    'js/historiales/index' : './src/js/historiales/index.js',
    'js/historialdp/index' : './src/js/historialdp/index.js',
    'js/historialmdn/index' : './src/js/historialmdn/index.js',
    'js/protocolosol/index' : './src/js/protocolosol/index.js',
    'js/direccionpersonal/index' : './src/js/direccionpersonal/index.js',
    'js/direccionpersonal/estadistica' : './src/js/direccionpersonal/estadistica.js',
    'js/direccionpersonal/mdn' : './src/js/direccionpersonal/mdn.js',
    'js/mdn/estadistica' : './src/js/mdn/estadistica.js',
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'public/build')
  },
  plugins: [
    new MiniCssExtractPlugin({
        filename: 'styles.css'
    })
  ],
  module: {
    rules: [
      {
        test: /\.(c|sc|sa)ss$/,
        use: [
            {
                loader: MiniCssExtractPlugin.loader
            },
            'css-loader',
            'sass-loader'
        ]
      },
      {
        test: /\.(png|svg|jpg|gif)$/,
        loader: 'file-loader',
        options: {
           name: 'img/[name].[hash:7].[ext]'
        }
      },
    ]
  }
};