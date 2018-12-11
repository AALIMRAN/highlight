<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package highlight
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php highlight_post_thumbnail(); ?>
	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				highlight_posted_on();
				highlight_entry_footer();
				?>
			</div><!-- .entry-meta -->
			<?php
		endif;
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( is_singular() ) :
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'highlight' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'highlight' ),
					'after'  => '</div>',
				)
			);
	else :
		the_excerpt();
	endif;
	?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		if ( ! is_singular( get_post_type() ) ) :
			?>
		<a href="<?php the_permalink(); ?>" class="btn btn-default"><?php esc_html_e( 'Read More', 'highlight' ); ?></a>
	<?php endif; ?>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
