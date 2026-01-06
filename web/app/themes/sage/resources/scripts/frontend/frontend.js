/**
 * External dependencies
 */
import A11yCookieYes from '@yardinternet/a11y-cookie-yes';
import {
	A11yFacetWP,
	A11yMobileMenu,
	FocusStyle,
	WebShareApi,
} from '@yardinternet/brave-frontend-kit';

/**
 * Internal dependencies
 */
import Accordion from './components/Accordion';
import Cards from './components/Cards';
import Dialog from './components/Dialog';
import Navigation from './components/Navigation';
import SearchBar from './components/SearchBar';

/**
 * Application entrypoint
 */
window.addEventListener( 'DOMContentLoaded', () => {
	A11yCookieYes.getInstance();
	new A11yFacetWP();
	new A11yMobileMenu();
	Accordion();
	Cards();
	Dialog();
	new FocusStyle();
	Navigation();
	SearchBar();
	new WebShareApi();
} );
