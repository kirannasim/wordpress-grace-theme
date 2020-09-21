<?php
/**
 * The main template file
 */

get_header(); ?>	
    <div id="page-sub-header">
        <div class="container">
            <h1><?php echo 'repli-grace'; ?></h1>
            <p>
            	<?php
                echo esc_html__('To customize the contents of this header banner and other elements of your site, go to Dashboard > Appearance > Customize','repli-grace');
                ?>
            </p>
            <a href="#content" class="page-scroller"><i class="fa fa-fw fa-angle-down"></i></a>
        </div>
    </div>
    
	<div id="content" class="site-content">
		<div class="container">
			<div class="row">			
				<section id="primary" class="content-area col-sm-12 col-lg-8">
					<main id="main" class="site-main" role="main">

						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'page' );

			                // If comments are open or we have at least one comment, load up the comment template.
			                if ( comments_open() || get_comments_number() ) :
			                    comments_template();
			                endif;

						endwhile; // End of the loop.
						?>

					</main><!-- #main -->
				</section><!-- #primary -->

				<?php get_sidebar(); ?>
				
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- #content -->

<?php

get_footer();
