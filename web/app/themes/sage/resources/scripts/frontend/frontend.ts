/**
 * External dependencies
 */
import A11yCookieYes from '@yardinternet/a11y-cookie-yes';
import {
	A11yCards,
	A11yFacetWP,
	A11yMobileMenu,
	Accordion,
	DialogManager,
	FocusStyle,
	Navigation,
	WebShareApi,
} from '@yardinternet/brave-frontend-kit';

/**
 * Application entrypoint
 */
window.addEventListener( 'DOMContentLoaded', () => {
	new A11yCards();
	A11yCookieYes.getInstance();
	new A11yFacetWP();
	new A11yMobileMenu();
	new Accordion();
	new DialogManager();
	new FocusStyle();
	new Navigation();
	new WebShareApi();
} );
