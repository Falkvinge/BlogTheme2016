<?php
/* Custom Fields */
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', esc_attr__( 'Page Settings', 'wise-blog') )
	->show_on_post_type('page')
	->add_fields(array(
		Field::make( 'checkbox', 'wise_disads_post', esc_attr__( 'Disable AD', 'wise-blog' ) )
			->set_option_value('yes'),
		Field::make( 'checkbox', 'wise_page_feat', esc_attr__( 'Enable Featured Image', 'wise-blog' ) )
			->set_option_value('yes'),
		Field::make( 'checkbox', 'wise_page_share', esc_attr__( 'Enable Share Buttons', 'wise-blog' ) )
			->set_option_value('yes'),
		Field::make('sidebar', 'wise_custom_sidebar', esc_attr__( 'Select Right Sidebar', 'wise-blog' ) )
			->set_default_value('sidebar-1'),
		Field::make('sidebar', 'wise_customleft_sidebar', esc_attr__( 'Select Left Sidebar', 'wise-blog' ) )
			->set_default_value('sidebar-2'),
			Field::make('radio', 'wise_page_title_align', esc_attr__( 'Title Alignment', 'wise-blog' ) )
			->add_options(array(
				'left' => esc_attr__( 'Left', 'wise-blog' ),
				'center' => esc_attr__( 'Center', 'wise-blog' ),
				'right' => esc_attr__( 'Right', 'wise-blog' ),
			))->set_default_value('left'),
	));