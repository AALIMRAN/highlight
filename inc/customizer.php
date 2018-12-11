<?php
/**
 * Highlight Theme Customizer
 *
 * @package highlight
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function highlight_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'highlight_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'highlight_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'highlight_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function highlight_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function highlight_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function highlight_customize_preview_js() {
	wp_enqueue_script( 'highlight-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'highlight_customize_preview_js' );


if ( ! function_exists( 'highlight_theme_options' ) ) {
	add_action( 'customize_register', 'highlight_theme_options' );
	/**
	 * Highlight Theme options
	 *
	 * @param customizeobg $wp_customize highlight theme customizer obg.
	 */
	function highlight_theme_options( $wp_customize ) {
		$wp_customize->add_panel(
			'highlight_theme_options',
			array(

				'priority' => 60,
				'title'   => __( 'Highlight Theme Options', 'highlight' ),
				'description'   => __( 'Customize all options and feature of your Highlight theme', 'highlight' ),
				'capability' => 'edit_theme_options',

			)
		);

		$wp_customize->add_section(
			'control_header_admin',
			array(
				'priority'       => 1,
				'panel'          => 'highlight_theme_options',
				'title'          => __( 'Header Admin', 'highlight' ),
				'description'    => __( 'Customize Header Admin Section', 'highlight' ),
				'capability'     => 'edit_theme_options',
			)
		);

		/**
		 * Sanitizing input checkbox
		 *
		 * @param Sanitized $inputvalue Sanitizing input checkbox.
		 */
		function senitize_checkbox( $inputvalue ) {

			return ( ( isset( $inputvalue ) && true == $inputvalue ) ? true : false );
		}
		$wp_customize->add_setting(
			'admin_section_on_off',
			array(
				'default' => false,
				'transport' => 'refresh',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'senitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'admin_section_on_off',
			array(
				'type'  => 'checkbox',
				'label' => __( 'Admin ON/OFF', 'highlight' ),
				'description' => __( 'Header Admin Section On/Off', 'highlight' ),
				'section' => 'control_header_admin',
			)
		);

		$wp_customize->add_setting(
			'header_admin_image',
			array(

				'default' => '',
				'transport' => 'refresh',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'header_admin_image',
				array(
					'label'      => __( 'Upload an image', 'highlight' ),
					'section'    => 'control_header_admin',
				)
			)
		);
		$wp_customize->add_setting(
			'admin_short_description',
			array(

				'default' => '',
				'transport' => 'refresh',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			)
		);
		$wp_customize->add_control(
			'admin_short_description',
			array(

				'type' => 'textarea',
				'label' => __( 'Admin Description', 'highlight' ),
				'section' => 'control_header_admin',
			)
		);
		$wp_customize->add_setting(
			'admin_email',
			array(

				'default'   => '',
				'transport' => 'refresh',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_email',

			)
		);
		$wp_customize->add_control(
			'admin_email',
			array(
				'type' => 'email',
				'label' => __( 'Admi Email', 'highlight' ),
				'section' => 'control_header_admin',
			)
		);

		$wp_customize->add_setting(
			'social_html_markup',
			array(

				'default' => '',
				'transport' => 'refresh',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'wp_kses_post',
			)
		);
		$wp_customize->add_control(
			'social_html_markup',
			array(

				'type' => 'textarea',
				'label' => __( 'Social HTML Markup', 'highlight' ),
				'section' => 'control_header_admin',
			)
		);
	}
}
