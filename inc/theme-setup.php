<?php
/**
 * Created by Kiran Nasim
 * 01/05/20
 *
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

if ( ! function_exists( 'repli_grace_theme_setup' ) ) {
    function repli_grace_theme_setup() {
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
	    register_nav_menus( array(
	        'primary' => esc_html__( 'Primary', 'repli-grace' ),
	    ) );

	    register_nav_menus( array(
	        'top' => esc_html__( 'Top Menu', 'repli-grace' ),
	    ) );

	    /*
	     * Switch default core markup for search form, comment form, and comments
	     * to output valid HTML5.
	     */
	    add_theme_support( 'html5', array(
	        'comment-form',
	        'comment-list',
	        'caption',
	    ) );

	    // Add theme support for selective refresh for widgets.
	    add_theme_support( 'customize-selective-refresh-widgets' );
    }    
    add_action( 'after_setup_theme', 'repli_grace_theme_setup' );
}

// SET SESSION START
if ( ! function_exists( 'repli_grace_start_session' ) ) {
    function repli_grace_start_session() {
        if ( ! isset( $_SESSION ) ) {
            session_start();
        }
    }
    add_action( 'init', 'repli_grace_start_session', 1 );
}

if ( ! function_exists( 'repli_grace_theme_activation' ) ) {
    function repli_grace_theme_activation () {
        if ( class_exists( 'TGM_Plugin_Activation' ) ){
            $tgmpa = TGM_Plugin_Activation::$instance;
            $is_redirect_require_install = false;

            foreach ( $tgmpa->plugins as $p ) {
                $path =  ABSPATH . 'wp-content/plugins/' . $p['slug'];
                if ( ! is_dir( $path ) ){
                    $is_redirect_require_install = true;
                    break;
                }
            }

            if ( $is_redirect_require_install )
                header( 'Location: ' . admin_url() . 'themes.php?page=install-required-plugins' ) ;
        }
    }
    add_action( 'after_switch_theme', 'repli_grace_theme_activation' );
}

if ( ! function_exists( 'custom_acf_google_map_api' ) ) {
	function custom_acf_google_map_api( $api ) {
	    $api['key'] = 'AIzaSyA5maTRl3qDRD7To-_5UWbLKcEEaEzaapA';
	    return $api;
	}
	add_filter( 'acf/fields/google_map/api', 'custom_acf_google_map_api' );
}

if ( ! function_exists( 'custom_acf_init' ) ) {
	function custom_acf_init() {
	    acf_update_setting('google_api_key', 'AIzaSyA5maTRl3qDRD7To-_5UWbLKcEEaEzaapA');
	}
	add_action('acf/init', 'custom_acf_init');
}