<?php
use Carbon_Fields\Widget;
use Carbon_Fields\Field;

/* Home Slider */
class HomeSlider extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
		global $wp_cats;
        $this->setup('#Home - Featured Contents', 'Displays home slider in grid and carousel format.', array(
			Field::make('text', 'wise_featured_id', 'Posts ID (separate by comma: 1, 2, 3; leave blank to automate)'),
			Field::make("select", "wise_featured_type", "Block Type")
				->add_options(array(
					'grid' => 'Grid Type',
					'carousel' => 'Carousel Type',
				)),
			Field::make("select", "wise_slider_categ", "Post Categories")
				->add_options($wp_cats),
            Field::make('number', 'wise_featured_number', 'No. of Featured Posts')->set_default_value('3')
			
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		global $wise_feat_num, $wise_slider_categ, $wise_feat_id;
        $wise_feat_type = $instance['wise_featured_type'];
		$wise_feat_num = $instance['wise_featured_number'];
		$wise_slider_categ = $instance['wise_slider_categ'];
		$wise_feat_id = $instance['wise_featured_id'];
		function wise_feat_id() {
			global $wise_feat_id;
			return '104, 146';
		}
		get_template_part( 'templates/custom_templates/content', 'featured-' . $wise_feat_type );
    }
}

/* Home Defaults Block */
class HomeDefaults extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
		global $wp_cats;
        $this->setup('#Home - Defaults Block', 'Displays latest posts.', array(
			Field::make('text', 'wise_lpost_title', 'Latest Posts Title')->set_default_value('Latest Posts'),
			Field::make("select", "wise_title_type", "Title Design")
				->add_options(array(
					'light' => 'Light',
					'back' => 'Background',
				)),
			Field::make("select", "wise_post_layout", "Post Layout")
				->add_options(array(
					'defaults' => 'Default Block',
					'grid' => 'Grid Block',
				)),
			Field::make("select", "wise_post_categ", "Post Categories")
				->add_options($wp_cats),
			Field::make('number', 'wise_lpost_number', 'No. of Posts')->set_default_value('0'),
			Field::make("radio", "wise_lpost_pagination", "Pagination")
				->add_options(array(
					'notpaginated' => 'Not Paginated',
					'paginate' => 'Paginated',
				))->set_default_value('paginate'),
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		global $wise_post_layout, $wise_lpost_number, $wise_lpost_pagination, $wise_post_categ;
        $wise_lpost_title = $instance['wise_lpost_title'];
		$wise_title_type = $instance['wise_title_type'];
		$wise_post_layout = $instance['wise_post_layout'];
		$wise_post_categ = $instance['wise_post_categ'];
		$wise_lpost_number = $instance['wise_lpost_number'];
		$wise_lpost_pagination = $instance['wise_lpost_pagination'];
		
		$cat_id = get_cat_ID( $wise_post_categ );
		$cat_url = get_category_link( $cat_id );
		
		if( $wise_title_type == 'light' ) {
			if( $wise_post_categ == true ) {
				echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title-archive">' . esc_html($wise_lpost_title) . '</h2></a></header></div>';
			} else {
				echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_lpost_title) . '</h2></header>';
			}
		} else {
			if( $wise_post_categ == true ) {
				echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title">' . esc_html($wise_lpost_title) . '</h2></a></header></div>';
			} else {
				echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_lpost_title) . '</h2></header>';
			}
		}
        get_template_part( 'templates/content', 'defaults' );
    }
}

