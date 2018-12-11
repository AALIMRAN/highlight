<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package highlight
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer footer1 footer2">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="site-info text-center">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'highlight' ) ); ?>">
							<?php
							/* translators: %s: CMS name, i.e. WordPress. */
							printf( esc_html__( 'Proudly powered by %s', 'highlight' ), 'WordPress' );
							?>
						</a>
						<span class="sep"> | </span>
							<?php
							$creditlink = 'https://adazing.com';
							/* translators: 1: Theme name, 2: Theme author. */
							printf( esc_html__( 'Theme: %1$s by %2$s ', 'highlight' ), 'highlight', '<a href="' . esc_url( $creditlink ) . '">Adazing.com</a>' );
							?>
					</div><!-- .site-info -->
				</div>
			</div>
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
