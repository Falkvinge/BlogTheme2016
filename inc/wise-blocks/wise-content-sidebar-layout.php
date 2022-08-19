<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

/* Wise Content Sidebar Block */
global $wp_sidebar, $wise_contsideblock_name;
$wise_contsideblock_name = esc_attr__( 'Wise Content Sidebar Layout', 'wise-blog' );
Block::make( esc_attr( $wise_contsideblock_name ) )
	->add_fields( array(
		Field::make( 'separator', 'wise_contside_title', esc_attr__( 'WISE CONTENT SIDEBAR LAYOUT', 'wise-blog' ) ),
	))
	->set_inner_blocks( true )
	->set_inner_blocks_position( 'below' )
	->set_inner_blocks_template( array(
		array( 'core/paragraph' ),
		) )
	->set_description( esc_attr__( 'A parent block with layout content and right sidebar', 'wise-blog' ) )
	->set_mode( 'both' )
	->set_category( 'wise_blocks' )
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {

        global $wise_contsideblock_name;
        $wise_blocks_imgnotice = wp_kses_post( __('<div class="wise-contside-notice components-notice is-warning"><i><strong>Note:</strong> To enable editing mode inside this block, click the <i class="fa fa-eye-slash" aria-hidden="true"></i> icon (Hide preview mode) on the top toolbar.</i></div>', 'wise-blog') );

		if( !is_page_template('page-empty.php') && is_page() ) : return; endif; // Return if page template is not page-empty.php
?>
		<div id="primary" class="content-area">
            <?php if( is_page_template('page-empty.php') && is_page() ) : get_sidebar('pageleft'); endif; ?>
			<main id="main" class="site-main">
                <?php if( !is_page() ) : echo '<h3 class="wise-contsidebar-name">' . esc_html($wise_contsideblock_name) . '</h3>'; endif; ?>
                <?php if( !is_page() ) : echo wp_kses_post($wise_blocks_imgnotice); endif; ?>
				<?php echo !empty($inner_blocks) ? $inner_blocks : null; ?>
			</main><!-- End of #main -->
        </div><!-- End of #primary -->
		<?php if( is_page_template('page-empty.php') && is_page() ) : get_sidebar('page'); endif; ?>
<?php
	} ); // End set_render_callback