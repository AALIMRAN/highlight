<?php
/**
 * Enqueue scripts and styles.
 *
 * @package highlight
 */

/**
 *
 * Enqueue Fonts
 */
if ( ! function_exists( 'highlight_fonts_url' ) ) :
	/**
	 *
	 * Fonts Function URL
	 */
	function highlight_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin';
		if ( 'off' !== _x( 'on', 'Roboto Font: on or off', 'highlight' ) ) {
			$fonts[] = 'Roboto:300,400,500,700,900';
		}
		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				),
				'https://fonts.googleapis.com/css'
			);
		}
		return $fonts_url;
	}
endif;


/**
 * Enqueue scripts and styles.
 */
function highlight_scripts() {
	wp_enqueue_style( 'highlight-fonts', highlight_fonts_url(), array(), time(), 'all' );

	wp_enqueue_style( 'highlight-style', get_stylesheet_uri(), array(), time(), 'all' );

	wp_enqueue_style( 'bootstrap', get_theme_file_uri( 'asset/css/bootstrap.css' ), array(), time(), 'all' );
	wp_enqueue_style( 'fontawesome', get_theme_file_uri( 'asset/css/fontawesome.css' ), array(), time(), 'all' );

	wp_enqueue_style( 'cssmenumaker', get_theme_file_uri( 'asset/css/cssmenumaker.css' ), array(), time(), 'all' );

	wp_enqueue_style( 'highlight-reset', get_theme_file_uri( 'asset/css/reset.css' ), array(), time(), 'all' );
	wp_enqueue_style( 'highlight-regular', get_theme_file_uri( 'asset/css/regular.css' ), array(), time(), 'all' );

	wp_enqueue_style( 'highlight-main', get_theme_file_uri( 'asset/css/main.css' ), array(), time(), 'all' );

	wp_enqueue_script( 'bootstrap', get_theme_file_uri( 'asset/js/bootstrap.js' ), array( 'jquery' ), time(), true );

	wp_enqueue_script( 'cssmenumaker', get_theme_file_uri( 'asset/js/cssmenumaker.js' ), array( 'jquery' ), time(), true );

	wp_enqueue_script( 'highlight-navigation', get_theme_file_uri( 'js/navigation.js' ), array(), time(), true );

	wp_enqueue_script( 'highlight-skip-link-focus-fix', get_theme_file_uri( '/js/skip-link-focus-fix.js' ), array(), time(), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'highlight_scripts' );
