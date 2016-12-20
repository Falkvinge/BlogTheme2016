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
$enable_social = apply_filters( 'widget_enable_social', @$instance['enable_social'] );
$wise_about_location = apply_filters( 'widget_wise_about_location', @$instance['wise_about_location'] );
$wise_about_email = apply_filters( 'widget_wise_about_email', @$instance['wise_about_email'] );
$wise_about_phone = apply_filters( 'widget_wise_about_phone', @$instance['wise_about_phone'] );

// Before and after the widget
echo wp_kses_post($args['before_widget']);
if ( ! empty( $title ) )
echo wp_kses_post($args['before_title']) . esc_html($title) . wp_kses_post($args['after_title']);

// The Output
if(get_option('wise_footer_about_logo')==false) {
	$def_footer_url = get_template_directory_uri() . '/img/footer_logo.png';
	
	if ($about_img == true) {
		echo '<div class="about-logo"><a href="' . esc_url( home_url('/') ) . '">';
		echo '<img src="' . esc_url($about_img) . '" alt="' . esc_attr(get_the_title()) . '"></a></div>'; }
	else {
		null; }
}

echo '<div class="about-text"><p>' . esc_html($about_content);
if($wise_about_location != null) : echo '<p><strong>' . esc_html__('Location', 'wise-blog') . '</strong>: ' . esc_html($wise_about_location); endif;
if($wise_about_email != null) : echo '<br><strong>' . esc_html__('Email', 'wise-blog') . '</strong>: <a href="mailto:' . esc_html($wise_about_email) . '">' . esc_html($wise_about_email) . '</a>'; endif;
if($wise_about_phone != null) : echo '<br><strong>' . esc_html__('Phone', 'wise-blog') . '</strong>: ' . esc_html($wise_about_phone); endif;
echo '</p></div>';

if($enable_social == 'true') {	
	wise_footer_social_menu(); // Social Media Footer
} else { // If enable social is false
	echo '<span class="nolinehover"><a href="' . esc_url($about_url) . '">' . esc_html__( 'Read More', 'wise-blog' ) . '</a></span>';
}

echo wp_kses_post($args['after_widget']);
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

if ( isset( $instance[ 'enable_social' ] ) ) {
	$enable_social = $instance[ 'enable_social' ];
}
else {
	$enable_social = 'false';
}

if ( isset( $instance[ 'wise_about_location' ] ) ) {
	$wise_about_location = $instance[ 'wise_about_location' ];
}
else {
	$wise_about_location = null;
}

if ( isset( $instance[ 'wise_about_email' ] ) ) {
	$wise_about_email = $instance[ 'wise_about_email' ];
}
else {
	$wise_about_email = null;
}

if ( isset( $instance[ 'wise_about_phone' ] ) ) {
	$wise_about_phone = $instance[ 'wise_about_phone' ];
}
else {
	$wise_about_phone = null;
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
<textarea class="widefat" rows="12" cols="20" id="<?php echo esc_attr($this->get_field_id('about_content')); ?>" name="<?php echo esc_attr($this->get_field_name('about_content')); ?>"><?php echo esc_textarea($about_content); ?></textarea></p>
<p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'wise_about_location' )); ?>"><?php esc_html_e( 'Location:', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'wise_about_location' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'wise_about_location' )); ?>" type="text" value="<?php echo esc_attr( $wise_about_location ); ?>">
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'wise_about_email' )); ?>"><?php esc_html_e( 'Email:', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'wise_about_email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'wise_about_email' )); ?>" type="text" value="<?php echo esc_attr( $wise_about_email ); ?>">
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'wise_about_phone' )); ?>"><?php esc_html_e( 'Phone:', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'wise_about_phone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'wise_about_phone' )); ?>" type="text" value="<?php echo esc_attr( $wise_about_phone ); ?>">
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'about_url' )); ?>"><?php esc_html_e( 'URL (Please input complete URL address):', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'about_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'about_url' )); ?>" type="text" value="<?php echo esc_attr( $about_url ); ?>">
</p>

<p>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'enable_social' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'enable_social' )); ?>" type="checkbox" value="<?php echo esc_attr($enable_social); ?>" <?php if($enable_social == 'true') { echo 'checked'; } ?>>
<label for="<?php echo esc_attr($this->get_field_id( 'enable_social' )); ?>"><?php esc_html_e( 'Enable Social Buttons', 'wise-blog' ); ?></label>
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
$instance['enable_social'] = ( ! empty( $new_instance['enable_social'] ) ) ? 'true' : 'false';
$instance['wise_about_location'] = ( ! empty( $new_instance['wise_about_location'] ) ) ? strip_tags( $new_instance['wise_about_location'] ) : '';
$instance['wise_about_email'] = ( ! empty( $new_instance['wise_about_email'] ) ) ? strip_tags( $new_instance['wise_about_email'] ) : '';
$instance['wise_about_phone'] = ( ! empty( $new_instance['wise_about_phone'] ) ) ? strip_tags( $new_instance['wise_about_phone'] ) : '';
return $instance;
}
}

// Register and load widget
function about_load_widget() {
	register_widget( 'about_widget' );
}
add_action( 'widgets_init', 'about_load_widget' );