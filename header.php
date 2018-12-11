<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package highlight
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<?php

		$getheaderimage = get_header_image();
		$noheaderimage = '';
		if ( empty( $getheaderimage ) ) {
			$noheaderimage = ' noheader-image';
		}

		?>
		<div class="site-branding-area<?php echo esc_attr( $noheaderimage ); ?>" style="background-image: url(<?php header_image(); ?>)">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="site-branding text-center">
							<?php
							the_custom_logo();
							if ( is_front_page() && is_home() ) :
								?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
							else :
								?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
							endif;
							$highlight_description = get_bloginfo( 'description', 'display' );
							if ( $highlight_description || is_customize_preview() ) :
								?>
								<p class="site-description"><?php echo $highlight_description; /* WPCS: xss ok. */ ?></p>
							<?php endif; ?>
						</div><!-- .site-branding -->
					</div>
				</div>
			</div>
		</div>
<?php
 $adminonoff = get_theme_mod( 'admin_section_on_off', false );
if ( true == $adminonoff ) :
	?>
	<div class="admin-information-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="admin-info">
						<div class="admin-image">
							<img src="<?php echo esc_url( get_theme_mod( 'header_admin_image' ) ); ?>" alt="">
						</div>
						<div class="admin-desc">
							<p><?php echo esc_html( get_theme_mod( 'admin_short_description' ) ); ?></p>
							<p class="email"><?php echo esc_html( get_theme_mod( 'admin_email' ) ); ?></p>
							<div class="header-social-link">
								<?php echo wp_kses_post( get_theme_mod( 'social_html_markup' ) ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
		<div class="nav-bar-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav id="site-navigation" class="main-navigation cssmenu">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'highlight' ); ?></button>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
								)
							);
							?>
						</nav><!-- #site-navigation -->
					</div>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
