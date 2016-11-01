<?php
/*
* Wise Subscribe Footer Widgets
*
*/

// Create the widget
class subsfooter_widget extends WP_Widget {

function __construct() {
$widget_ops = array( 'description' => esc_html__( 'Displays your subscribe footer widget.', 'wise-blog'));
$control_ops = array('width' => 400, 'height' => 350);

parent::__construct( 'subsfooter_widget', esc_html__( '#Wise Subscribe Footer', 'wise-blog' ), $widget_ops, $control_ops);
}

// Frontend
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', @$instance['title'] );
$subsfooter_url = apply_filters( 'widget_title', @$instance['subsfooter_url'] );

// Before and after the widget
echo wp_kses_post($args['before_widget']);
if ( ! empty( $title ) )
echo wp_kses_post($args['before_title']) . esc_html($title) . wp_kses_post($args['after_title']);

// The Output
echo '<form class="subscribe-footer" action="' . esc_url($subsfooter_url) . '" method="post" id="mc-embedded-subscribe-form-footer" name="mc-embedded-subscribe-form" target="_blank" novalidate>';
echo '<input type="email" value="" name="EMAIL"  id="mce-EMAIL-footer" placeholder="' . esc_attr__('Enter Email Address', 'wise-blog') . '">';
echo '<button type="submit" class="newsletter-submit" value="' . esc_attr('Subscribe','wise-blog') . '" name="subscribe" id="mc-embedded-subscribe-footer">' . esc_html('Subscribe','wise-blog') . '</button></form>';

echo wp_kses_post($args['after_widget']);
}
		
// Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}
else {
	$title = esc_html__( 'Subscribe to our Newsletter', 'wise-blog' );
}

if ( isset( $instance[ 'subsfooter_url' ] ) ) {
	$subsfooter_url = $instance[ 'subsfooter_url' ];
}
else {
	$subsfooter_url = null;
}

// Backend Admin Form
?>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'subsfooter_url' )); ?>"><?php esc_html_e( 'Subscribe URL:', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'subsfooter_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'subsfooter_url' )); ?>" type="text" value="<?php echo esc_url( $subsfooter_url ); ?>">
</p>

<?php 
}
	
// New Instances
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['subsfooter_url'] = ( ! empty( $new_instance['subsfooter_url'] ) ) ? strip_tags( $new_instance['subsfooter_url'] ) : '';
return $instance;
}
}

// Register and load the widget
function subsfooter_load_widget() {
	register_widget( 'subsfooter_widget' );
}
add_action( 'widgets_init', 'subsfooter_load_widget' );