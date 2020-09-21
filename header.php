<?php
/**
 * The header for repli-grace theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
<?php
global $options;
$options = get_fields('options');
?>
<style>
    body { color: <?php echo $options['body_color']; ?>; }
    
    .primary-color { color: <?php echo $options['primary_color']; ?>; }
    .primary-bgcolor { background-color: <?php echo $options['primary_color']; ?>; }
    .form-control:focus { border-color: <?php echo $options['primary_color']; ?>; }
    .primary-button { background-color: <?php echo $options['primary_color']; ?>; border-color: <?php echo $options['primary_color']; ?>; }
    .primary-button:hover { color: <?php echo $options['primary_color']; ?> !important; }
    header#masthead .navbar-nav > li > a:hover { color: <?php echo $options['primary_color']; ?>; }
    .top-menu li a:hover { color: <?php echo $options['primary_color']; ?>; }
    footer.site-footer .footer-logos a:hover > i { color: <?php echo $options['primary_color']; ?>; }
    .gallery-categories li a.active, .gallery-categories li a:hover { background-color: <?php echo $options['primary_color']; ?>; }
    .tabs-nav li a.active, .tabs-nav li a:hover { background-color: <?php echo $options['primary_color']; ?>; }
    .info-window a { color: <?php echo $options['primary_color']; ?>; }
    .ui-widget.ui-widget-content { border: 2px solid <?php echo $options['primary_color']; ?>; }
    .ui-datepicker .ui-datepicker-header { background: <?php echo $options['primary_color']; ?>; }
    .ui-state-default, .ui-widget-content .ui-state-default { border: 1px solid <?php echo $options['primary_color']; ?>; }
    .ui-widget-content .ui-state-highlight.ui-state-active { background: <?php echo $options['primary_color']; ?>; }
    .ui-accordion .ui-accordion-header.ui-accordion-header-active { color: <?php echo $options['primary_color']; ?>; }
    .ui-accordion .ui-accordion-header.ui-accordion-header-active .ui-icon { color: <?php echo $options['primary_color']; ?>; }
    .ui-accordion .ui-accordion-content .location.active, .ui-accordion .ui-accordion-content .location:hover { color: <?php echo $options['primary_color']; ?>; }
    .owl-carousel.owl-theme .owl-nav button.owl-next, .owl-carousel.owl-theme .owl-nav button.owl-prev { background: <?php echo $options['primary_color']; ?>; border: 2px solid <?php echo $options['primary_color']; ?>; }
    a:active, a:hover, a:focus { color: <?php echo $options['primary_color']; ?>; }

    .secondary-color { color: <?php echo $options['secondary_color']; ?>; }
    .secondary-bgcolor { background-color: <?php echo $options['secondary_color']; ?>; }
    .header-button:hover { color: <?php echo $options['secondary_color']; ?>; }            
    footer.site-footer .copyright span { color: <?php echo $options['secondary_color']; ?>; }
    .info-window .info-window-category { color: <?php echo $options['secondary_color']; ?>; }
    .ui-datepicker th { color: <?php echo $options['secondary_color']; ?>; }
    .ui-state-default, .ui-widget-content .ui-state-default { color: <?php echo $options['secondary_color']; ?>; }
    .ui-accordion .ui-accordion-header { color: <?php echo $options['secondary_color']; ?>; }
    .ui-accordion .ui-accordion-content { color: <?php echo $options['secondary_color']; ?>; }

    body { font-family: '<?php echo $options["body_font"]["font_family"]; ?>', sans-serif; <?php if ( $options['body_font']['font_size'] ) { ?>font-size: <?php echo $options['body_font']['font_size']; ?>rem;<?php } ?> <?php if ( $options['body_font']['line_height'] ) { ?>line-height: <?php echo $options['body_font']['line_height']; ?>rem;<?php } ?> <?php if ( $options['body_font']['font_weight'] ) { ?>font-weight: <?php echo $options['body_font']['font_weight']; ?>;<?php } ?> }
    h1, h2, h3, h4, h5, h6 { font-family: '<?php echo $options["heading_font_family"]; ?>', sans-serif; }
    h1 { <?php if ( $options['h1_font']['font_size'] ) { ?>font-size: <?php echo $options['h1_font']['font_size']; ?>rem;<?php } ?> <?php if ( $options['h1_font']['line_height'] ) { ?>line-height: <?php echo $options['h1_font']['line_height']; ?>rem;<?php } ?> <?php if ( $options['h1_font']['font_weight'] ) { ?>font-weight: <?php echo $options['h1_font']['font_weight']; ?>;<?php } ?> }
    h2 { <?php if ( $options['h2_font']['font_size'] ) { ?>font-size: <?php echo $options['h2_font']['font_size']; ?>rem;<?php } ?> <?php if ( $options['h2_font']['line_height'] ) { ?>line-height: <?php echo $options['h2_font']['line_height']; ?>rem;<?php } ?> <?php if ( $options['h2_font']['font_weight'] ) { ?>font-weight: <?php echo $options['h2_font']['font_weight']; ?>;<?php } ?> }
    h3 { <?php if ( $options['h3_font']['font_size'] ) { ?>font-size: <?php echo $options['h3_font']['font_size']; ?>rem;<?php } ?> <?php if ( $options['h3_font']['line_height'] ) { ?>line-height: <?php echo $options['h3_font']['line_height']; ?>rem;<?php } ?> <?php if ( $options['h3_font']['font_weight'] ) { ?>font-weight: <?php echo $options['h3_font']['font_weight']; ?>;<?php } ?> }
    h4 { <?php if ( $options['h4_font']['font_size'] ) { ?>font-size: <?php echo $options['h4_font']['font_size']; ?>rem;<?php } ?> <?php if ( $options['h4_font']['line_height'] ) { ?>line-height: <?php echo $options['h4_font']['line_height']; ?>rem;<?php } ?> <?php if ( $options['h4_font']['font_weight'] ) { ?>font-weight: <?php echo $options['h4_font']['font_weight']; ?>;<?php } ?> }
    h5 { <?php if ( $options['h5_font']['font_size'] ) { ?>font-size: <?php echo $options['h5_font']['font_size']; ?>rem;<?php } ?> <?php if ( $options['h5_font']['line_height'] ) { ?>line-height: <?php echo $options['h5_font']['line_height']; ?>rem;<?php } ?> <?php if ( $options['h5_font']['font_weight'] ) { ?>font-weight: <?php echo $options['h5_font']['font_weight']; ?>;<?php } ?> }
    h6 { <?php if ( $options['h6_font']['font_size'] ) { ?>font-size: <?php echo $options['h6_font']['font_size']; ?>rem;<?php } ?> <?php if ( $options['h6_font']['line_height'] ) { ?>line-height: <?php echo $options['h6_font']['line_height']; ?>rem;<?php } ?> <?php if ( $options['h6_font']['font_weight'] ) { ?>font-weight: <?php echo $options['h6_font']['font_weight']; ?>;<?php } ?> }
    p { <?php if ( $options['body_font']['font_size'] ) { ?>font-size: <?php echo $options['body_font']['font_size']; ?>rem;<?php } ?> <?php if ( $options['body_font']['line_height'] ) { ?>line-height: <?php echo $options['body_font']['line_height']; ?>rem;<?php } ?>}
    .section-title { <?php if ( $options['section_title_font']['font_size'] ) { ?>font-size: <?php echo $options['section_title_font']['font_size']; ?>rem;<?php } ?> <?php if ( $options['section_title_font']['line_height'] ) { ?>line-height: <?php echo $options['section_title_font']['line_height']; ?>rem;<?php } ?> <?php if ( $options['section_title_font']['font_weight'] ) { ?>font-weight: <?php echo $options['section_title_font']['font_weight']; ?>;<?php } ?> }
    .section-sub-title { <?php if ( $options['section_sub_title_font']['font_size'] ) { ?>font-size: <?php echo $options['section_sub_title_font']['font_size']; ?>rem;<?php } ?> <?php if ( $options['section_sub_title_font']['line_height'] ) { ?>line-height: <?php echo $options['section_sub_title_font']['line_height']; ?>rem;<?php } ?> <?php if ( $options['section_sub_title_font']['font_weight'] ) { ?>font-weight: <?php echo $options['section_sub_title_font']['font_weight']; ?>;<?php } ?> }
</style>

<?php
if ( $options['header_code'] ):
    echo htmlspecialchars_decode( $options['header_code'] );
endif;
?>

</head>

<body <?php body_class(); ?>> 
<div id="page" class="site">
    <header id="masthead" class="site-header navbar-static-top sticky" role="banner">
        <div class="container-fluid m-0 p-0">
            <div class="header-menu">
                <div class="header-menu-row header-menu-top primary-bgcolor">
                    <ul class="top-menu top-menu-left">
                        <li><a href="tel:<?php echo $options['phone_number']; ?>"><i class="fas fa-phone-volume"></i> <?php echo $options['phone_number']; ?></a></li>
                        <li><a href="<?php $options['google_directions_link']; ?>"><i class="fas fa-map-marker-alt"></i> Get Directions</a></li>                        
                        <li>
                            <a href="#office_hours" data-magnific-popup><i class="far fa-clock"></i> Office Hours</a>
                            <div id="office_hours" class="white-popup-block mfp-hide">
                                <h4 class="primary-color">Office Hours</h4>
                                <?php if ( $options['office_hours'] ) { ?>
                                <ul class="office-hours">
                                    <?php foreach ( $options['office_hours'] as $item ) { ?>
                                        <li>
                                        <span class="day secondary-color"><?php echo $item['day']; ?>:</span>
                                        <span class="hours"><?php echo $item['hours']; ?></span>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="header-menu-row header-menu-bottom">
                    <div class="navbar-brand">                    
                        <?php if ( $options['community_logo_color'] ): ?>
                            <a href="<?php echo esc_url( home_url( '/' )); ?>">
                                <img class="logo-white" src="<?php echo esc_url( $options['community_logo_white'] ); ?>" alt="<?php echo esc_attr( $options['community_name'] ); ?>">
                                <img class="logo-color" src="<?php echo esc_url( $options['community_logo_color'] ); ?>" alt="<?php echo esc_attr( $options['community_name'] ); ?>">
                            </a>
                        <?php endif; ?>

                        <button class="navbar-toggler d-xl-none" type="button" data-toggle="collapse" data-target=".navbar-expand-xl" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>

                    <nav class="navbar navbar-expand-xl p-0 m-0 collapse">
                        <?php
                        wp_nav_menu(array(
                            'theme_location'  => 'primary',
                            'container'       => 'div',
                            'container_id'    => 'main-nav',
                            'container_class' => '',
                            'menu_id'         => false,
                            'menu_class'      => 'navbar-nav',
                            'depth'           => 3
                        ));
                        ?>

                        <div class="navbar-buttons">
                            <a href="<?php echo get_home_url(); ?>/lease-now/" class="button header-button">Lease Now</a>
                        </div>                        
                    </nav>
                </div>                        
            </div>               

            
        </div>
    </header><!-- #masthead -->    