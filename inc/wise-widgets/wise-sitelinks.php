<?php
/*
* Wise Footer Sitelinks Widget
*
*/

// Create the widget
class sitelinks_widget extends WP_Widget {

function __construct() {
$widget_ops = array( 'description' => esc_html__( 'Displays your sitelinks widget for footer.', 'wise-blog'));
$control_ops = array('width' => 400, 'height' => 350);

parent::__construct( 'sitelinks_widget', esc_html__( '#Wise Footer Sitelinks', 'wise-blog' ), $widget_ops, $control_ops);
}

// Frontend
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', @$instance['title'] );

// Before and after the widget
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . esc_html($title) . $args['after_title'];

// The Output
echo '<div class="site-links">';

	$first_args = array( // First Column
		'theme_location' => 'sitelinks_first',
		'menu_class' => 'td',
		'fallback_cb' => 'wise_menu_message'
	);
	wp_nav_menu($first_args);
	
	$second_args = array( // Second Column
		'theme_location' => 'sitelinks_second',
		'menu_class' => 'td',
		'fallback_cb' => 'wise_menu_message'
	);
	wp_nav_menu($second_args);
	
echo '</div>'; // End Sitelinks

echo $args['after_widget'];
}
		
// Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}
else {
	$title = esc_html__( 'Site Links', 'wise-blog' );
}

// Backend Admin Form
?>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>

<?php 
}
	
// New Instances
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
}

// Register and load widget
function sitelinks_load_widget() {
	register_widget( 'sitelinks_widget' );
}
add_action( 'widgets_init', 'sitelinks_load_widget' );