const merge = require( 'deepmerge' );

const prettierSettings = merge( require( '@yardinternet/prettier-config' ), {
	overrides: [
		{
			files: [ '*.js', '*.jsx', '*.ts', '*.tsx' ],
		},
	],
} );

module.exports = prettierSettings;
