/**
 * External dependencies
 */
import Headroom from 'headroom.js';

export default () => {
	const header = document.querySelector( '#js-header' );
	const navigationItems = document.querySelectorAll( '.nav > .menu-item' );
	const expandableNavigationItems = document.querySelectorAll(
		'.nav > .menu-item-has-children'
	);
	const headroomOptions = {
		tolerance: {
			up: 10,
			down: 30,
		},
	};
	const clickedItems = new Set();
	const CSS_CLASS_OPEN_MENU = 'js-show-sub-menu';

	const events = (): void => {
		if ( ! header ) return;
		new Headroom( header, headroomOptions ).init();

		if ( ! navigationItems ) return;

		document.addEventListener( 'keyup', onKeyUp );
		document.addEventListener( 'click', onClickDocument );
		document.addEventListener( 'focusin', onFocusIn );

		initExpandableMenuItems();
	};

	/**
	 * A11y: Check if escape key is pressed, then close all expandable items and set focus to parent link
	 */
	const onKeyUp = ( event: KeyboardEvent ): void => {
		if ( event.key !== 'Escape' ) return;

		closeAllSubMenus();

		let item: Element | null = null;
		if ( event.target && event.target instanceof Element ) {
			item = event.target.closest( '.menu-item-has-children' );
		}
		if ( ! item ) return;

		const link = item.querySelector( 'a' );
		link?.focus();
	};

	/**
	 * Close expandable items if there is clicked somewhere which is not a menu item
	 */
	const onClickDocument = ( event: MouseEvent ): void => {
		const isClickedOutside = Array.from( navigationItems ).every(
			( item ) => ! item.contains( event.target as Node )
		);

		if ( ! isClickedOutside ) return;
		closeAllSubMenus();
	};

	/**
	 * Close expandable items if the focus is somewhere which is not a sub menu
	 */
	const onFocusIn = ( event: FocusEvent ): void => {
		if (
			event.target &&
			event.target instanceof Element &&
			event.target.closest( '.sub-menu' )
		)
			return;

		closeAllSubMenus();
	};

	/**
	 * Initialize expandable menu items and add necessary aria attributes.
	 */
	const initExpandableMenuItems = (): void => {
		expandableNavigationItems.forEach( ( item ) => {
			const link = item.querySelector( 'a' );

			if ( ! link ) return;

			link.setAttribute( 'aria-haspopup', 'true' );
			link.setAttribute( 'aria-expanded', 'false' );

			link.addEventListener( 'click', ( event ) =>
				onClickLink( event, item, link )
			);

			item.addEventListener( 'mouseenter', () =>
				openSubMenu( item, link )
			);

			item.addEventListener( 'mouseleave', () => {
				if ( ! clickedItems.has( item ) ) closeSubMenu( item, link );
			} );
		} );
	};

	const onClickLink = (
		event: MouseEvent,
		item: Element,
		link: HTMLAnchorElement
	): void => {
		event.preventDefault();
		event.stopPropagation();

		const isOpen = link.getAttribute( 'aria-expanded' ) === 'true';

		if ( isOpen ) {
			clickedItems.delete( item );
			closeSubMenu( item, link );
		} else {
			clickedItems.add( item );
			openSubMenu( item, link );
		}
	};

	const openSubMenu = ( item: Element, link: HTMLAnchorElement ): void => {
		link.setAttribute( 'aria-expanded', 'true' );
		item.classList.add( CSS_CLASS_OPEN_MENU );
	};

	const closeSubMenu = ( item: Element, link: HTMLAnchorElement ): void => {
		link.setAttribute( 'aria-expanded', 'false' );
		item.classList.remove( CSS_CLASS_OPEN_MENU );
	};

	/**
	 * Close all expandable menu items
	 */
	const closeAllSubMenus = (): void => {
		clickedItems.clear();
		expandableNavigationItems.forEach( ( item ) => {
			const link = item.querySelector( 'a' );
			if ( link ) closeSubMenu( item, link );
		} );
	};

	events();
};
