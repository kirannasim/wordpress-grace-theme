<?php
/**
* Template Name: Privacy Policy Page Template
 */

get_header(); ?>
	<div id="page-sub-header" class="banner">
        <div class="container">
        	<h1 class="banner-title white-color">Privacy Policy</h1>
        </div>
    </div>

    <section class="section privacy-policy">
        <div class="container">
            <div class="row">
                <?php echo $options['privacy_policy']; ?>
            </div>
        </div>
    </section>

<?php
get_footer();