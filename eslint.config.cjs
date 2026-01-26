const merge = require( 'deepmerge' );

const eslintSettings = merge( require( '@yardinternet/eslint-config' ), [
	{
		files: [ '**/*.js', '**/*.jsx', '**/*.ts', '**/*.tsx' ],
	},
] );

module.exports = eslintSettings;
