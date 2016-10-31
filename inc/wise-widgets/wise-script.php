<?php
/*
* Wise Script
*
*/

// Create the widget
class w_script_widget extends WP_Widget {

function __construct() {
$widget_ops = array( 'description' => esc_html__( 'Let you to add script to your sidebar.', 'wise-blog'));
$control_ops = array('width' => 400, 'height' => 350);

parent::__construct( 'w_script_widget', esc_html__( '#Wise Script', 'wise-blog' ), $widget_ops, $control_ops);
}

// Frontend
public function widget( $args, $instance ) {
global $w_script;
$title = apply_filters( 'widget_title', @$instance['title'] );
$w_script = apply_filters( 'w_script', @$instance['w_script'] );

// Before and after the widget
echo wp_kses_post($args['before_widget']);
if ( ! empty( $title ) )
echo wp_kses_post($args['before_title']) . esc_html($title) . wp_kses_post($args['after_title']);

// The Output
echo wise_script_widget();

echo wp_kses_post($args['after_widget']);
}
		
// Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}
else {
	$title = null;
}

if ( isset( $instance[ 'w_script' ] ) ) {
	$w_script = $instance[ 'w_script' ];
}
else {
	$w_script = null;
}

// Backend Admin Form
?>
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'wise-blog' ); ?></label> 
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'w_script' )); ?>"><?php esc_html_e( 'Enter your custom script here:', 'wise-blog' ); ?></label>
	<textarea class="widefat" rows="12" cols="20" id="<?php echo esc_attr($this->get_field_id('w_script')); ?>" name="<?php echo esc_attr($this->get_field_name('w_script')); ?>"><?php echo esc_textarea($w_script); ?></textarea>
</p>

<?php 
}
	
// New Instances
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
if ( current_user_can('unfiltered_html') )
	$instance['w_script'] =  $new_instance['w_script'];
else
	$instance['w_script'] = stripslashes( wp_filter_post_kses( $new_instance['w_script'] ) );
$instance['filter'] = isset($new_instance['filter']);
return $instance;
}
}

function wise_script_widget() {
	global $w_script;
	return $w_script;
}

// Register and load widget
function w_script_load_widget() {
	register_widget( 'w_script_widget' );
}
add_action( 'widgets_init', 'w_script_load_widget' );