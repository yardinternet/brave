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

	const events = () => {
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
	 *
	 * @param {Event} event - The key up event
	 */
	const onKeyUp = ( event ) => {
		if ( event.key !== 'Escape' ) return;

		closeAllSubMenus();

		const item = event.target.closest( '.menu-item-has-children' );
		if ( ! item ) return;

		const link = item.querySelector( 'a' );
		link?.focus();
	};

	/**
	 * Close expandable items if there is clicked somewhere which is not a menu item
	 *
	 * @param {Event} event - The click event
	 */
	const onClickDocument = ( event ) => {
		const isClickedOutside = Array.from( navigationItems ).every(
			( item ) => ! item.contains( event.target )
		);

		if ( ! isClickedOutside ) return;
		closeAllSubMenus();
	};

	/**
	 * Close expandable items if the focus is somewhere which is not a sub menu
	 *
	 * @param {Event} event - The focusin event
	 */
	const onFocusIn = ( event ) => {
		if ( event.target.closest( '.sub-menu' ) ) return;

		closeAllSubMenus();
	};

	/**
	 * Initialize expandable menu items and add necessary aria attributes.
	 */
	const initExpandableMenuItems = () => {
		expandableNavigationItems.forEach( ( item ) => {
			const link = item.querySelector( 'a' );

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

	const onClickLink = ( event, item, link ) => {
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

	const openSubMenu = ( item, link ) => {
		link.setAttribute( 'aria-expanded', 'true' );
		item.classList.add( CSS_CLASS_OPEN_MENU );
	};

	const closeSubMenu = ( item, link ) => {
		link.setAttribute( 'aria-expanded', 'false' );
		item.classList.remove( CSS_CLASS_OPEN_MENU );
	};

	/**
	 * Close all expandable menu items
	 */
	const closeAllSubMenus = () => {
		clickedItems.clear();
		expandableNavigationItems.forEach( ( item ) => {
			const link = item.querySelector( 'a' );
			if ( link ) closeSubMenu( item, link );
		} );
	};

	events();
};
