/**
 * External dependencies
 */
import * as focusTrap from 'focus-trap';

/**
 * Internal dependencies
 */
import { checkCanFocusTrap } from '@yardinternet/brave-frontend-kit';

export default () => {
	let focusTrapSearchBar;
	const searchbarIsOpen = 'js-search-bar-is-open';

	const closeBtn = document.querySelector( '#js-search-bar-close-btn' );
	const input = document.querySelector( '#js-search-bar-input' );
	const openBtn = document.querySelector( '#js-search-bar-open-btn' );
	const searchbar = document.querySelector( '#js-search-bar' );

	const focusTrapOptions = {
		allowOutsideClick: true,
		checkCanFocusTrap,
		clickOutsideDeactivates: true,
		onActivate: () => {
			document.body.classList.add( searchbarIsOpen );
		},
		onDeactivate: () => {
			document.body.classList.remove( searchbarIsOpen );
			input.value = '';
		},
	};

	const events = () => {
		if ( ! closeBtn || ! openBtn || ! searchbar ) return;

		focusTrapSearchBar = focusTrap.createFocusTrap(
			searchbar,
			focusTrapOptions
		);

		closeBtn.addEventListener( 'click', () =>
			focusTrapSearchBar?.deactivate()
		);
		openBtn.addEventListener( 'click', () =>
			focusTrapSearchBar?.activate()
		);
	};

	events();
};
