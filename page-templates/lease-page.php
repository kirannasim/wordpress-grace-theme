<?php
/**
* Template Name: Lease Page Template
 */

get_header(); ?>
	<div id="page-sub-header" class="banner">
        <div class="container">
        	<h1 class="banner-title white-color">Lease</h1>
        </div>
    </div>

    <section class="section privacy-policy">
        <div class="container">
            <div class="row">
                <div class="col">
                <?php echo $options['lease_iframe_code']; ?>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();