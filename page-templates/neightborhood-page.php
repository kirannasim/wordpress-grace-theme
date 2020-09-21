<?php
/**
* Template Name: Neighborhood Page Template
 */

get_header(); ?>
	<div id="page-sub-header" class="banner" <?php if( $options['neighborhood_banner_bg_image'] ) { ?>data-parallax data-image-src="<?php echo wp_get_attachment_image_src( $options['neighborhood_banner_bg_image'], 'full' )[0]; ?>"<?php } ?>>
        <div class="container">
        	<?php if ( $options['neighborhood_banner_title'] ): ?>
        		<h1 class="banner-title white-color"><?php echo $options['neighborhood_banner_title']; ?></h1>
    		<?php endif; ?>
        </div>
    </div>

	<section class="section neighborhood-map-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="tabs-nav" data-plugin-neighborhood-map data-center-lat="<?php echo $options['google_map_location']['lat']; ?>" data-center-lng="<?php echo $options['google_map_location']['lng']; ?>">
                    <?php
                    $terms = get_terms( 'neighborhood_cat' );
                    foreach ( $terms as $term ):
                    ?>
                        <li>
                            <a href="javascript:void(0)" class="secondary-color neighborhood-category" data-category="<?php echo $term->name; ?>"><?php echo $term->name; ?></a>                            
                            <?php
                            $arg = [
                                'post_type' => 'post-neighborhood',
                                'order' => 'ASC',
                                'orderby' => 'menu_order',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'neighborhood_cat',
                                        'field' => 'slug',
                                        'terms' => $term->slug,
                                    ),
                                ),
                            ];
                            $the_query = new WP_Query( $arg );
                            if ( $the_query->have_posts() ):
                                while ( $the_query->have_posts() ): $the_query->the_post();
                                    $title = get_the_title();
                                    $img_id = get_field( 'neighborhood_image' );
                                    $location = get_field( 'neighborhood_location' );
                                    ?>
                                <div class="location" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                                    <div class="location-infowindow-content">
                                        <div class="info-window">                                            
                                            <?php if ( $img_id ) {
                                                echo wp_get_attachment_image( $img_id, 'medium' );
                                            } else { ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/img_210X140.png" />
                                            <?php } ?>
                                            <p class="info-window-category"><?php echo $term->name; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="map" id="map"></div>
                </div>                
            </div>
        </div>
		
	</section>

<?php
get_footer();