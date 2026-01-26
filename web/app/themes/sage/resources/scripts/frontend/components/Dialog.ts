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
	const events = (): void => {
		const openButtons = document.querySelectorAll(
			'button[data-dialog-id]'
		) as NodeListOf< HTMLButtonElement >;

		if ( ! openButtons.length ) return;

		openButtons.forEach( ( openButton ) => {
			const dialogId = openButton.getAttribute( 'data-dialog-id' );
			if ( ! dialogId ) return;

			const dialog = document.getElementById(
				dialogId
			) as HTMLDialogElement;
			if ( ! dialog ) return;

			initDialog( dialog, openButton );
		} );
	};

	const initDialog = (
		dialog: HTMLDialogElement,
		openButton: HTMLButtonElement
	): void => {
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

		openButton.addEventListener( 'click', () =>
			focusTrapDialog.activate()
		);

		const closeButtons = dialog.querySelectorAll(
			'.js-dialog-close-button'
		) as NodeListOf< HTMLButtonElement >;

		closeButtons.forEach( ( closeButton ) => {
			closeButton.addEventListener( 'click', () =>
				focusTrapDialog.deactivate()
			);
		} );
	};

	events();
};
