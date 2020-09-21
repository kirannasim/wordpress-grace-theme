<?php
/**
* Template Name: Amenities Page Template
 */

get_header(); ?>
	<div id="page-sub-header" class="banner" <?php if( $options['amenities_banner_bg_image'] ) { ?>data-parallax data-image-src="<?php echo wp_get_attachment_image_src( $options['amenities_banner_bg_image'], 'full' )[0]; ?>"<?php } ?>>
        <div class="container">
        	<?php if ( $options['amenities_banner_title'] ): ?>
        		<h1 class="banner-title white-color"><?php echo $options['amenities_banner_title']; ?></h1>
    		<?php endif; ?>
        </div>
    </div>

    <section class="section amenities-feature-boxes">
        <div class="container">
            <div class="row">
                <div class="col-12">
                <?php if ( $options['amenities_feature_box_title'] ) { ?>
                <h3 class="text-center section-title secondary-color"><?php echo $options['amenities_feature_box_title']; ?></h3>
                <?php } ?>

                <?php if ( $options['amenities_feature_boxes'] ) { ?>
                <div class="amenities-feature-content" data-tabs>
                    <ul class="tabs-nav" data-tab-list>
                    <?php 
                    $inx = 0;                    
                    foreach ( $options['amenities_feature_boxes'] as $box ) {
                        $box_title = $box['title'];
                        $id = strtolower( $box_title );
                        $id = str_replace( ' ', '_', $id );
                        $class = ( $inx == 0 ) ? 'active' : '';
                        $inx ++;
                        ?>
                        <li>
                            <a href="#<?php echo $id; ?>" class="secondary-color <?php echo $class; ?>"><?php echo $box_title; ?></a>
                        </li>
                    <?php } ?>
                    </ul>
                    <?php 
                    $inx = 0; 
                    foreach ( $options['amenities_feature_boxes'] as $box ) {
                        $id = strtolower( $box['title'] );
                        $id = str_replace( ' ', '_', $id );
                        $class = ( $inx == 0 ) ? 'active' : '';
                        $inx ++;
                    ?>
                    <div class="row tab-content no-gutters <?php echo $class; ?>" id="<?php echo $id; ?>">
                        <div class="col-lg-6 left-area">
                        <?php echo $box['desc']; ?>
                        </div>

                        <div class="col-lg-6 right-area">
                        <?php if ( $box['display_options'] == 'image' ) {
                            if ( $box['image'] ) { 
                            ?>
                            <img src="<?php echo wp_get_attachment_image_src( $box['image'], 'full' )[0]; ?>" class="lazy" />
                            <?php
                            }
                        } else if ( $box['display_options'] == 'video' ) {
                            if ( $box['video'] ) {
                            ?>
                            <video autoplay loop controls>
                                <source src="<?php echo $box['video']['url']; ?>" type="<?php echo $box['video']['mime_type']; ?>">
                            </video>
                            <?php 
                            }
                        } else if ( $box['display_options'] == 'slider' ) {
                            if ( $box['slider'] ) {
                            ?>
                            <div class="owl-carousel owl-theme" data-owl-carousel data-plugin-options="{'margin':0, 'dots':true, 'items':1, 'responsive':{'768':{'items':1}}}">
                                <?php foreach ( $box['slider'] as $img ) { ?>
                                <img class="owl-lazy img-responsive" data-src="<?php echo wp_get_attachment_image_src( $img, 'full' )[0]; ?>" />
                                <?php } ?>
                            </div>
                            <?php 
                            }
                        } ?>
                        </div>
                    </div>
                    <?php } ?>                    
                </div>
                <?php } ?>
                </div>            
            </div>
        </div>
    </section>

<?php
get_footer();