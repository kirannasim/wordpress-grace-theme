<?php
/**
 * Created by Kiran Nasim
 * 01/05/20
 * 
 * Enqueue scripts and styles
 *
 */

if ( ! function_exists( 'repli_grace_theme_scripts' ) ) {
	function repli_grace_theme_scripts() {
	    // Load bootstrap css
	    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css', false );
	    wp_enqueue_style( 'fontawesome-cdn', 'https://use.fontawesome.com/releases/v5.10.2/css/all.css', false );

	    // Load jQuery ui
	    wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', false );
	    wp_enqueue_script( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery') );

	    // Load repli grace styles
	    wp_enqueue_style( 'repli-grace-style', get_stylesheet_uri() );

		// Load Rajdhani Google Font
	    wp_enqueue_style( 'Rajdhani-font', 'https://fonts.googleapis.com/css?family=Rajdhani:300,400,500,600,700&display=swap', false );
	    wp_enqueue_style( 'Merriweather-font', 'https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i&display=swap', false );
	    wp_enqueue_style( 'Roboto-font', 'https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap', false );
	    wp_enqueue_style( 'Open-Sans-font', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap', false );
	    wp_enqueue_style( 'Lato-font', 'https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&display=swap', false );
	    wp_enqueue_style( 'Slabo-font', 'https://fonts.googleapis.com/css?family=Slabo+27px&display=swap', false );
	    wp_enqueue_style( 'Oswald-font', 'https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&display=swap', false );
	    wp_enqueue_style( 'Source-Sans-Pro-font', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&display=swap', false );
	    wp_enqueue_style( 'Montserrat-font', 'https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap', false );
	    wp_enqueue_style( 'Raleway-font', 'https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap', false );
	    wp_enqueue_style( 'PT-Sans-font', 'https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap', false );
	    wp_enqueue_style( 'Lora-font', 'https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap', false );
	    wp_enqueue_style( 'Noto-Sans-font', 'https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&display=swap', false );
	    wp_enqueue_style( 'Nunito-Sans-font', 'https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap', false );
	    wp_enqueue_style( 'Concert-One-font', 'https://fonts.googleapis.com/css?family=Concert+One&display=swap', false );
	    wp_enqueue_style( 'Prompt-font', 'https://fonts.googleapis.com/css?family=Prompt:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap', false );
	    wp_enqueue_style( 'Work-Sans-font', 'https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900&display=swap', false );

	    // Load Isotope JQuery plugin
	    wp_enqueue_script( 'isotope', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js', array('jquery') );

	    // Load Lazyload jQuery plugin
	    wp_enqueue_script( 'lazyload', get_stylesheet_directory_uri() . '/assets/vendors/jquery.lazyload/jquery.lazyload.min.js', array('jquery') );

	    // Load Magnific popup jQuery plugin
	    wp_enqueue_style( 'magnific', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css', false );
	    wp_enqueue_script( 'magnific', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js', array('jquery') );

	    // Load Owl Carousel jQuery plugin
	    wp_enqueue_style( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', false );
	    wp_enqueue_style( 'owl-theme-default', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', false );
		wp_enqueue_script( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery') );

		// Load Lazyload jQuery plugin
		// wp_enqueue_script( 'parallax', get_stylesheet_directory_uri() . '/assets/vendors/parallax/parallax.min.js', array('jquery') );    

	    // Load theme script
	    wp_enqueue_script( 'theme', get_stylesheet_directory_uri() . '/assets/js/theme.min.js', array( 'isotope', 'magnific', 'lazyload' ) );

	    // Load google map API script
	    wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA5maTRl3qDRD7To-_5UWbLKcEEaEzaapA', false ); 
	}
	add_action( 'wp_enqueue_scripts', 'repli_grace_theme_scripts', 10, 2 );
}