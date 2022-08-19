<?php
/*
* Template to Display Footer
*
*/
?>
<?php if( is_404() || is_search() ) { null; } else { get_sidebar('ads_bottom'); } ?>
<?php global $wise_allowed_html; $wise_footer_text = get_theme_mod('wise_footer_text'); $wise_footer_text_dis = get_theme_mod('wise_footer_text_dis'); ?>
<?php $wise_current_year = date('Y'); ?>
</div><!-- End of #content -->
	<div class="footer-wrapper-outer">
		<div class="footer-wrapper clear">
			<?php if ( get_theme_mod( 'wise_footer_style' ) == '' ) : ?>
				<div class="footer-side">
					<?php get_sidebar('footer'); ?>
				</div>
			<?php endif; ?>		
				<footer id="colophon" class="site-footer">
				
					<?php if ( get_theme_mod( 'wise_footer_style' ) == 'single' ) : ?>
						<div class="footer-simple">
							<?php if( function_exists('wise_footer_social_menu') && get_theme_mod('wise_disable_footericons') ==  false ) : wise_footer_social_menu(); endif; // disable footer social icons ?>							
							<?php if( function_exists('wise_footer_single_menu') && get_theme_mod('wise_disable_footermenu') == false ) : // disable footer menus ?>
								<div class="footer-menus">
									<?php wise_footer_single_menu(); ?>
								</div>
							<?php endif; ?>
							<div class="footer-text">
								<?php
									if( $wise_footer_text_dis == false ) :
										if( !empty($wise_footer_text) ) {
											echo wp_kses( $wise_footer_text, $wise_allowed_html );
										} else {
											printf( esc_html__( 'Copyright &copy; %d. All rights reserved.', 'wise-blog' ), $wise_current_year );
										}
									endif; wise_panel_fields_footer(); ?>
							</div>						
						</div><!-- End of .footer-simple -->
					<?php endif; ?>
					
					<?php if ( get_theme_mod( 'wise_footer_style' ) == '' ) : ?>
						<div class="site-info">
						<?php if (get_theme_mod('wise_footer_logo') == false) : ?>
							<div class="img-footer">
							<a href="<?php echo esc_url( home_url('/') ); ?>">
							<?php if (get_theme_mod('wise_footer_logo_url')) { ?>
								<img src="<?php echo esc_url(get_theme_mod('wise_footer_logo_url')); ?>" alt="<?php echo esc_attr( bloginfo('name') ); ?>">
							<?php } else { ?>
								<img src="<?php echo esc_url( get_template_directory_uri() . '/img/footer_img.png'); ?>" alt="<?php echo esc_attr( bloginfo('name') ); ?>">
							<?php } ?>
							</a>
							</div>
						<?php endif; ?>
							<div class="text-footer">
								<?php
									if( $wise_footer_text_dis == false ) :
										if( !empty($wise_footer_text) ) {
											echo wp_kses( $wise_footer_text, $wise_allowed_html );
										} else {
											printf( esc_html__( 'Copyright &copy; %d. All rights reserved.', 'wise-blog' ), $wise_current_year );
										}
									endif; wise_panel_fields_footer(); ?>
							</div>
						</div><!-- End of .site-info -->
					<?php endif; ?>
				
				</footer><!-- End of #colophon -->
		</div><!-- End of .footer wrapper --><div class="clear"></div>
	</div><!-- End of .footer-wrapper-outer -->

	<span class="cd-top"><img src="<?php echo esc_url(get_template_directory_uri() . '/img/arrowtop.png'); ?>" alt="<?php echo esc_attr__( 'Back to top', 'wise-blog' ); ?>"></span>
</div><!-- End of .#page -->
<?php wp_footer(); ?>
<?php if( function_exists('wise_before_body') ) : wise_before_body(); endif; ?>
</body>
</html>
