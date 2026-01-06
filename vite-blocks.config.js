/**
 * External dependencies
 */
import { defineConfig } from 'vite';
import { braveBlocksConfig } from '@yardinternet/vite-config';

export default defineConfig(
	braveBlocksConfig( { blockPath: process.env.BLOCK_PATH } )
);
