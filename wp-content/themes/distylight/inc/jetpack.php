<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package distylight
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function distylight_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'distylight_jetpack_setup' );
