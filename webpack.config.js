const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
module.exports = {
  mode: 'development',
  watch: true,
  entry: {
    'js/app' : './src/js/app.js',
    'js/inicio' : './src/js/inicio.js',
    'js/protocolos/index' : './src/js/protocolos/index.js',
    'js/casamientos/index' : './src/js/casamientos/index.js',
    'js/motivos/index' : './src/js/motivos/index.js',
    'js/articulos/index' : './src/js/articulos/index.js',
    'js/transportes/index' : './src/js/transportes/index.js',
    'js/tiposol/index' : './src/js/tiposol/index.js',
    'js/busquedasc/index' : './src/js/busquedasc/index.js',
    'js/licencias/index' : './src/js/licencias/index.js',
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