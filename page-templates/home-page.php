<?php
/**
* Template Name: Home Page Template
 */

get_header(); ?>
	<?php if ( $options['home_banner_bg_options'] == 'image' ) { ?>
	<div id="page-sub-header" class="home-banner banner" <?php if( $options['home_banner_bg_image'] ) { ?> style="background-image: url(<?php echo wp_get_attachment_image_src( $options['home_banner_bg_image'], 'full' )[0]; ?>)" <?php } ?>>
	<?php } else if ( $options['home_banner_bg_options'] == 'video' ) { ?>
	<div id="page-sub-header" class="home-banner banner video-bg">
		<?php if( $options['home_banner_bg_video'] ) { ?>		
		<div class="video-bg-wrapper">
			<video autoplay muted loop>
			  	<source src="<?php echo $options['home_banner_bg_video']['url']; ?>" type="<?php echo $options['home_banner_bg_video']['mime_type']; ?>">
			</video>
		</div>
		<?php } ?>	
	<?php } else if ( $options['home_banner_bg_options'] == 'slider' ) { ?>
	<div id="page-sub-header" class="home-banner banner slider-bg">
		<?php if( $options['home_banner_bg_slider'] ) { ?>		
		<div class="slider-bg-wrapper">
			<div class="owl-carousel owl-theme" data-owl-carousel data-plugin-options="{'margin':0, 'dots':true, 'items':1, 'responsive':{'768':{'items':1}}}">
				<?php foreach ( $options['home_banner_bg_slider'] as $img ) { ?>
				<img class="owl-lazy" data-src="<?php echo wp_get_attachment_image_src( $img['src'], 'full' )[0]; ?>" />
				<?php } ?>
			</div>
		</div>
		<?php } ?>
	<?php } ?>
		
		<div class="home-banner-overlay" style="background-color: <?php echo $options['home_banner_overlay_color'];?>; opacity: <?php echo $options['home_banner_overlay_opacity'];?>"></div>

        <div class="container">
        	<?php if ( $options['home_banner_title'] ): ?>
        	<h1 class="white-color"><?php echo $options['home_banner_title']; ?></h1>
    		<?php endif; ?>

			<?php if ( $options['home_banner_desc'] ): ?>
    		<h5 class="white-color"><?php echo $options['home_banner_desc']; ?></h5>
			<?php endif; ?>

			<?php if ( $options['home_banner_button'] ) {
				$title = $options['home_banner_button']['title'];

				if ( $options['home_banner_button']['function_options'] == 'link' ) {
					$link = $options['home_banner_button']['link'];
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<a class="button primary-button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" title="<?php echo esc_html( $link_title ); ?>"><?php echo esc_html( $title ); ?></a>
					<?php
				} else if ( $options['home_banner_button']['function_options'] == 'javascript' ) {
					$function = $options['home_banner_button']['javascript_function'];
					?>
					<a class="button primary-button" href="javascript:void(0);" onclick="<?php echo $function; ?>;"><?php echo esc_html( $title ); ?></a>
					<?php
				}
			} ?>
		</div><!-- end .container -->		
    </div><!-- end #page-sub-header -->

    <section class="section about-section">    	
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
			    	<?php if ( $options['home_about_title'] ): ?>
			    	<h3 class="section-title secondary-color"><?php echo $options['home_about_title']; ?></h3>
			    	<?php endif; ?>	

					<?php if ( $options['home_about_desc'] ): ?>
						<?php echo $options['home_about_desc']; ?>
					<?php endif; ?>

					<?php if ( $options['home_about_btn'] ) {
						$title = $options['home_about_btn']['title'];

						if ( $options['home_about_btn']['function_options'] == 'link' ) {
							$link = $options['home_about_btn']['link'];
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
							?>
							<a class="button primary-button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" title="<?php echo esc_html( $link_title ); ?>"><?php echo esc_html( $title ); ?></a>
							<?php
						} else if ( $options['home_about_btn']['function_options'] == 'javascript' ) {
							$function = $options['home_about_btn']['javascript_function'];
							?>
							<a class="button primary-button" href="javascript:void(0);" onclick="<?php echo $function; ?>;"><?php echo esc_html( $title ); ?></a>
							<?php
						}
					} ?>
				</div>
				<div class="col-lg-6">
					<div class="feature-img">
					<?php if ( $options['home_about_show_options'] == 'image' ) {?>
						<?php if ( $options['home_about_image'] ) { ?>
						<img src="<?php echo wp_get_attachment_image_src( $options['home_about_image'], 'full' )[0]; ?>" class="lazy" />
						<?php  } ?>
					<?php } else if ( $options['home_about_show_options'] == 'video' ) { ?>
						<?php if ( $options['home_about_video'] ) { ?>
						<video autoplay loop controls>
							<source src="<?php echo $options['home_about_video']['url']; ?>" type="<?php echo $options['home_about_video']['mime_type']; ?>">
						</video>
						<?php } ?>
					<?php } else if ( $options['home_about_show_options'] == 'slider' ) { ?>
						<?php if ( $options['home_about_slider'] ) { ?>
						<div class="owl-carousel owl-theme" data-owl-carousel data-plugin-options="{'margin':0, 'dots':true, 'items':1, 'responsive':{'768':{'items':1}}}">
							<?php foreach ( $options['home_about_slider'] as $img ) { ?>
							<img class="owl-lazy img-responsive" data-src="<?php echo wp_get_attachment_image_src( $img, 'full' )[0]; ?>" />
							<?php } ?>
						</div>
						<?php } ?>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>		
	</section>

	<section class="section slider-section">
		<div class="container-fluid pl-0 pr-0">
			<div class="row no-gutters">
				<div class="col-12">
					<?php if ( $options['home_slider_images'] ) { ?>
					<div class="owl-carousel owl-theme" data-owl-carousel data-plugin-options="{'margin':0, 'nav':true, 'items':4, 'responsive':{'1200':{'items':4}}}">
						<?php foreach ( $options['home_slider_images'] as $img_id ) { ?>
						<img class="owl-lazy img-responsive" data-src="<?php echo wp_get_attachment_image_src( $img_id, 'full' )[0]; ?>" />
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>

	<section class="section floor-plans-section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php if ( $options['home_floor_plans_title'] ): ?>
					<h3 class="section-title text-center secondary-color"><?php echo $options['home_floor_plans_title']; ?></h3>
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?php if ( $options['home_floor_plans_homes_shortcode'] ):
						echo do_shortcode( $options['home_floor_plans_homes_shortcode'] );
					endif; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="section contact-section" <?php if( $options['home_contact_bg'] ) { ?>data-parallax="scroll" data-image-src="<?php echo wp_get_attachment_image_src( $options['home_contact_bg'], 'full' )[0]; ?>"<?php } ?>>
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1 text-center">
					<?php if ( $options['home_contact_title'] ): ?>
					<h3 class="section-title text-center white-color"><?php echo $options['home_contact_title']; ?></h3>
					<?php endif; ?>

					<?php if ( $options['home_contact_desc'] ): ?>
					<p class="text-center white-color font-weight-light"><?php echo $options['home_contact_desc']; ?></p>
					<?php endif; ?>

					<?php if ( $options['home_contact_btns'] ) {
						foreach ( $options['home_contact_btns'] as $btn_group ) {
							$btn = $btn_group['btn_group'];
							$title = $btn['title'];

							if ( $btn['function_options'] == 'link' ) {
								$link = $btn['link'];
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<a class="button primary-button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" title="<?php echo esc_html( $link_title ); ?>"><?php echo esc_html( $title ); ?></a>
								<?php
							} else if ( $btn['function_options'] == 'javascript' ) {
								$function = $btn['javascript_function'];
								?>
								<a class="button primary-button" href="javascript:void(0);" onclick="<?php echo $function; ?>;"><?php echo esc_html( $title ); ?></a>
								<?php
							}
						}
					} ?>
				</div>
			</div>
		</div>
	</section>

<?php
get_footer();