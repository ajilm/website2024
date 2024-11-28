<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mytravel
 */

?> 
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="favicon.png">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Source+Serif+Pro:wght@400;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/jquery.fancybox.min.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/fonts/icomoon/style.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/aos.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/style.css">

	<title>MyTravel</title>
</head>

<body> 
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="site-mobile-menu site-navbar-target">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close">
				<span class="icofont-close js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>

<?php wp_body_open(); ?>

<nav class="site-nav">
    <div class="container">
        <div class="site-navigation"> 
            <!-- Logo -->
			 <?php 
				if ( function_exists( 'get_custom_logo' ) ) {
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
				 
				}
			 ?>
            <a href="<?php echo home_url(); ?>" class="logo m-0">
				<img src="<?php echo $logo_url;?>" class="img-fluid logo"/>
			</a>
		 
            <!-- WordPress Navigation Menu -->
            <?php   
				wp_nav_menu( array(
				'theme_location'  => 'primary',
				'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
				'container'       => 'ul',//'div',

				'container_id'    => 'bs-example-navbar-collapse-1',
				'menu_class'      => 'js-clone-nav d-none d-lg-inline-block text-left site-menu float-right',//'navbar-nav mr-auto',
				'items_wrap' 	  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
				'walker'          => new WP_Bootstrap_Navwalker(),
				) ); 
            ?>

            <!-- Burger Menu for Mobile -->
            <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
                <span></span>
            </a>

        </div>
    </div>
</nav> 

 

<?php /*
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'mytravel' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$mytravel_description = get_bloginfo( 'description', 'display' );
			if ( $mytravel_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $mytravel_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'mytravel' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	*/?>