/* Home Complex 1 Block */
class HomeComplex1 extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
		global $wp_cats;
        $this->setup('#Home - Complex 1 Block', 'Displays complex 1 posts block.', array(
			Field::make('text', 'wise_c1post_title', 'Posts Title')->set_default_value('Complex 1 Title'),
			Field::make("select", "wise_c1title_type", "Title Design")
				->add_options(array(
					'back' => 'Background',
					'light' => 'Light',
				)),
			Field::make("select", "wise_c1post_categ", "Post Categories")
				->add_options($wp_cats),
			Field::make('number', 'wise_c1post_number', 'No. of Posts')->set_default_value('5'),
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		global $wise_c1post_number, $wise_c1post_categ;
        $wise_c1post_title = $instance['wise_c1post_title'];
		$wise_c1title_type = $instance['wise_c1title_type'];
		$wise_c1post_categ = $instance['wise_c1post_categ'];
		$wise_c1post_number = $instance['wise_c1post_number'];
		
		$cat_id = get_cat_ID( $wise_c1post_categ );
		$cat_url = get_category_link( $cat_id );
		
		if( !is_paged() ) : // Avoids pagination
		?><div class="complex-design"><?php
		if( $wise_c1title_type == 'light' ) {
			if( $wise_c1post_categ == true ) {
				echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title-archive">' . esc_html($wise_c1post_title) . '</h2></a></header></div>';
			} else {
				echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_c1post_title) . '</h2></header>';
			}
		} else {
			if( $wise_c1post_categ == true ) {
				echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title">' . esc_html($wise_c1post_title) . '</h2></a></header></div>';
			} else {
				echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_c1post_title) . '</h2></header>';
			}
		}
			get_template_part( 'templates/custom_templates/content', 'complex-1' ); ?>
		</div><?php endif;
    }
}

/* Home Complex 2 Block */
class HomeComplex2 extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
		global $wp_cats;
        $this->setup('#Home - Complex 2 Block', 'Displays complex 2 posts block.', array(
			// Complex 2-1
			Field::make("separator", "wise_comp_21", "Complex 2-1"),
			Field::make('text', 'wise_c21post_title', 'Posts Title')->set_default_value('Complex 2-1 Title'),
			Field::make("select", "wise_c21title_type", "Title Design")
				->add_options(array(
					'back' => 'Background',
					'light' => 'Light',
				)),
			Field::make("select", "wise_c21post_categ", "Post Categories")
				->add_options($wp_cats),
			Field::make('number', 'wise_c21post_number', 'No. of Posts')->set_default_value('5'),

			// Complex 2-2
			Field::make("separator", "wise_comp_22", "Complex 2-2"),
			Field::make('text', 'wise_c22post_title', 'Posts Title')->set_default_value('Complex 2-2 Title'),
			Field::make("select", "wise_c22title_type", "Title Design")
				->add_options(array(
					'back' => 'Background',
					'light' => 'Light',
				)),
			Field::make("select", "wise_c22post_categ", "Post Categories")
				->add_options($wp_cats),
			Field::make('number', 'wise_c22post_number', 'No. of Posts')->set_default_value('5'),
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		// Complex 2-1
		global $wise_c21post_number, $wise_c21post_categ;
        $wise_c21post_title = $instance['wise_c21post_title'];
		$wise_c21title_type = $instance['wise_c21title_type'];
		$wise_c21post_categ = $instance['wise_c21post_categ'];
		$wise_c21post_number = $instance['wise_c21post_number'];
		
		$cat_id1 = get_cat_ID( $wise_c21post_categ );
		$cat_url1 = get_category_link( $cat_id1 );
		
		if( !is_paged() ) : // Avoids pagination
		?><div class="complex-design"><div class="complex-design comp-1"><?php
		if( $wise_c21title_type == 'light' ) {
			if( $wise_c21post_categ == true ) {
				echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url1) . '"><h2 class="page-title-archive">' . esc_html($wise_c21post_title) . '</h2></a></header></div>';
			} else {
				echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_c21post_title) . '</h2></header>';
			}
		} else {
			if( $wise_c21post_categ == true ) {
				echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url1) . '"><h2 class="page-title">' . esc_html($wise_c21post_title) . '</h2></a></header></div>';
			} else {
				echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_c21post_title) . '</h2></header>';
			}
		}
			get_template_part( 'templates/custom_templates/content', 'complex-2-1' ); ?>
		</div><?php endif;
		
		// Complex 2-2
		global $wise_c22post_number, $wise_c22post_categ;
        $wise_c22post_title = $instance['wise_c22post_title'];
		$wise_c22title_type = $instance['wise_c22title_type'];
		$wise_c22post_categ = $instance['wise_c22post_categ'];
		$wise_c22post_number = $instance['wise_c22post_number'];
		
		$cat_id2 = get_cat_ID( $wise_c22post_categ );
		$cat_url2 = get_category_link( $cat_id2 );
		
		if( !is_paged() ) : // Avoids pagination
		?><div class="complex-design comp-2"><?php
		if( $wise_c22title_type == 'light' ) {
			if( $wise_c22post_categ == true ) {
				echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url2) . '"><h2 class="page-title-archive">' . esc_html($wise_c22post_title) . '</h2></a></header></div>';
			} else {
				echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_c22post_title) . '</h2></header>';
			}
		} else {
			if( $wise_c22post_categ == true ) {
				echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url2) . '"><h2 class="page-title">' . esc_html($wise_c22post_title) . '</h2></a></header></div>';
			} else {
				echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_c22post_title) . '</h2></header>';
			}
		}
			get_template_part( 'templates/custom_templates/content', 'complex-2-2' ); ?>
		</div></div><?php endif;
    }
}

