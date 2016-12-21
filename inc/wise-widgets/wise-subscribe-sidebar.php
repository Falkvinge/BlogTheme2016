<?php
/*
* Wise Subscribe Sidebar Widgets
*
*/

// Create the widget
class subs_widget extends WP_Widget {

function __construct() {
$widget_ops = array( 'description' => esc_html__( 'Displays your subscribe sidebar widget.', 'wise-blog'));
$control_ops = array('width' => 400, 'height' => 350);

parent::__construct( 'subs_widget', esc_html__( '#Wise Subscribe Sidebar', 'wise-blog' ), $widget_ops, $control_ops);
}

// Frontend
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', @$instance['title'] );
$subs_head = apply_filters( 'widget_subs_head', @$instance['subs_head'] );
$subs_url = apply_filters( 'widget_subs_url', @$instance['subs_url'] );

// Before and after the widget
echo wp_kses_post($args['before_widget']);
if ( ! empty( $title ) )
echo wp_kses_post($args['before_title']) . esc_html($title) . wp_kses_post($args['after_title']);

// The Output
echo '<div class="subscribe-box"><span>' . esc_html($subs_head) . '</span>';
echo '<form class="subscribe-sidebar" action="' . esc_url($subs_url) . '" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" novalidate>';
echo '<input type="email" value="" name="EMAIL"  id="mce-EMAIL" placeholder="' . esc_attr__('Enter Email Address', 'wise-blog') . '">';
echo '<button type="submit" class="newsletter-submit" value="' . esc_attr__('Subscribe','wise-blog') . '" name="subscribe" id="mc-embedded-subscribe">' . esc_html__('Subscribe','wise-blog') . '</button></form></div>';

echo wp_kses_post($args['after_widget']);
}
		
// Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}
else {
	$title = esc_html__( 'Subscribe to Wise Mag', 'wise-blog' );
}

if ( isset( $instance[ 'subs_head' ] ) ) {
	$subs_head = $instance[ 'subs_head' ];
}
else {
	$subs_head = esc_html__( 'Get updated from the latest posts straight to your mailbox!', 'wise-blog' );
}

if ( isset( $instance[ 'subs_url' ] ) ) {
	$subs_url = $instance[ 'subs_url' ];
}
else {
	$subs_url = null;
}

// Backend Admin Form
?>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'subs_head' )); ?>"><?php esc_html_e( 'Subscribe Header:', 'wise-blog' ); ?></label> 
<textarea class="widefat" rows="7" cols="20" id="<?php echo esc_attr($this->get_field_id('subs_head')); ?>" name="<?php echo esc_attr($this->get_field_name('subs_head')); ?>"><?php echo esc_textarea($subs_head); ?></textarea>
</p>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'subs_url' )); ?>"><?php esc_html_e( 'Subscribe URL:', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'subs_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'subs_url' )); ?>" type="text" value="<?php echo esc_url( $subs_url ); ?>">
</p>

<?php 
}
	
// New Instances
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['subs_head'] = ( ! empty( $new_instance['subs_head'] ) ) ? strip_tags( $new_instance['subs_head'] ) : '';
$instance['subs_url'] = ( ! empty( $new_instance['subs_url'] ) ) ? strip_tags( $new_instance['subs_url'] ) : '';
return $instance;
}
}

// Register and load the widget
function subs_load_widget() {
	register_widget( 'subs_widget' );
}
add_action( 'widgets_init', 'subs_load_widget' );