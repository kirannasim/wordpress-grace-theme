<?php
/**
* Template Name: Gallery Page Template
 */

get_header(); ?>
	<div id="page-sub-header" class="banner" <?php if( $options['photo_gallery_banner_bg_image'] ) { ?>data-parallax data-image-src="<?php echo wp_get_attachment_image_src( $options['photo_gallery_banner_bg_image'], 'full' )[0]; ?>"<?php } ?>>
        <div class="container">
        	<?php if ( $options['photo_gallery_banner_title'] ): ?>
        		<h1 class="banner-title white-color"><?php echo $options['photo_gallery_banner_title']; ?></h1>
    		<?php endif; ?>
        </div>
    </div>

    <section class="section gallery-content">
    	<div class="container-fluid" data-plugin-isotope>
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
					<ul class="gallery-categories">
						<li><a href="javascript:void(0);" class="secondary-color active" data-filter="*">All</a></li>
						<?php
                        $terms = get_terms( 'gallery_cat' );
                        foreach ( $terms as $term ):
                        ?>
						<li><a href="javascript:void(0);" class="secondary-color" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="row" data-grid data-gallery-image-popup>
			<?php
            $arg = [
                'post_type' => 'post-gallery',
                'order' => 'ASC',
                'orderby' => 'menu_order',
                'posts_per_page' => -1,
            ];
            $the_query = new WP_Query( $arg );
            if ( $the_query->have_posts() ):
            	while ( $the_query->have_posts() ): $the_query->the_post();
            		$title = get_the_title();
            		$terms = wp_get_post_terms( get_the_ID(), 'gallery_cat' );
            		$slugs = array();

            		foreach ( $terms as $term ):
            			$slugs[] = $term->slug;
        			endforeach;

        			$class = implode( ' ', $slugs );
            		$gallery_type = get_field( 'gallery_type' );

                    if ( $gallery_type == 'Image' ) {
                    	$gallery_image = get_field( 'gallery_image' );
                    ?>
                	<div class="grid-item col-lg-3 col-md-6 col-12 <?php echo $class; ?>">
						<a class="gallery-img secondary-bgcolor" title="<?php echo $title; ?>" href="<?php echo wp_get_attachment_image_src( $gallery_image, 'full' )[0]; ?>" data-magnific-popup data-plugin-options="{'type':'image','closeOnContentClick':true,'mainClass':'mfp-img-mobile'}">
							<img src="<?php echo wp_get_attachment_image_src( $gallery_image, 'medium' )[0]; ?>" class="lazy" />
						</a>
					</div>
                	<?php 
                	} else { 
                		$gallery_video = get_field( 'gallery_video' );
                		$gallery_video_thumbnail = get_field( 'gallery_video_thumbnail' );
                		?>
                	<div class="grid-item col-lg-3 col-md-6 col-12 <?php echo $class; ?>">
						<a class="gallery-img secondary-bgcolor" title="<?php echo $title; ?>" href="<?php echo $gallery_video; ?>" data-plugin-video-popup>
							<img src="<?php echo wp_get_attachment_image_src( $gallery_video_thumbnail, 'medium' )[0]; ?>" class="lazy" />
						</a>
					</div>
                	<?php
	                }
                endwhile;
            endif;
    		?>
            	<!--
				
			-->
			</div>
		</div>
	</section>	

<?php
get_footer();