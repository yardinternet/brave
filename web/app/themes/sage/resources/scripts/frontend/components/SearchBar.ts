/**
 * External dependencies
 */
import { createFocusTrap, type Options, type FocusTrap } from 'focus-trap';

/**
 * Internal dependencies
 */
import { checkCanFocusTrap } from '@yardinternet/brave-frontend-kit';

export default () => {
	let focusTrapSearchBar: FocusTrap | null = null;
	const searchbarIsOpen = 'js-search-bar-is-open';

	const closeBtn = document.querySelector(
		'#js-search-bar-close-btn'
	) as HTMLButtonElement;
	const input = document.querySelector(
		'#js-search-bar-input'
	) as HTMLInputElement;
	const openBtn = document.querySelector(
		'#js-search-bar-open-btn'
	) as HTMLButtonElement;
	const searchbar = document.querySelector(
		'#js-search-bar'
	) as HTMLDivElement;

	const focusTrapOptions: Options = {
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

	const events = (): void => {
		if ( ! closeBtn || ! input || ! openBtn || ! searchbar ) return;

		focusTrapSearchBar = createFocusTrap( searchbar, focusTrapOptions );

		closeBtn.addEventListener(
			'click',
			() => focusTrapSearchBar?.deactivate()
		);
		openBtn.addEventListener(
			'click',
			() => focusTrapSearchBar?.activate()
		);
	};

	events();
};
