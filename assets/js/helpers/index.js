export function innerWidth( element ) {
	const style = window.getComputedStyle( element );

	return ( element.clientWidth - parseInt( style.paddingLeft ) - parseInt( style.paddingRight ) );
}
