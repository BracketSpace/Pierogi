const defaultConfig = require( './node_modules/@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );
const ImageminPlugin = require( 'imagemin-webpack-plugin' ).default;

module.exports = ( env, argv ) => {
	return {
		mode: argv.mode,
		entry: {
			main: './assets/src/js/main.js',
		},
		output: {
			path: path.resolve( __dirname, 'assets/dist' ),
			filename: './js/[name].js',
			publicPath: '../',
		},
		performance: {
			hints: false,
			maxEntrypointSize: 512000,
			maxAssetSize: 512000,
		},
		module: {
			rules: [
				{
					test: /\.js?$/,
					exclude: /node_modules/,
					use: [
						{
							loader: 'babel-loader',
						},
						...( ! argv.watch ? [
							{
								loader: 'eslint-loader',
								options: {
									configFile: ( 'production' === argv.mode ) ? '.eslintrc.prod' : '.eslintrc',
								},
							},
						] : [] ),
					],
				},
				{
					test: /\.scss$/,
					use: ExtractTextPlugin.extract( {
						fallback: 'style-loader',
						use: [
							'css-loader',
							'postcss-loader',
							'sass-loader',
						],
					} ),
				},
				{
					test: /\.(png|jpg|gif|svg)$/i,
					use: [
						{
							loader: 'url-loader',
							options: {
								limit: 8192,
								name: '[name].[ext]',
								outputPath: 'images',
							},
						},
					],
				},
			],
		},
		resolve: {
			extensions: [ '.js', '.jsx' ],
		},
		plugins: [
			...defaultConfig.plugins,
			new ExtractTextPlugin( '../../style.css' ),
			new ImageminPlugin( {
				test: /\.(jpe?g|png|gif|svg)$/i,
			} ),
			...( ! argv.watch ? [
				new StyleLintPlugin( {
					configFile: '.stylelintrc',
					context: 'assets/src/scss',
				} ),
			] : [] ),
		],
		externals: {
			jquery: 'jQuery',
		},
	};
};
