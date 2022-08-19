<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta charset="<?php esc_attr( bloginfo( 'charset' ) ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
<?php endif; ?>
<?php if ( have_posts() ) : while( have_posts() ) : the_post(); endwhile; endif; ?>
<?php wp_head(); ?>
<?php if( function_exists('wise_before_head') ) : wise_before_head(); endif; ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php if( function_exists('wise_after_body') ) : wise_after_body(); endif; ?>
<?php if( function_exists('wise_preloader') ) : wise_preloader(); endif; ?>
<?php // Customizer variables
    $wise_tag_lines_links = get_theme_mod('wise_tag_lines_links');
    $wise_tag_lines_title = get_theme_mod('wise_tag_lines_title');
    $wise_tag_lines_title_dis = get_theme_mod('wise_tag_lines_title_dis');
    $wise_tag_lines_span = get_theme_mod('wise_tag_lines_span');
    $wise_tag_lines_span_dis = get_theme_mod('wise_tag_lines_span_dis');
    $wise_tag_lines_target = get_theme_mod('wise_tag_lines_target');

    $wise_soc_rss_links = get_theme_mod('wise_soc_rss_links');
    $wise_soc_fb_links = get_theme_mod('wise_soc_fb_links');
    $wise_soc_twitter_links = get_theme_mod('wise_soc_twitter_links');
    $wise_soc_ins_links = get_theme_mod('wise_soc_ins_links');
    $wise_soc_yt_links = get_theme_mod('wise_soc_yt_links');
    $wise_soc_vim_links = get_theme_mod('wise_soc_vim_links');
    $wise_soc_in_links = get_theme_mod('wise_soc_in_links');
    $wise_soc_pin_links = get_theme_mod('wise_soc_pin_links');
    $wise_soc_vk_links = get_theme_mod('wise_soc_vk_links');

    $wise_headhesive = get_theme_mod('wise_headhesive');
    $wise_headhesive_logo = get_theme_mod('wise_headhesive_logo');
    $wise_disable_sticksocial = get_theme_mod('wise_disable_sticksocial');
    $wise_secondary_menu = get_theme_mod('wise_secondary_menu');
    $wise_top_header = get_theme_mod('wise_top_header');
    $wise_date_header = get_theme_mod( 'wise_date_header' );
    $wise_login = get_theme_mod('wise_login');
    $wise_header_logo = get_theme_mod('wise_header_logo');
    $wise_disable_headsocial = get_theme_mod('wise_disable_headsocial');
    $wise_head_shopcart_dis = get_theme_mod('wise_head_shopcart_dis');
