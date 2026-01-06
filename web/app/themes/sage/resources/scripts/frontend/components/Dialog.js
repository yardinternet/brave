/**
 * External dependencies
 */
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock';
import * as focusTrap from 'focus-trap';

/**
 * Internal dependencies
 */
import { checkCanFocusTrap } from '@yardinternet/brave-frontend-kit';

export default () => {
	const events = () => {
		const openButtons = document.querySelectorAll(
			'button[data-dialog-id]'
		);

		if ( ! openButtons.length ) return;

		openButtons.forEach( ( openButton ) => {
			const dialogId = openButton.getAttribute( 'data-dialog-id' );
			const dialog = document.getElementById( dialogId );

			if ( ! dialog ) return;

			initDialog( dialog, openButton );
		} );
	};

	const initDialog = ( dialog, openButton ) => {
		const focusTrapDialog = focusTrap.createFocusTrap( dialog, {
			clickOutsideDeactivates: true,
			checkCanFocusTrap,
			onActivate: () => {
				dialog.showModal();
				disableBodyScroll( dialog );
			},
			onDeactivate: () => {
				dialog.close();
				enableBodyScroll( dialog );
			},
		} );

		openButton.addEventListener( 'click', focusTrapDialog.activate );

		const closeButtons = dialog.querySelectorAll(
			'.js-dialog-close-button'
		);

		closeButtons?.forEach( ( closeButton ) => {
			closeButton.addEventListener( 'click', focusTrapDialog.deactivate );
		} );
	};

	events();
};
