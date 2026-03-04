/**
 * External dependencies
 */
import A11yCookieYes from '@yardinternet/a11y-cookie-yes';
import {
	A11yCards,
	A11yFacetWP,
	Accordion,
	BraveNavigationManager,
	DialogManager,
	FocusStyle,
	WebShareApi,
} from '@yardinternet/brave-frontend-kit';

/**
 * Application entrypoint
 */
window.addEventListener( 'DOMContentLoaded', () => {
	new A11yCards();
	A11yCookieYes.getInstance();
	new A11yFacetWP();
	new Accordion();
	new BraveNavigationManager();
	new DialogManager();
	new FocusStyle();
	new WebShareApi();
} );