?>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wise-blog' ); ?></a>
	<?php if ($wise_headhesive == false) { ?>
		<div class="headhesive">
			<div class="headhesive-box centre">
				<div class="headhesive-one">
                    <div class="headhesive-logo">
                        <a href="<?php echo esc_url( home_url('/') ); ?>">
                        <?php if ($wise_headhesive_logo) { ?>
                            <img src="<?php echo esc_url($wise_headhesive_logo); ?>" alt="<?php echo esc_attr( bloginfo('name') ); ?>">
                        <?php } else { ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/img/headhesive_img.png'); ?>" alt="<?php echo esc_attr( bloginfo('name') ); ?>">
                        <?php } ?>
                        </a>
					</div><!-- .headhesive-logo -->
					<div class="headhesive-menu"><?php wise_headhesive_menu(); ?></div>
					<?php if( function_exists('is_bbpress') && ( is_bbpress() || is_page_template('page-bbpress.php') || is_page_template('page-bbpress-topics.php') ) ) : null; ?>
					<?php elseif( function_exists('is_woocommerce') && is_woocommerce() ) : null; else : ?>	
						<div class="headhesive-tag-lines">
							<?php 	if( !empty($wise_tag_lines_links) ) {
										if($wise_tag_lines_target == '_blank') {
											echo '<a href="' . esc_url($wise_tag_lines_links) . '"' . ' target="_blank"' . '>';
										} else {
											echo '<a href="' . esc_url($wise_tag_lines_links) . '">';
										}									 
									} else { 
										null; 
									}
									if( $wise_tag_lines_title_dis == false ) : 
										if( !empty($wise_tag_lines_title) ) {
											echo esc_html($wise_tag_lines_title);
										} else {
											echo esc_html__( 'Get this theme?', 'wise-blog' );
										} 
									endif; ?></a>
						</div><!-- .headhesive-tag-lines -->
					<?php endif; ?>
				</div><!-- .headhesive-one -->		

				<?php if( ($wise_soc_rss_links || $wise_soc_fb_links || $wise_soc_twitter_links || $wise_soc_ins_links || $wise_soc_yt_links || $wise_soc_vim_links || $wise_soc_in_links || $wise_soc_pin_links || $wise_soc_vk_links) && ($wise_disable_sticksocial == false) ) { ?>
					<div class="headhesive-social"><a href="#share-top"><?php esc_html_e( 'Follow', 'wise-blog' ); ?></a></div>
				<?php }?>
					<div class="search-iconhead"><a href="#search-conthead"><i class="fa fa-search"></i></a></div>
					<div class="search-formhead" id="search-conthead"><?php get_search_form(); ?></div>
				<?php if( function_exists('wise_headhesive_social_menu') && ($wise_disable_sticksocial == false) ) : wise_headhesive_social_menu(); endif; ?>
			</div><!-- .headhesive-box -->
		</div><!-- .headhesive -->
	<?php } ?>
	
	<?php if ($wise_secondary_menu == false) { // Disable responsive secondary menu ?>
		<div class="res-nav-top-wrap">
            <div id="res-nav-top" class="response-nav wise-secondary-menu">
                <?php wise_responsive_secondary_menu(); ?>
            </div><!-- .response-nav -->
        </div><!-- .res-nav-top-wrap -->
	<?php } ?>
	
	<div class="header-wrapper">
		<?php if ($wise_top_header == false) : ?>
			<div class="header-login-wrapper">
				<div class="header-login">
					
					<?php if ($wise_secondary_menu == false) { // Disable responsive secondary menu ?>
						<div class="res-button-top"><a href="#res-nav-top"></a></div>
					<?php } ?>
					
					<?php if ( $wise_date_header == false ) { ?>
						<div class="header-date <?php if ( $wise_secondary_menu == false ) : echo 'border-right-1'; endif; ?>"><?php echo date_i18n( 'l, F j, Y'); ?></div>
					<?php } ?>
					
					<?php if ($wise_secondary_menu == false) { ?>
						<div class="secondary-menu"><?php wise_secondary_menu(); ?></div>
					<?php } ?>
					
                    <?php if( ( ($wise_login == false) && !is_user_logged_in() ) || ($wise_head_shopcart_dis == false) ) : ?>
                        <div class="login-top">						
                            <?php if( ($wise_login == false) && !is_user_logged_in() ) : ?>
                                <a class="lg-in" href="<?php echo esc_url( home_url('/') . 'wp-admin/'); ?>"><?php esc_html_e( 'Login', 'wise-blog' ); ?></a><a class="lg-reg" href="<?php echo esc_url( home_url('/') . 'wp-login.php?action=register'); ?>"><?php esc_html_e( 'Register', 'wise-blog' ); ?></a>
                            <?php endif; ?>

                            <?php if( function_exists('is_woocommerce') && ($wise_head_shopcart_dis == false) ) : wise_woo_icon(); endif; ?>
                        </div><!-- .login-top -->
                    <?php endif; ?>
					
				</div><!-- .header-login -->
			</div><!-- .header-login-wrapper -->
		<?php endif; ?>
		
			<header id="masthead" class="site-header">
				<div class="site-branding">
					<?php if( is_front_page() || is_home() ) { ?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url('/') ); ?>" rel="home">
						<?php if ($wise_header_logo) { ?>
							<img src="<?php echo esc_url($wise_header_logo); ?>" alt="<?php echo esc_attr(bloginfo('name')); ?>">
						<?php } else { ?>
							<img src="<?php echo esc_url( get_template_directory_uri() . '/img/header_img.png' ); ?>" alt="<?php echo esc_attr(bloginfo('name')); ?>">
						<?php } ?>
						</a>
					</h1>
					<?php } else { ?>
					<p class="site-title">
						<a href="<?php echo esc_url( home_url('/') ); ?>" rel="home">
						<?php if ($wise_header_logo) { ?>
							<img src="<?php echo esc_url($wise_header_logo); ?>" alt="<?php echo esc_attr(bloginfo('name')); ?>">
						<?php } else { ?>
							<img src="<?php echo esc_url( get_template_directory_uri() . '/img/header_img.png' ); ?>" alt="<?php echo esc_attr(bloginfo('name')); ?>">
						<?php } ?>
						</a>
					</p>
					<?php } ?>
				</div><!-- .site-branding -->
				<div class="block-1">
                    <?php if( $wise_tag_lines_title_dis == false ) : ?>
                        <div class="tag-lines">	
                            <?php 	if( !empty($wise_tag_lines_links) ) {
                                            if($wise_tag_lines_target == '_blank') {
                                                echo '<a href="' . esc_url($wise_tag_lines_links) . '"' . ' target="_blank"' . '>';
                                            } else {
                                                echo '<a href="' . esc_url($wise_tag_lines_links) . '">';
                                            }									 
                                        } else { 
                                            null; 
                                        }

                                        if( $wise_tag_lines_title_dis == false ) : 
                                            if( !empty($wise_tag_lines_title) ) {
                                                echo esc_html($wise_tag_lines_title);
                                            } else {
                                                echo esc_html__( 'Get this theme?', 'wise-blog' );
                                            } 
                                        endif;
                                        
                                        if( $wise_tag_lines_span_dis == false ) :
                                            if( !empty($wise_tag_lines_span) ) {
                                                echo '<span class="tag-span"> '. esc_html($wise_tag_lines_span) . '</span>';
                                            } else {
                                                echo '<span class="tag-span"> '. esc_html__( 'Buy Now.', 'wise-blog' ) . '</span>';
                                            }												
                                        endif; ?></a>					
                        </div><!-- .tag-lines -->
                    <?php endif; ?>
					<?php if( function_exists('wise_main_social_menu') && ($wise_disable_headsocial == false) ) : wise_main_social_menu(); endif; ?>
				</div><!-- .block-1 -->
				<div class="block-2">
					<div class="navigation-top">
						<div class="res-button"><a href="#res-nav"></a></div>
						<nav id="site-navigation" class="main-navigation"><?php wise_main_menu(); ?></nav>
					</div><!-- .navigation-top -->
					<div class="search-top"><a href="#search-cont"><i class='fa fa-search'></i></a></div>
				</div><!-- .block-2 -->
			</header><!-- .site-header -->
	</div>
		
	<div id="search-cont" class="search-form-wrapper centre">
		<div class="search-form-top centre">
			<?php get_search_form(); ?>
		</div><!-- .search-form-top -->	
	</div><!-- .search-form-wrapper -->
	
	<div class="res-nav-wrap">
        <div id="res-nav" class="response-nav wise-primary-menu">
            <?php wise_responsive_main_menu(); ?>
        </div><!-- .res-nav -->
    </div><!-- .res-nav-wrap -->
	
	<?php if( is_404() || is_search() ) { null; } else { get_sidebar('ads_top'); } ?>
						
	<div id="contents" class="site-content">