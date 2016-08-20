<?php
/*
* Wise About Widget
*
*/

// Create the widget
class text_alert_widget extends WP_Widget {

function __construct() {
$widget_ops = array( 'description' => esc_html__( 'Displays your text alert widget.', 'wise-blog'));
$control_ops = array('width' => 400, 'height' => 350);

parent::__construct( 'text_alert_widget', esc_html__( '#Wise Text Alert', 'wise-blog' ), $widget_ops, $control_ops);
}

// Frontend
public function widget( $args, $instance ) {
$text_alert = apply_filters( 'text_alert', @$instance['text_alert'] );

// Before and after the widget
echo $args['before_widget'];

// The Output	
echo '<div class="widget_text_alert">' . esc_attr($text_alert) . '</div>';

echo $args['after_widget'];
}
		
// Backend
public function form( $instance ) {

if ( isset( $instance[ 'text_alert' ] ) ) {
	$text_alert = $instance[ 'text_alert' ];
}
else {
	$text_alert = null;
}

// Backend Admin Form
?>

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'text_alert' )); ?>"><?php esc_html_e( 'Content:', 'wise-blog' ); ?></label>
	<textarea class="widefat" rows="12" cols="20" id="<?php echo esc_attr($this->get_field_id('text_alert')); ?>" name="<?php echo esc_attr($this->get_field_name('text_alert')); ?>"><?php echo esc_textarea($text_alert); ?></textarea>
</p>

<?php 
}
	
// New Instances
public function update( $new_instance, $old_instance ) {
$instance = array();
if ( current_user_can('unfiltered_html') )
	$instance['text_alert'] =  $new_instance['text_alert'];
else
	$instance['text_alert'] = stripslashes( wp_filter_post_kses( $new_instance['text_alert'] ) );
$instance['filter'] = isset($new_instance['filter']);
return $instance;
}
}

// Register and load widget
function text_alert_load_widget() {
	register_widget( 'text_alert_widget' );
}
add_action( 'widgets_init', 'text_alert_load_widget' );