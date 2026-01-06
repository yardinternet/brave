export default () => {
	const cards = document.querySelectorAll(
		'.wp-block-group-is-layout-grid > .wp-block-group.has-background'
	);

	const events = () => {
		addLinkToCards();
	};

	const addLinkToCards = () => {
		if ( cards.length === 0 ) return;

		cards.forEach( addLinkClass );
	};

	/**
	 * CSS is unaware if a card has a link in it or not, making it impossible to add a hover state.
	 * This checks if there is an <a> element in the card and adds an extra class.
	 *
	 * @param {HTMLElement} card
	 */
	const addLinkClass = ( card ) => {
		const links = card.querySelectorAll( 'a' );

		if ( links.length === 0 || links.length > 1 ) return;

		links.forEach( ( link ) => {
			if (
				link.getAttribute( 'href' ) &&
				link.classList.contains( 'wp-block-button__link' )
			) {
				moveLinkToHeading( link, card );
			}
		} );
	};

	/**
	 * If the card has a link in a button, we need to move it to the heading
	 * to make the card fully clickable.
	 *
	 * @param {HTMLLinkElement} link
	 * @param {HTMLElement}     card
	 */
	const moveLinkToHeading = ( link, card ) => {
		const heading = card.querySelector( '.wp-block-heading' );

		if ( ! heading ) return;
		if ( heading.querySelector( 'a' ) ) return;

		const newLink = document.createElement( 'a' );
		newLink.href = link.href;
		if ( link.target ) newLink.target = link.target;
		if ( link.rel ) newLink.rel = link.rel;
		newLink.innerHTML = heading.innerHTML;
		heading.innerHTML = '';
		heading.appendChild( newLink );

		a11yHideLink( link );
	};

	/**
	 * A11y: Hide button for screenreaders and tab focus because the heading
	 * already has the same link.
	 *
	 * @param {HTMLLinkElement} link
	 */
	const a11yHideLink = ( link ) => {
		link.setAttribute( 'aria-hidden', 'true' );
		link.setAttribute( 'tabindex', '-1' );
	};

	events();
};
