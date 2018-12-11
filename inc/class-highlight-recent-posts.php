<?php
/**
 *
 * Highlight Recent Post Widget
 *
 * @package highlight
 */

/**
 *
 * Highlight Recent Post WIdget
 */
class Highlight_Recent_Posts extends WP_Widget_Recent_Posts {

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'highlight' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 * @since 4.9.0 Added the `$instance` parameter.
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args     An array of arguments used to retrieve the recent posts.
		 * @param array $instance Array of settings for the current widget.
		 */
		$recentpost = new WP_Query(
			array(
				'posts_per_page'      => $number,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
				'post_type'     => 'post',
			)
		);

		?>
		<?php echo wp_kses_post( $args['before_widget'] ); ?>
		<?php
		if ( $title ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		}
		?>
		<div class="highlight-recent-post-wrapper">
			<?php
			while ( $recentpost->have_posts() ) :
				$recentpost->the_post();
				?>
				<?php
				$post_title = get_the_title( get_the_id() );
				$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)', 'highlight' );
				?>
				<div class="highlight-recent-post-inner">
					<?php
					$postimage = get_the_post_thumbnail( get_the_id(), 'highlight-recent-post-thumb' );
					if ( $postimage ) {
						echo wp_kses_post( $postimage );
					} else {
						printf( '<div class="no-postthumbnail">%s</div>', '<a href="' . esc_url( get_the_permalink( get_the_id() ) ) . '"></a>' );
					}

					?>
					<div class="tage-date-wrapper">
					<div class="tags">
						<?php

						$categories = get_the_category( get_the_id() );

						foreach ( $categories as $category ) {
							$catlink = get_category_link( $category->term_ID );
							echo '<a href="' . $catlink . '">' . $category->name . '</a>';
						}
						?>
					</div>
					<div class="date">
					<?php if ( $show_date ) : ?>
						<span class="post-date"><?php echo esc_html( get_the_date( '', get_the_id() ) ); ?></span>
					<?php endif; ?>
					</div>
					</div>
					<a href="<?php the_permalink( get_the_id() ); ?>"><?php echo esc_html( $title ); ?></a>
				</div>
			<?php endwhile; ?>
		</div>
		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

}




add_action( 'widgets_init', 'highlight_recent_post_widget_reg' );

/**
 *
 * Register Custom Widget
 */
function highlight_recent_post_widget_reg() {
	unregister_widget( 'WP_Widget_Recent_Posts' );
	register_widget( 'Highlight_Recent_Posts' );
}
