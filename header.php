<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php if ( have_posts() ) : while( have_posts() ) : the_post(); endwhile; endif; ?>
<?php if ( !function_exists( 'has_site_icon' ) || !has_site_icon() ) : /* Backwards compatible site icon < 4.3 */
	if( get_option( 'wise_favicon' ) ) {
		echo '<link rel="shortcut icon" href="' . get_option( 'wise_favicon' ) . '">';
	} else {
		echo '<link rel="shortcut icon" href="' . esc_url( get_template_directory_uri() . '/img/favicon.ico') . '">'; }	
	endif;
?>
<?php wise_code_before_head(); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wise_code_after_body(); ?>
<?php wise_preloader(); ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wise-blog' ); ?></a>
	<?php if (get_option('wise_headhesive') == false) { ?>
		<div class="headhesive">
			<div class="headhesive-box centre">
				<div class="headhesive-one">
					<a href="<?php echo esc_url( home_url('/') ); ?>">
					<?php if (get_option('wise_headhesive_logo')) { ?>
						<img src="<?php echo esc_url(get_option('wise_headhesive_logo')); ?>" alt="<?php echo bloginfo('name'); ?>">
					<?php } else { ?>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/img/headhesive_img.png'); ?>" alt="<?php echo bloginfo('name'); ?>">
					<?php } ?>
					</a>
					
					<div class="headhesive-menu"><?php wise_headhesive_menu(); ?></div>
					<?php if( function_exists('is_bbpress') && ( is_bbpress() || is_page_template('page-bbpress.php') || is_page_template('page-bbpress-topics.php') ) ) : echo null; ?>
					<?php elseif( function_exists('is_woocommerce') && is_woocommerce() ) : echo null; else : ?>	
						<div class="headhesive-tag-lines"><a href="<?php echo esc_url(get_option('wise_tag_lines_links')); ?>"><?php echo esc_html(get_option('wise_tag_lines_title')); ?></a></div>
					<?php endif; ?>
				</div>			
				
				<?php if(get_option('wise_soc_rss_links') || get_option('wise_soc_fb_links') || get_option('wise_soc_twitter_links') || get_option('wise_soc_gplus_links') || get_option('wise_soc_yt_links')) { ?>
					<div class="headhesive-social"><a href="#share-top"><?php esc_html_e( 'Follow', 'wise-blog' ); ?><i class="fa fa-caret-down"></i></a></div>
				<?php }?>
					<div class="search-iconhead"><a href="#search-conthead"><i class="fa fa-search"></i></a></div>
					<div class="search-formhead" id="search-conthead"><?php get_search_form(); ?></div>
				<?php wise_headhesive_social_menu(); ?>
			</div>
		</div><!-- End Headhesive -->
	<?php } ?>
	
	<?php if (get_option('wise_secondary_menu') == false) { // Disable responsive secondary menu ?>
		<div id="res-nav-top" class="response-nav"><?php wise_responsive_secondary_menu(); ?></div><!-- End Responsive Navigation Top -->
	<?php } ?>
	
	<div class="header-wrapper">
		<?php if (get_option('wise_top_header') == false) : ?>
			<div class="header-login-wrapper">
				<div class="header-login">
					
					<?php if (get_option('wise_secondary_menu') == false) { // Disable responsive secondary menu ?>
						<div class="res-button-top"><a href="#res-nav-top"></a></div>
					<?php } ?>
					
					<?php if ( get_option( 'wise_date_header' ) == false ) { ?>
						<div class="header-date <?php if ( get_option( 'wise_secondary_menu' ) == false ) : echo 'border-right-1'; endif; ?>"><?php echo current_time( 'l, F j, Y'); ?></div>
					<?php } ?>
					
					<?php if (get_option('wise_secondary_menu') == false) { ?>
						<div class="secondary-menu"><?php wise_secondary_menu(); ?></div>
					<?php } ?>
					
					<div class="login-top">
						<?php if (get_option('wise_login') == false) : ?>
							<?php if (is_user_logged_in()) { ?>
								<a class="lg-dash" href="<?php echo esc_url( home_url('/') . 'wp-admin/'); ?>"><?php esc_html_e( 'Dashboard', 'wise-blog' ); ?></a><a class="lg-out" href="<?php echo wp_logout_url( home_url('/') ); ?>"><?php esc_html_e( 'Logout', 'wise-blog' ); ?></a>
							<?php } else { ?>
								<a class="lg-in" href="<?php echo esc_url( home_url('/') . 'wp-admin/'); ?>"><?php esc_html_e( 'Login', 'wise-blog' ); ?></a><a class="lg-reg" href="<?php echo esc_url( home_url('/') . 'wp-login.php?action=register'); ?>"><?php esc_attr_e( 'Register', 'wise-blog' ); ?></a>
							<?php } ?>
						<?php endif; ?>
					</div>
					
				</div>
			</div>
		<?php endif; ?>
		
			<header id="masthead" class="site-header">
				<div class="site-branding">
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url('/') ); ?>" rel="home">
						<?php if (get_option('wise_header_logo')) { ?>
							<img src="<?php echo esc_url(get_option('wise_header_logo')); ?>" alt="<?php echo bloginfo('name'); ?>">
						<?php } else { ?>
							<img src="<?php echo esc_url( get_template_directory_uri() . '/img/header_img.png' ); ?>" alt="<?php echo bloginfo('name'); ?>">
						<?php } ?>
						</a>
					</h1>
				</div><!-- End Site Branding -->
				<div class="block-1">
					<!-- Custom Header Tag Lines -->
					<div class='tag-lines'>
						<?php if (get_option('wise_tag_lines_title') || get_option('wise_tag_lines_span')) { ?>
							<a href='<?php echo esc_url(get_option('wise_tag_lines_links')); ?>'><?php echo esc_html(get_option('wise_tag_lines_title')); ?><span class='tag-span'> <?php echo esc_html(get_option('wise_tag_lines_span')); ?></span></a>
						<?php } else { echo bloginfo('description'); } ?>
					</div>
					<?php wise_main_social_menu(); ?>
				</div><!-- End Block-1 -->
				<div class="block-2">
					<div class="navigation-top">
						<div class="res-button"><a href="#res-nav"></a></div>
						<nav id="site-navigation" class="main-navigation"><?php wise_main_menu(); ?></nav><!-- End Site Navigation -->
					</div>
					<div class="search-top"><a href="#search-cont"><i class='fa fa-search'></i></a></div>
				</div><!-- End Block-2 -->
			</header><!-- End Header -->
	</div>
		
	<div id="search-cont" class="search-form-wrapper centre">
		<div class="search-form-top centre">
			<?php get_search_form(); ?>
		</div>				
	</div><!-- End Search Form -->
	
	<div id="res-nav" class="response-nav"><?php wise_responsive_main_menu(); ?></div><!-- End Responsive Navigation -->
	
	<?php if( is_404() || is_search() ) { null; } else { get_sidebar('ads_top'); } ?>
						
	<div id="contents" class="site-content">