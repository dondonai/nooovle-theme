<?php
/**
 * Nooovle Theme.
 *
 * This file adds functions to the Nooovle Theme.
 *
 * @package Nooovle Theme
 * @author  dOndOnAi
 * @license GPL-2.0+
 * @link    http://www.nooovle.com/
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'nooovle-theme', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'nooovle-theme' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Nooovle Theme' );
define( 'CHILD_THEME_URL', 'http://www.nooovle.com/' );
define( 'CHILD_THEME_VERSION', '2.0.0' );
define( 'CHILD_THEME_DIR', get_stylesheet_directory_uri() );

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'nooovle_theme_enqueue_scripts_styles' );
function nooovle_theme_enqueue_scripts_styles() {

	wp_enqueue_style( 'nooovle-theme-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700|Opens+Sans:300,300i,400,600', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'fontawesome', CHILD_THEME_DIR . '/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script( 'nooovle-theme-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	$output = array(
		'mainMenu' => __( 'Menu', 'nooovle-theme' ),
		'subMenu'  => __( 'Menu', 'nooovle-theme' ),
	);
	wp_localize_script( 'nooovle-theme-responsive-menu', 'genesisSampleL10n', $output );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
// add_theme_support( 'custom-header', array(
// 	'width'           => 600,
// 	'height'          => 160,
// 	'header-selector' => '.site-title a',
// 	'header-text'     => false,
// 	'flex-height'     => true,
// ) );

// Add wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'after-header',
	'testimonial',
	'our-works',
	'services',
	'pricing-table',
	'blog',
	'our-clients',
    'menu-primary',
    'menu-secondary',
    'site-inner',
    'footer-widgets',
    'footer'
));

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for 3-column footer widgets
// add_theme_support( 'genesis-footer-widgets', 3 );

//* Add Image Sizes
add_image_size( 'featured-image', 720, 400, TRUE );
add_image_size( 'blog-featured-image', 360, 200, TRUE );

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array( 'primary' => __( 'After Header Menu', 'nooovle-theme' ), 'secondary' => __( 'Footer Menu', 'nooovle-theme' ) ) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'nooovle_theme_secondary_menu_args' );
function nooovle_theme_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

//* Modify size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'nooovle_theme_author_box_gravatar' );
function nooovle_theme_author_box_gravatar( $size ) {

	return 90;

}

//* Modify size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'nooovle_theme_comments_gravatar' );
function nooovle_theme_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

// add option page
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}

remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'nooovle_theme_footer' );

function nooovle_theme_footer() {
	?>
	<div class="footer__left two-sixths first">
		<?php genesis_seo_site_title(); ?>
		<?php $about = get_field('about', 'option'); ?>
		<p><?php echo $about; ?></p>
	</div>
	<div class="footer__right two-sixths">
	<h4 class="widget-title">Connect With Us</h4>
		<?php
		if(have_rows('social_links', 'option') ) :
			?>
			<ul class="footer__social">
			<?php
			while(have_rows('social_links', 'option') ) : the_row();
			$icon = get_sub_field('icon');
			$url = get_sub_field('url');
			?>
			<li class="footer__social-icon"><a href="<?php echo $url; ?>"><i class="fa <?php echo $icon; ?>"></i></a></li>
			<?php
			endwhile;
			echo '</ul>';
		else :
			echo 'no item to show';
		endif;

		wp_reset_postdata();

		?>

	</div>
	<?php
}

genesis_register_sidebar( array(
	'id'          => 'blog',
	'name'        => 'Blog',
	'description' => 'Blog section widget'
));
