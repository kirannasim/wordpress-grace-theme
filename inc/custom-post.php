<?php
/**
 * Created by Kiran Nasim
 * 01/05/20
 * 
 * Customize the post types and taxonomics
 *
 */

/**
 * Register post types
 *
 */
if ( ! function_exists( 'repli_grace_register_post_types' ) ) {
    function repli_grace_register_post_types() {

        /**
         * Post Type: Neighborhood.
         */

        $labels = array(
            'name' => __( 'Neighborhood', 'repli-grace'),
            'singular_name' => __( 'Neighborhood', 'repli-grace' ),
        );

        $args = array(
            'label'                 => __( 'Neighborhood' , 'repli-grace' ),
            'labels'                => $labels,
            'description'           => '',
            'public'                => true,
            'publicly_queryable'    => false,
            'show_ui'               => true,
            'delete_with_user'      => false,
            'show_in_rest'          => true,
            'rest_base'             => '',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'has_archive'           => false,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => false,
            'exclude_from_search'   => true,
            'capability_type'       => 'post',
            'map_meta_cap'          => true,
            'hierarchical'          => false,
            'query_var'             => true,
            'menu_position'         => 6,
            'menu_icon'             => 'dashicons-flag',
            'supports'              => array( 'title', 'page-attributes' ),
            'taxonomies'            => array( 'neighborhood_cat' ),
        );

        register_post_type( 'post-neighborhood', $args );

        /**
         * Post Type: Gallery.
         */

        $labels = array(
            'name' => __( 'Gallery', 'repli-grace' ),
            'singular_name' => __( 'Gallery', 'repli-grace' ),
        );

        $args = array(
            'label'                 => __( 'Gallery', 'repli-grace' ),
            'labels'                => $labels,
            'description'           => '',
            'public'                => true,
            'publicly_queryable'    => false,
            'show_ui'               => true,
            'delete_with_user'      => false,
            'show_in_rest'          => true,
            'rest_base'             => '',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'has_archive'           => false,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => false,
            'exclude_from_search'   => true,
            'capability_type'       => 'post',
            'map_meta_cap'          => true,
            'hierarchical'          => false,
            'query_var'             => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-format-gallery',
            'supports'              => array( 'title', 'page-attributes' ),
            'taxonomies'            => array( 'gallery_cat' ),
        );

        register_post_type( 'post-gallery', $args );
    }
    add_action( 'init', 'repli_grace_register_post_types' );
}


/**
 * Register custom taxonomies.
 *
 */
if ( ! function_exists( 'repli_grace_register_taxes' ) ) {
    function repli_grace_register_taxes() {

        /**
         * Gallery Categories.
         */

        $labels = array(
            'name'                  => __( 'Gallery Categories', 'repli-grace' ),
            'singular_name'         => __( 'Gallery Category', 'repli-grace' ),
        );

        $args = array(
            'label'                 => __( 'Gallery Categories', 'repli-grace' ),
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => false,
            'hierarchical'          => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => false,
            'query_var'             => true,
            'show_admin_column'     => true,
            'show_in_rest'          => true,
            'rest_controller_class' => 'WP_REST_Terms_Controller',
            'show_in_quick_edit'    => true,
        );
        register_taxonomy( 'gallery_cat', array( 'post-gallery' ), $args );

        /**
         * Neighborhood Categories.
         */

        $labels = array(
            'name'                  => __( 'Neighborhood Categories', 'repli-grace' ),
            'singular_name'         => __( 'Neighborhood Category', 'repli-grace' ),
        );

        $args = array(
            'label'                 => __( 'Neighborhood Categories', 'repli-grace' ),
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => false,
            'hierarchical'          => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => false,
            'query_var'             => true,
            'show_admin_column'     => true,
            'show_in_rest'          => true,
            'rest_controller_class' => 'WP_REST_Terms_Controller',
            'show_in_quick_edit'    => true,
        );
        register_taxonomy( 'neighborhood_cat', array( 'post-neighborhood' ), $args );

    }
    add_action( 'init', 'repli_grace_register_taxes' );
}