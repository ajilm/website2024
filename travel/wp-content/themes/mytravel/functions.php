<?php
/**
 * mytravel functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mytravel
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/* Disable the Admin Bar. */
add_filter( 'show_admin_bar', '__return_false' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mytravel_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on mytravel, use a find and replace
		* to change 'mytravel' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'mytravel', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'mytravel' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'mytravel_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'mytravel_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mytravel_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mytravel_content_width', 640 );
}
add_action( 'after_setup_theme', 'mytravel_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mytravel_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'mytravel' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'mytravel' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'mytravel_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mytravel_scripts() {
	wp_enqueue_style( 'mytravel-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'mytravel-style', 'rtl', 'replace' );

	wp_enqueue_script( 'mytravel-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mytravel_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Include the WP_Bootstrap_Navwalker class from the 'inc' folder
/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

	// Extend the WP_Bootstrap_Navwalker class to customize it
	// class WP_Bootstrap_Navwalker_Extended extends WP_Bootstrap_Navwalker {
    
	// 	// Ensure the method is public to avoid access level errors
	// 	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
	// 		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			
	// 		// If this menu item has children, add the 'has-children' class to the <li>
	// 		if (in_array('menu-item-has-children', $classes)) {
	// 			$classes[] = 'has-children'; // Add the 'has-children' class to the <li>
	// 		}
	
	// 		// Add 'dropdown' class to the <ul> element for dropdown menus
	// 		if (in_array('menu-item-has-children', $classes) && ($depth > 0)) {
	// 			// Only apply the 'dropdown' class for submenus (i.e., depth > 0)
	// 			$classes[] = 'dropdown'; // Add the 'dropdown' class to the <ul>
	// 		}
	
	// 		// Add the class to the item
	// 		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_unique( $classes ), $item, $args ) );
	// 		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			
	// 		// Add custom attributes to the <a> tag
	// 		$id = 'menu-item-' . $item->ID; // Set the item ID
	// 		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
	
	// 		// Build the opening <li> tag and <a> tag
	// 		$output .= '<li' . $id . $class_names .'>';
	// 		$attributes = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '" ' : '';
	// 		$attributes .= !empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) . '" ' : '';
	// 		$attributes .= !empty( $item->xfn )        ? ' rel="' . esc_attr( $item->xfn        ) . '" ' : '';
	// 		$attributes .= !empty( $item->url )        ? ' href="' . esc_attr( $item->url        ) . '" ' : '';
	
	// 		// Add the 'dropdown-toggle' class and 'data-bs-toggle' attribute for items with submenus
	// 		if ($depth === 0 && in_array('menu-item-has-children', $classes)) {
	// 			$attributes .= ' class="dropdown-toggle" data-bs-toggle="dropdown"';
	// 		}
	
	// 		// Build the <a> tag
	// 		$item_output = $args->before;
	// 		$item_output .= '<a'. $attributes .'>';
	// 		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
	// 		$item_output .= '</a>';
	// 		$item_output .= $args->after;
			
	// 		$output .= $item_output;
	// 	}
	
	// 	// Modify the output for the closing <ul> tag (so we can add 'dropdown' class)
	// 	public function end_lvl( &$output, $depth = 0, $args = null ) {
	// 		if ($depth > 0) {
	// 			// Add 'dropdown' class to <ul> tag for submenus
	// 			$output .= '</ul>';
	// 		} else {
	// 			// For top-level menus, just close the <ul> tag normally
	// 			$output .= '</ul>';
	// 		}
	// 	}
	// }

}
add_action( 'after_setup_theme', 'register_navwalker' ); 

// Include the custom Navwalker
// require_once get_template_directory() . '/inc/navwalker.php';

// functions.php
function register_my_menu() {
    register_nav_menu('primary', 'Primary Navigation');
}
add_action('after_setup_theme', 'register_my_menu');

add_shortcode( 'popular_destination', 'popular_destination_func' );
function popular_destination_func( $atts ) {
	$html = ''; 
	$args = array(
		'post_type'      => 'destination',  
		'posts_per_page' => 10,    
		'order'          => 'DESC',  
		'orderby'        => 'date',   
	); 
	$query = new WP_Query($args); 
	if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post();
		$terms = get_the_terms(get_the_ID(), 'country');
		if (!empty($terms) && !is_wp_error($terms)) {
			foreach ($terms as $term) {
				 $termname = $term->name; 
			}
		}

			$html .= '<div class="item">
					<a class="media-thumb" href="'.get_the_post_thumbnail_url(get_the_ID(),'full').'" data-fancybox="gallery">
						<div class="media-text">
							<h3>'.get_the_title().'</h3>
							<span class="location">'.$termname.'</span>
						</div>
						<img src="'.get_the_post_thumbnail_url(get_the_ID(),'full').'" alt="Image" class="img-fluid">
					</a> 
				</div>';
		   
		endwhile; 
		wp_reset_postdata();
	else :
		$html = '<div class="item">No posts found.</div>';
	endif; 

	return $html;
}


// Add this action for logged-in users
add_action('wp_ajax_testapi', 'testapi_callback');
// Add this action for non-logged-in users
add_action('wp_ajax_nopriv_testapi', 'testapi_callback');
function testapi_callback() { 
$curl = curl_init(); 
curl_setopt_array($curl, [
	CURLOPT_URL => "https://tripadvisor-scraper.p.rapidapi.com/restaurants/detail?id=12425739",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: tripadvisor-scraper.p.rapidapi.com",
		"x-rapidapi-key: 429b9071aemsh0a68ef642842b42p1bf35ajsncb3b235d8f82"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
  
	print_r($response);
    // Always exit to prevent extra output
    exit();
}