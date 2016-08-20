<?php
/*
* Wise About Widget
*
*/

// Create the widget
class about_widget extends WP_Widget {

function __construct() {
$widget_ops = array( 'description' => esc_html__( 'Displays your about widget.', 'wise-blog'));
$control_ops = array('width' => 400, 'height' => 350);

parent::__construct( 'about_widget', esc_html__( '#Wise About', 'wise-blog' ), $widget_ops, $control_ops);
}

// Frontend
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', @$instance['title'] );
$about_img = apply_filters( 'widget_about_img', @$instance['about_img'] );
$about_content = apply_filters( 'widget_about_content', @$instance['about_content'] );
$about_url = apply_filters( 'widget_about_url', @$instance['about_url'] );

// Before and after the widget
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . esc_html($title) . $args['after_title'];

// The Output
if(get_option('wise_footer_about_logo')==false) {
	$def_footer_url = get_template_directory_uri() . '/img/footer_logo.png';
	echo '<div class="about-logo"><a href="' . esc_url( home_url('/') ) . '">';
	if ($about_img == true) {
		echo '<img src="' . esc_url($about_img) . '" alt="' . get_the_title() . '"></a></div>'; }
	else {
		echo '<img src="' . esc_url($def_footer_url) . '" alt="' . get_the_title() . '"></a></div>'; }
}
	
echo '<div class="about-text">' . esc_html($about_content) . '</div>';
echo '<span class="nolinehover"><a href="' . esc_url($about_url) . '">Read More</a></span>';

echo $args['after_widget'];
}
		
// Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}
else {
	$title = esc_html__( 'About', 'wise-blog' );
}

if ( isset( $instance[ 'about_img' ] ) ) {
	$about_img = $instance[ 'about_img' ];
}
else {
	$about_img = null;
}

if ( isset( $instance[ 'about_content' ] ) ) {
	$about_content = $instance[ 'about_content' ];
}
else {
	$about_content = null;
}

if ( isset( $instance[ 'about_url' ] ) ) {
	$about_url = $instance[ 'about_url' ];
}
else {
	$about_url = null;
}

// Backend Admin Form
?>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'about_img' )); ?>"><?php esc_html_e( 'Logo URL:', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'about_img' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'about_img' )); ?>" type="text" value="<?php echo esc_attr( $about_img ); ?>">
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'about_content' )); ?>"><?php esc_html_e( 'Content:', 'wise-blog' ); ?></label>
<textarea class="widefat" rows="12" cols="20" id="<?php echo esc_attr($this->get_field_id('about_content')); ?>" name="<?php echo esc_attr($this->get_field_name('about_content')); ?>"><?php echo esc_attr($about_content); ?></textarea></p>
<p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'about_url' )); ?>"><?php esc_html_e( 'URL (Please input complete URL address):', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'about_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'about_url' )); ?>" type="text" value="<?php echo esc_attr( $about_url ); ?>">
</p>

<?php 
}
	
// New Instances
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['about_img'] = ( ! empty( $new_instance['about_img'] ) ) ? strip_tags( $new_instance['about_img'] ) : '';
$instance['about_content'] = ( ! empty( $new_instance['about_content'] ) ) ? strip_tags( $new_instance['about_content'] ) : '';
$instance['about_url'] = ( ! empty( $new_instance['about_url'] ) ) ? strip_tags( $new_instance['about_url'] ) : '';
return $instance;
}
}

// Register and load widget
function about_load_widget() {
	register_widget( 'about_widget' );
}
add_action( 'widgets_init', 'about_load_widget' );