<?php
/* Custom Fields */
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', esc_attr__( 'Additional Settings', 'wise-blog') )
	->show_on_post_type('post')
	->set_context('normal')
	->add_fields(array(
		Field::make( 'checkbox', 'wise_featured_post', esc_attr__( 'Set as Featured', 'wise-blog' ) )
			->set_option_value('yes'),
		Field::make( 'html', 'wise_featured_advisory' )
            ->set_html( '<i><strong>Note:</strong> Setting this as featured means adding it to Wise Featured Contents Block.</i>' ),
		Field::make( 'checkbox', 'wise_aff_post', esc_attr__( 'Enable Affiliates Disclaimer', 'wise-blog' ) )
			->set_option_value('yes'),
		Field::make( 'checkbox', 'wise_disads_post', esc_attr__( 'Disable AD', 'wise-blog' ) )
			->set_option_value('yes'),
	));