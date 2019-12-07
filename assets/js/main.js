import './btn-colors';

class Test {
	test = 'initial test value';

	constructor() {
		this.test = 'abrakadabra';

		console.log( this.test );

		this.init();
	}

	init() {
		console.log( 'init!' );

		this.test = 'initiated';

		console.log( this.test );
	}
}

new Test();
