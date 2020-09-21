<?php
/**
* Template Name: Floor Plans Page Template
 */

get_header(); ?>
	<div id="page-sub-header" class="banner" <?php if( $options['floor_plans_banner_image'] ) { ?>data-parallax data-image-src="<?php echo wp_get_attachment_image_src( $options['floor_plans_banner_image'], 'full' )[0]; ?>"<?php } ?>>
        <div class="container">
        	<?php if ( $options['floor_plans_banner_title'] ): ?>
        		<h1 class="banner-title white-color"><?php echo $options['floor_plans_banner_title']; ?></h1>
    		<?php endif; ?>
        </div>
    </div>

	<section class="section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php if ( $options['floor_plans_homes_shortcode'] ):
						echo do_shortcode( $options['floor_plans_homes_shortcode'] );
					endif; ?>
				</div>
			</div>
		</div>
	</section>	

<?php
get_footer();