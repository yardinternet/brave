/**
 * External dependencies
 */
import { BlockIconColor } from '@yardinternet/gutenberg-components';

const icon = {
	src: (
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
			<path
				fillRule="evenodd"
				d="M16 16h480v480H16zm16 16v448h448V32zm64 80h320v112H96zm0 176h320v112H96z"
			/>
		</svg>
	),
	...BlockIconColor,
};

export default icon;
