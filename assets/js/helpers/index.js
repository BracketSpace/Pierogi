export function innerWidth( element ) {
	const style = window.getComputedStyle( element );

	return ( element.clientWidth - parseInt( style.paddingLeft ) - parseInt( style.paddingRight ) );
}

export function triggerEvent( eventType, detail = null, target = window ) {
	const event = new window.CustomEvent( `pierogi.${ eventType }`, { detail } );

	target.dispatchEvent( event );
}
