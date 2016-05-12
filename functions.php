<?php

define( 'MY_THEME_BASE_PATH', get_template_directory() );
define( 'MY_THEME_BASE_URI', get_template_directory_uri() );
define( 'MY_THEME_ASSETS_URI', MY_THEME_BASE_URI . '/assets' );
define( 'MY_THEME_BUILD_URI', MY_THEME_BASE_URI . '/build' );
define( 'MY_THEME_VERSION', '1.0' );

require_once get_template_directory() . '/includes/theme-enqueue.php';

class my_theme {

	protected $theme_enqueue;

	function __construct() {
		$this->theme_enqueue = new my_theme_enqueue();
	}

	function theme_enqueue() {
		$this->theme_enqueue->theme_scripts();
	}

	function theme_setup() {
		add_theme_support( 'title-tag' );

		register_nav_menus( array(
			'top_header'   => __( 'Top Header', 'wp-crowd' ),
			'header'       => __( 'Header Menu', 'wp-crowd' ),
			'footer_left'  => __( 'Footer Menu (Left)', 'wp-crowd' ),
			'footer_right' => __( 'Footer Menu (Right)', 'wp-crowd' ),
		) );

	}

	function register_sidebars() {
		register_sidebar( array(
			'name' => __( 'Home Sidebar', 'wp-crowd' ),
			'id' => 'home-sidebar',
			'description' => __( 'Home Page Sidebar.', 'wp-crowd' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		) );
	}
}

$my_theme = new my_theme();

add_action( 'wp_enqueue_scripts', array( $my_theme, 'theme_enqueue' ) );
add_action( 'after_setup_theme', array( $my_theme, 'theme_setup' ) );
add_action( 'widgets_init', array( $my_theme, 'register_sidebars' ) );