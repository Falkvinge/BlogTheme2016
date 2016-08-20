<?php
/*
* Template to Display Footer
*
*/
?>
<?php if( is_404() || is_search() ) { null; } else { get_sidebar('ads_bottom'); } ?>
<?php global $wise_allowed_html; ?>
</div><!-- End of #content -->
	<div class="footer-wrapper-outer">
		<div class="footer-wrapper clear">
			<?php if ( get_option( 'wise_footer_style' ) == 'widgetized' ) : ?>
				<div class="footer-side">
					<?php get_sidebar('footer'); ?>
				</div>
			<?php endif; ?>		
				<footer id="colophon" class="site-footer">
				
					<?php if ( get_option( 'wise_footer_style' ) == 'single' ) : ?>
						<div class="footer-simple">
							<?php if( get_option('wise_disable_footericons') ==  false ) : wise_footer_social_menu(); endif; // disable footer social icons ?>							
							<?php if( get_option('wise_disable_footermenu') == false ) : // disable footer menus ?>
								<div class="footer-menus">
									<?php wise_footer_single_menu(); ?>
								</div>
							<?php endif; ?>
							<div class="footer-text">
								<?php echo wp_kses(get_option('wise_footer_text'), $wise_allowed_html); ?><?php wise_panel_fields_footer(); ?>
							</div>							
						</div><!-- End of .footer-simple -->
					<?php endif; ?>
					
					<?php if ( get_option( 'wise_footer_style' ) == 'widgetized' ) : ?>
						<div class="site-info">
						<?php if (get_option('wise_footer_logo') == false) : ?>
							<div class="img-footer">
							<a href="<?php echo esc_url( home_url('/') ); ?>">
							<?php if (get_option('wise_footer_logo_url')) { ?>
								<img src="<?php echo esc_url(get_option('wise_footer_logo_url')); ?>" alt="<?php echo bloginfo('name'); ?>">
							<?php } else { ?>
								<img src="<?php echo esc_url( get_template_directory_uri() . '/img/footer_img.png'); ?>" alt="<?php echo bloginfo('name'); ?>">
							<?php } ?>
							</a>
							</div>
						<?php endif; ?>
							<div class="text-footer"><?php echo wp_kses(get_option('wise_footer_text'), $wise_allowed_html); ?><?php echo wise_panel_fields_footer(); ?></div>
						</div><!-- End of .site-info -->
					<?php endif; ?>
				
				</footer><!-- End of #colophon -->
		</div><!-- End of .footer wrapper -->
	</div><!-- End of .footer-wrapper-outer -->

	<a href="#0" class="cd-top"><img src="<?php echo esc_url(get_template_directory_uri() . '/img/arrowtop.png'); ?>" alt="arrow"></a>
</div><!-- End of .#page -->
<?php wp_footer(); ?>
<?php wise_code_before_body(); ?>
</body>
</html>
