<?php
/**
 * Pierogi Helper functions
 *
 * @package Pierogi
 */

/**
 * Tarses hex string into RGB array
 *
 * @param string $hex Hex color string.
 * @return array|false
 */
function pierogi_parse_hex_color( $hex ) {
	if ( '#' !== substr( $hex, 0, 1 ) || 7 !== strlen( $hex ) ) {
		return false;
	}

	return [
		hexdec( substr( $hex, 1, 2 ) ),
		hexdec( substr( $hex, 3, 2 ) ),
		hexdec( substr( $hex, 5, 2 ) ),
	];
}

/**
 * Convert RGB color into HSL
 *
 * @param mixed $r Red value or hex color string.
 * @param mixed $g Green value.
 * @param mixed $b Blue value.
 * @return array
 */
function pierogi_rgb_to_hsl( $r, $g = null, $b = null ) {
	if ( null === $g ) {
		if ( is_string( $r ) && 1 < strlen( $r ) ) {
			$rgb = pierogi_parse_hex_color( $r );

			if ( ! $rgb ) {
				return false;
			}

			list( $r, $g, $b ) = $rgb;
		} else {
			return false;
		}
	}

	$r = (int) $r / 255;
	$g = (int) $g / 255;
	$b = (int) $b / 255;

	if ( 0 > $r || 1 < $r ||
		0 > $g || 1 < $g ||
		0 > $b || 1 < $b ) {
		return false;
	}

	$max = max( $r, $g, $b );
	$min = min( $r, $g, $b );

	$h;
	$s;
	$l = ( $max + $min ) / 2;
	$d = $max - $min;

	if ( 0 === $d ) {
		$h = 0;
		$s = 0;
	} else {
		$s = $d / ( 1 - abs( 2 * $l - 1 ) );

		switch ( $max ) {
			case $r:
				$h = 60 * fmod( ( ( $g - $b ) / $d ), 6 );
				if ( $b > $g ) {
					$h += 360;
				}
				break;
			case $g:
				$h = 60 * ( ( $b - $r ) / $d + 2 );
				break;
			case $b:
				$h = 60 * ( ( $r - $g ) / $d + 4 );
				break;
		}
	}

	return [
		round( $h, 2 ),
		round( $s, 2 ),
		round( $l, 2 ),
	];
}

/**
 * Convert RGB color into HSL
 *
 * @param mixed $h Hue value.
 * @param mixed $s Saturation level.
 * @param mixed $l Lightness.
 * @param bool  $return_hex Whether to return hex value or RGB array.
 * @return array|string
 */
function pierogi_hsl_to_rgb( $h, $s, $l, $return_hex = true ) {
	$r;
	$g;
	$b;
	$c = ( 1 - abs( 2 * $l - 1 ) ) * $s;
	$x = $c * ( 1 - abs( fmod( ( $h / 60 ), 2 ) - 1 ) );
	$m = $l - ( $c / 2 );

	if ( $h < 60 ) {
		$r = $c;
		$g = $x;
		$b = 0;
	} elseif ( $h < 120 ) {
		$r = $x;
		$g = $c;
		$b = 0;
	} elseif ( $h < 180 ) {
		$r = 0;
		$g = $c;
		$b = $x;
	} elseif ( $h < 240 ) {
		$r = 0;
		$g = $x;
		$b = $c;
	} elseif ( $h < 300 ) {
		$r = $x;
		$g = 0;
		$b = $c;
	} else {
		$r = $c;
		$g = 0;
		$b = $x;
	}

	$r = ( $r + $m ) * 255;
	$g = ( $g + $m ) * 255;
	$b = ( $b + $m ) * 255;

	if ( false === $return_hex ) {
		return [
			floor( $r ),
			floor( $g ),
			floor( $b ),
		];
	} else {
		$r = dechex( $r );
		$g = dechex( $g );
		$b = dechex( $b );

		if ( 1 === strlen( $r ) ) {
			$r = "0{$r}";
		}

		if ( 1 === strlen( $g ) ) {
			$g = "0{$g}";
		}

		if ( 1 === strlen( $b ) ) {
			$b = "0{$b}";
		}

		return "#{$r}{$g}{$b}";
	}
}

/**
 * Lighten given hex color
 *
 * @param mixed $color Input color string.
 * @param int   $delta Percentage value for lightening.
 * @param bool  $relative Whether lightening should be relative.
 * @return string
 */
function pierogi_lighten_color( $color, $delta, $relative = false ) {
	$hsl = pierogi_rgb_to_hsl( $color );

	if ( ! $hsl ) {
		return false;
	}

	if ( $delta > 1 ) {
		$delta /= 100;
	}

	list( $h, $s, $l ) = $hsl;

	if ( true === $relative ) {
		// $l *= 1 + $delta;
		$delta = ( 1 - $l ) * $delta;
	}

	$l += $delta;

	if ( 100 < $l ) {
		$l = 100;
	}

	return pierogi_hsl_to_rgb( $h, $s, $l );
}
