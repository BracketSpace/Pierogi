const defaultConfig = require( './node_modules/@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );
const ImageminPlugin = require( 'imagemin-webpack-plugin' ).default;
const ExtraneousFileCleanupPlugin = require( 'webpack-extraneous-file-cleanup-plugin' );
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );

module.exports = ( env, argv ) => {
	return {
		mode: argv.mode,
		entry: {
			main: './assets/js/main.js',
			customizer: './assets/js/customizer.js',
			style: './assets/scss/main.scss',
			'style-editor': './assets/scss/editor.scss',
			editor: './assets/js/editor.js',
		},
		output: {
			path: path.resolve( __dirname, 'js' ),
			filename: './[name].js',
		},
		performance: {
			hints: false,
			maxEntrypointSize: 512000,
			maxAssetSize: 512000,
		},
		devtool: false,
		optimization: {
			minimize: false,
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
							{
								loader: 'css-loader',
								options: {
									import: false,
									importLoaders: 2,
								},
							},
							'postcss-loader',
							'sass-loader',
						],
					} ),
				},
				{
					test: /\.(png|jpg|gif|svg)$/i,
					use: [
						{
							loader: 'file-loader',
							options: {
								name: '[name].[ext]',
								outputPath: '../images',
								publicPath: 'images',
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
			new ExtractTextPlugin( '../[name].css' ),
			new ImageminPlugin( {
				test: /\.(jpe?g|png|gif|svg)$/i,
			} ),
			...( ! argv.watch ? [
				new StyleLintPlugin( {
					configFile: '.stylelintrc',
					context: 'assets/scss',
				} ),
			] : [] ),
			...( process.env.NODE_ENV === 'production' ? [
				new CleanWebpackPlugin(),
				new ExtraneousFileCleanupPlugin( {
					extensions: [ '.js', '.php' ],
					minBytes: 4096,
				} ),
			] : [] ),
		],
		externals: {
			jquery: 'jQuery',
		},
	};
};
