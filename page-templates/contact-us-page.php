<?php
/**
* Template Name: Contact Us Page Template
 */

get_header(); ?>
	<div id="page-sub-header" class="banner" <?php if( $options['contact_banner_bg_image'] ) { ?>data-parallax data-image-src="<?php echo wp_get_attachment_image_src( $options['contact_banner_bg_image'], 'full' )[0]; ?>"<?php } ?>>
        <div class="container">
        	<?php if ( $options['contact_banner_title'] ): ?>
        		<h1 class="banner-title white-color"><?php echo $options['contact_banner_title']; ?></h1>
    		<?php endif; ?>
        </div>
    </div>

    <section class="section contact-us-section">
    	<div class="container">
    		<div class="row">
				<div class="col-lg-6">
					<?php if ( $options['contact_content_title'] ): ?>
					<h4 class="secondary-color section-sub-title"><?php echo $options['contact_content_title']; ?></h4>
					<?php endif; ?>

					<?php if ( $options['contact_content'] ): ?>
					<?php echo $options['contact_content']; ?>
					<?php endif; ?>

					<?php if ( $options['contact_form_shortcode'] ): ?>
					<?php echo do_shortcode( $options['contact_form_shortcode'] ); ?>
					<?php endif; ?>
					
					<!--
					<form id="contactForm">						
						<div class="row">
							<div class="col-lg-6">
								<label for="first_name">First Name :</label>
								<input type="text" class="form-control" id="first_name" placeholder="" />
							</div>
							<div class="col-lg-6">
								<label for="last_name">Last Name :</label>
								<input type="text" class="form-control" id="last_name" placeholder="" />
							</div>
							<div class="col-lg-6">
								<label for="email">Email :</label>
								<input type="email" class="form-control" id="email" placeholder="" />
							</div>
							<div class="col-lg-6">
								<label for="phone">Phone :</label>
								<input type="text" class="form-control" id="phone" placeholder="" />
							</div>
							<div class="col-lg-6">
								<label for="desired_floor_plans">Desired Floor Plans :</label>
								<input type="text" class="form-control" id="desired_floor_plans" placeholder="" />
							</div>
							<div class="col-lg-6">
								<label for="desired_move_in_date">Desired Move-In Date :</label>
								<input type="text" class="form-control" id="desired_move_in_date" placeholder="" />
							</div>
							<div class="col-lg-12">
								<button type="submit" class="button primary-button">Send Now</button>
							</div>
						</div>						
					</form>
					-->
				</div>				
			    <div class="col-lg-6">
			        <div class="map" id="contactMap" data-plugin-googlemap data-lat="<?php echo $options['google_map_location']['lat']; ?>" data-lng="<?php echo $options['google_map_location']['lng']; ?>">
			        	<div class="info-window">
			            	<?php if ( $options['community_name'] ): ?>
			                <p class="info-window-category"><?php echo $options['community_name']; ?></p>
			                <?php endif; ?>

			                <?php if ( $options['community_address'] ): ?>
			                <p class="info-window-name"><?php echo $options['community_address']; ?></p>
			                <?php endif; ?>

			                <?php if ( $options['google_directions_link'] ): ?>
			                <a targe="_blank" href="<?php echo $options['google_directions_link']; ?>">GET DIRECTIONS</a>
			                <?php endif; ?>
			            </div>
			        </div>
			    </div>
			</div>			
		</div>
	</section>	

<?php
get_footer();