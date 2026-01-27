/**
 * External dependencies
 */
import A11yCookieYes from '@yardinternet/a11y-cookie-yes';
import {
	A11yCards,
	A11yFacetWP,
	A11yMobileMenu,
	FocusStyle,
	Navigation,
	SearchBar,
	WebShareApi,
} from '@yardinternet/brave-frontend-kit';

/**
 * Internal dependencies
 */
import Accordion from './components/Accordion';
import Dialog from './components/Dialog';

/**
 * Application entrypoint
 */
window.addEventListener( 'DOMContentLoaded', () => {
	new A11yCards();
	A11yCookieYes.getInstance();
	new A11yFacetWP();
	new A11yMobileMenu();
	Accordion();
	Dialog();
	new FocusStyle();
	new Navigation();
	new SearchBar();
	new WebShareApi();
} );
