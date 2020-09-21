<?php

define( 'HOME_URL', trailingslashit( home_url() ) );
define( 'THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'THEME_URL', trailingslashit( get_template_directory_uri() ) );

if ( ! function_exists( 'repli_grace_include_library' ) ) {
    function repli_grace_include_library() {
        require_once( THEME_DIR . 'inc/register-require-plugin.php');
        require_once( THEME_DIR . 'inc/theme-setup.php' );
        require_once( THEME_DIR . 'inc/theme-scripts.php' );
        require_once( THEME_DIR . 'inc/custom-post.php' );
    }

    repli_grace_include_library();
}

/**
 * Convert hex color to rgba
 *
 */
function hexToRGB( $hex, $alpha = 1 ) {
   $hex     = str_replace( '#', '', $hex );
   $length  = strlen( $hex );
   $r       = hexdec( $length == 6 ? substr( $hex, 0, 2 ) : ( $length == 3 ? str_repeat( substr( $hex, 0, 1 ), 2 ) : 0 ) );
   $g       = hexdec( $length == 6 ? substr( $hex, 2, 2 ) : ( $length == 3 ? str_repeat( substr( $hex, 1, 1 ), 2 ) : 0 ) );
   $b       = hexdec( $length == 6 ? substr( $hex, 4, 2 ) : ( $length == 3 ? str_repeat( substr( $hex, 2, 1 ), 2 ) : 0 ) );
   
   return 'rgba(' . $r . ', ' . $g . ', ' . $b . ', ' . $alpha . ')';
}