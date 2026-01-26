/**
 * External dependencies
 */
import Accordion from 'accordion-js';

export default () => {
	const events = (): void => {
		const accordions = Array.from(
			document.querySelectorAll(
				'.accordion-wrapper'
			) as NodeListOf< HTMLDivElement >
		);

		if ( accordions.length === 0 ) return;

		accordions.forEach( initAccordion );
	};

	/**
	 * Initializes the accordion. Use the is-open class on .accordion-wrapper to define an open accordion on init.
	 */
	const initAccordion = ( accordion: HTMLDivElement ): void => {
		const items = accordion.querySelectorAll(
			'.ac'
		) as NodeListOf< HTMLDivElement >;

		if ( items.length === 0 ) return;

		const openOnInit = Array.from( items ).reduce(
			( indexes: number[], item: HTMLDivElement, index: number ) => {
				if ( item.classList.contains( 'is-open' ) ) {
					indexes.push( index );
				}
				return indexes;
			},
			[]
		);

		new Accordion( accordion, {
			showMultiple: accordion.dataset.multiple === 'true',
			openOnInit,
			ariaEnabled: true,
			duration: 400,
			beforeOpen: ( item: HTMLDivElement ) => {
				item.querySelector( '.ac-panel' )?.classList.remove( 'hidden' );
			},
			onClose: ( item: HTMLDivElement ) => {
				item.querySelector( '.ac-panel' )?.classList.add( 'hidden' );
			},
		} );
	};

	events();
};
