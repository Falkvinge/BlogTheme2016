<?php
/*
* Wise Social Media Footer Widgets
*
*/

// Create the widget
class follow_widget extends WP_Widget {

function __construct() {
$widget_ops = array( 'description' => esc_html__( 'Displays your social media footer widget.', 'wise-blog'));
$control_ops = array('width' => 400, 'height' => 350);

parent::__construct( 'follow_widget', esc_html__( '#Wise Social Media Footer', 'wise-blog' ), $widget_ops, $control_ops);
}

// Frontend
public function widget( $args, $instance ) {

// Before and after the widget
echo wp_kses_post($args['before_widget']);

// The Output
wise_footer_social_menu();

echo wp_kses_post($args['after_widget']);
}
		
// Backend
public function form( $instance ) {

// Backend Admin Form
?>
<p>
<label><?php echo esc_html__('This is a widget to display social media for footer.', 'wise-blog'); ?></label>
</p>
<?php 
}
	
// New Instances
public function update( $new_instance, $old_instance ) {
$instance = array();
return $instance;
}
}

// Register and load the widget
function follow_load_widget() {
	register_widget( 'follow_widget' );
}
add_action( 'widgets_init', 'follow_load_widget' );