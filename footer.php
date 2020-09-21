<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 */
?>

    <?php
    $options = get_fields('options');
    ?>
    <footer class="site-footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <?php if ( $options['community_logo_black'] ): ?>
                            <a class="footer-logo" href="<?php echo esc_url( home_url( '/' )); ?>">
                                <img src="<?php echo esc_url( $options['community_logo_black'] ); ?>" alt="<?php echo esc_attr( $options['community_name'] ); ?>">
                            </a>
                        <?php else: ?>
                            <a class="footer-logo secondary-color" href="<?php echo esc_url( home_url( '/' )); ?>">North & Line</a>
                        <?php endif; ?>
                        <div class="widget-content">
                            <?php if ( $options['community_address'] ): ?>
                            <p class="community-info"><span class="secondary-color">Address : </span><?php echo $options['community_address']; ?></p>
                            <?php endif; ?>
                            <?php if ( $options['email'] ): ?>
                            <p class="community-info"><span class="secondary-color">Email : </span><?php echo $options['email']; ?></p>
                            <?php endif; ?>
                            <?php if ( $options['phone_number'] ): ?>
                            <p class="community-info"><span class="secondary-color">Phone : </span><?php echo $options['phone_number']; ?></p>
                            <?php endif; ?>
                        </div>                        
                    </div>
                    <div class="col-lg-4">
                        <h4 class="widget-title secondary-color">Office Hours</h4>
                        <div class="widget-content">
                            <?php if ( $options['office_hours'] ): ?>
                            <ul class="office-hours">
                                <?php foreach ( $options['office_hours'] as $item ) { ?>
                                    <li>
                                        <span class="day secondary-color"><?php echo $item['day']; ?>:</span>
                                        <span class="hours"><?php echo $item['hours']; ?></span>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h4 class="widget-title secondary-color">Follow Us On Social Media</h4>
                        <div class="widget-content">
                            <ul class="social-links">
                                <?php if ( $options['community_facebook'] ): ?>
                                <li><a class="secondary-color" href="https://www.facebook.com/parcatwesleychapel/"><i class="fab fa-facebook-f"></i></a></li>
                                <?php endif; ?>                                
                                <?php if ( $options['community_twitter'] ): ?>
                                <li><a class="secondary-color" href=""><i class="fab fa-twitter"></i></a></li>
                                <?php endif; ?>                                
                                <?php if ( $options['community_instagram'] ): ?>
                                <li><a class="secondary-color" href=""><i class="fab fa-instagram"></i></a></li>
                                <?php endif; ?>
                                <?php if ( $options['community_youtube'] ): ?>
                                <li><a class="secondary-color" href=""><i class="fab fa-youtube"></i></a></li>
                                <?php endif; ?>
                            </ul>                            
                            <div class="footer-links secondary-color">
                                <a class="secondary-color" href="<?php echo esc_url( $options['privacy_policy_page_link'] ); ?>">Privacy Policy</a> | <a class="secondary-color" href="<?php echo esc_url( $options['terms_of_service_page_link'] ); ?>">Terms of Service</a>
                            </div>

                            <ul class="footer-logos">
                                <li><a href="#"><i class="fas fa-hand-holding-heart secondary-color"></i></a></li>
                                <li><a href="#"><i class="fas fa-wheelchair secondary-color"></i></a></li>
                                <li><a href="#"><i class="fas fa-home secondary-color"></i></a></li>
                            </ul>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright">
                            <?php if ( $options['copyright_text'] ):
                                echo $options['copyright_text'];
                            endif; ?>
                        </div>
                    </div>
                </div>            
            </div>
        </div><!-- .footer-top -->
    </footer><!-- .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

<?php
if ( $options['footer_code'] ):
    echo htmlspecialchars_decode( $options['footer_code'] );
endif;
?>

</body>
</html>