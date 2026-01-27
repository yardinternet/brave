/**
 * External dependencies
 */
import A11yCookieYes from '@yardinternet/a11y-cookie-yes';
import {
	Accordion,
	A11yCards,
	A11yFacetWP,
	A11yMobileMenu,
	Dialog,
	FocusStyle,
	Navigation,
	SearchBar,
	WebShareApi,
} from '@yardinternet/brave-frontend-kit';

/**
 * Application entrypoint
 */
window.addEventListener( 'DOMContentLoaded', () => {
	A11yCookieYes.getInstance();
	new A11yFacetWP();
	new A11yMobileMenu();
	new Accordion();
	new A11yCards();
	new Dialog();
	new FocusStyle();
	new Navigation();
	new SearchBar();
	new WebShareApi();
} );