/* Home Complex 3 Block */
class HomeComplex3 extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
		global $wp_cats;
        $this->setup('#Home - Complex 3 Block', 'Displays complex 3 posts block.', array(
			Field::make('text', 'wise_c3post_title', 'Posts Title')->set_default_value('Complex 3 Title'),
			Field::make("select", "wise_c3title_type", "Title Design")
				->add_options(array(
					'back' => 'Background',
					'light' => 'Light',
				)),
			Field::make("select", "wise_c3post_categ", "Post Categories")
				->add_options($wp_cats),
			Field::make('number', 'wise_c3post_number', 'No. of Posts')->set_default_value('5'),
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		global $wise_c3post_number, $wise_c3post_categ;
        $wise_c3post_title = $instance['wise_c3post_title'];
		$wise_c3title_type = $instance['wise_c3title_type'];
		$wise_c3post_categ = $instance['wise_c3post_categ'];
		$wise_c3post_number = $instance['wise_c3post_number'];
		
		$cat_id = get_cat_ID( $wise_c3post_categ );
		$cat_url = get_category_link( $cat_id );
		
		if( !is_paged() ) : // Avoids pagination
		?><div class="complex-design"><?php
		if( $wise_c3title_type == 'light' ) {
			if( $wise_c3post_categ == true ) {
				echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title-archive">' . esc_html($wise_c3post_title) . '</h2></a></header></div>';
			} else {
				echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_c3post_title) . '</h2></header>';
			}
		} else {
			if( $wise_c3post_categ == true ) {
				echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title">' . esc_html($wise_c3post_title) . '</h2></a></header></div>';
			} else {
				echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_c3post_title) . '</h2></header>';
			}
		}
			get_template_part( 'templates/custom_templates/content', 'complex-3' ); ?>
		</div><?php endif;
    }
}

/* Home Complex 4 Block */
class HomeComplex4 extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
		global $wp_cats;
        $this->setup('#Home - Complex 4 Block', 'Displays complex 4 posts block.', array(
			Field::make('text', 'wise_c4post_title', 'Posts Title')->set_default_value('Complex 4 Title'),
			Field::make("select", "wise_c4title_type", "Title Design")
				->add_options(array(
					'back' => 'Background',
					'light' => 'Light',
				)),
			Field::make("select", "wise_c4post_categ", "Post Categories")
				->add_options($wp_cats),
			Field::make('number', 'wise_c4post_number', 'No. of Posts')->set_default_value('6'),
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		global $wise_c4post_number, $wise_c4post_categ;
        $wise_c4post_title = $instance['wise_c4post_title'];
		$wise_c4title_type = $instance['wise_c4title_type'];
		$wise_c4post_categ = $instance['wise_c4post_categ'];
		$wise_c4post_number = $instance['wise_c4post_number'];
		
		$cat_id = get_cat_ID( $wise_c4post_categ );
		$cat_url = get_category_link( $cat_id );
		
		if( !is_paged() ) : // Avoids pagination
		?><div class="complex-design"><?php
		if( $wise_c4title_type == 'light' ) {
			if( $wise_c4post_categ == true ) {
				echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title-archive">' . esc_html($wise_c4post_title) . '</h2></a></header></div>';
			} else {
				echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_c4post_title) . '</h2></header>';
			}
		} else {
			if( $wise_c4post_categ == true ) {
				echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title">' . esc_html($wise_c4post_title) . '</h2></a></header></div>';
			} else {
				echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_c4post_title) . '</h2></header>';
			}
		}
			get_template_part( 'templates/custom_templates/content', 'complex-4' ); ?>
		</div><?php endif;
    }
}

/* Register Widget */
register_widget('HomeSlider');
register_widget('HomeDefaults');
register_widget('HomeComplex1');
register_widget('HomeComplex2');
register_widget('HomeComplex3');
register_widget('HomeComplex4');
