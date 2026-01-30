/**
 * External dependencies
 */
import { braveConfig } from '@yardinternet/vite-config';

export default braveConfig( {
	theme: process.env.THEME,
	entryPoints: [
		'resources/scripts/editor/editor.ts',
		'resources/scripts/frontend/frontend.ts',
		'resources/styles/editor.css',
		'resources/styles/frontend.css',
	],
	editorStylesPrefixWrap: { entryPoints: [ 'resources/styles/editor.css' ] },
} );
