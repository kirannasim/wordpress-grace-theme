<?php
/**
 * Created by Kiran Nasim
 * 01/05/20
 * 
 * Register required wp plugins
 *
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once THEME_DIR . 'inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

if ( ! function_exists( 'repli_grace_register_required_plugins' ) ) {
	add_action( 'tgmpa_register', 'repli_grace_register_required_plugins' );
	/**
	 * Register the required plugins for this theme.
	 *
	 * In this example, we register two plugins - one included with the TGMPA library
	 * and one from the .org repo.
	 *
	 * The variable passed to tgmpa_register_plugins() should be an array of plugin
	 * arrays.
	 *
	 * This function is hooked into tgmpa_init, which is fired within the
	 * TGM_Plugin_Activation class constructor.
	 */
	function repli_grace_register_required_plugins() {
	    /*
	     * Array of plugin arrays. Required keys are name and slug.
	     * If the source is NOT from the .org repo, then source is also required.
	     */
	    $plugins = array(

	        array(
			    'name'               => 'Advanced Custom Fields Pro', // The plugin name
			    'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name)
			    'source'             => get_template_directory() .  '/theme-plugins/advanced-custom-fields-pro.zip', // The plugin source
			    'required'           => true, // If false, the plugin is only 'recommended' instead of required
			    'version'            => '5.8.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			    'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			    'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			    'external_url'       => '', // If set, overrides default API URL and points to an external URL
		    ),
		    array(
			    'name'               => 'Advanced Custom Fields: Extended', // The plugin name
			    'slug'               => 'acf-extended', // The plugin slug (typically the folder name)
			    'source' 			 => get_template_directory() .  '/theme-plugins/acf-extended.zip', // The plugin source
			    'required'           => true, // If false, the plugin is only 'recommended' instead of required
			    'version' 			 => '0.8.3.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			    'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			    'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			    'external_url'       => '', // If set, overrides default API URL and points to an external URL
		    ),
	        array(
	            'name'               => 'EnvaREPLI ApartmentSync', // The plugin name
	            'slug'               => 'repli_realpage_apartment_sync', // The plugin slug (typically the folder name)
	            'source'             => get_template_directory() . '/theme-plugins/repli_realpage_apartment_sync.zip', // The plugin source
	            'required'           => true, // If false, the plugin is only 'recommended' instead of required
	            'version'            => '1.4.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
	            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
	            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	            'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
	            'name'               => 'Contact Form 7', // The plugin name
	            'slug'               => 'contact-form-7', // The plugin slug (typically the folder name)
	            'source'             => get_template_directory() . '/theme-plugins/contact-form-7.zip', // The plugin source
	            'required'           => true, // If false, the plugin is only 'recommended' instead of required
	            'version'            => '5.1.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
	            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
	            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	            'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
	            'name'               => 'ReCaptcha v2 for Contact Form 7', // The plugin name
	            'slug'               => 'wpcf7-recaptcha', // The plugin slug (typically the folder name)
	            'source'             => get_template_directory() . '/theme-plugins/wpcf7-recaptcha.zip', // The plugin source
	            'required'           => true, // If false, the plugin is only 'recommended' instead of required
	            'version'            => '1.2.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
	            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
	            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	            'external_url'       => '', // If set, overrides default API URL and points to an external URL
	        ),
	    );

	    /*
	     * Array of configuration settings. Amend each line as needed.
	     * If you want the default strings to be available under your own theme domain,
	     * leave the strings uncommented.
	     * Some of the strings are added into a sprintf, so see the comments at the
	     * end of each line for what each argument will be.
	     */

	    // Change this to your theme text domain, used for internationalising strings
	    $theme_text_domain = 'repli-grace';
	    $config = array(
	        'domain'       => $theme_text_domain,
	        'id'           => 'repli_grace_theme_id',                 // Unique ID for hashing notices for multiple instances of TGMPA.
	        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
	        'menu'         => 'install-required-plugins', // Menu slug.
	        'parent_slug'  => 'themes.php',            // Parent menu slug.
	        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
	        'has_notices'  => true,                    // Show admin notices or not.
	        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
	        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
	        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
	        'message'      => '',                      // Message to output right before the plugins table.
	        'strings'      => array(
	            'page_title'                      => __( 'Install Required Plugins', 'repli-grace' ),
	            'menu_title'                      => __( 'Install Plugins', 'repli-grace' ),
	            'installing'                      => __( 'Installing Plugin: %s', 'repli-grace' ), // %s = plugin name.
	            'oops'                            => __( 'Something went wrong with the plugin API.', 'repli-grace' ),
	            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'repli-grace' ), // %1$s = plugin name(s).
	            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'repli-grace' ), // %1$s = plugin name(s).
	            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'repli-grace' ), // %1$s = plugin name(s).
	            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'repli-grace' ), // %1$s = plugin name(s).
	            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'repli-grace' ), // %1$s = plugin name(s).
	            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'repli-grace' ), // %1$s = plugin name(s).
	            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'repli-grace' ), // %1$s = plugin name(s).
	            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'repli-grace' ), // %1$s = plugin name(s).
	            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'repli-grace' ),
	            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'repli-grace' ),
	            'return'                          => __( 'Return to Required Plugins Installer', 'repli-grace' ),
	            'plugin_activated'                => __( 'Plugin activated successfully.', 'repli-grace' ),
	            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'repli-grace' ), // %s = dashboard link.
	            'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
	        )
	    );

	    tgmpa( $plugins, $config );

	}
}