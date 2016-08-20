<?php
/*
* Wise Dashboard User Widget
*
*/

// Create the widget
class dashuser_widget extends WP_Widget {

function __construct() {
$widget_ops = array( 'description' => esc_html__( 'Displays your dashboard user widget.', 'wise-blog'));
$control_ops = array('width' => 400, 'height' => 350);

parent::__construct( 'dashuser_widget', esc_html__( '#Wise Dashboard User', 'wise-blog'), $widget_ops, $control_ops);
}

// Frontend
public function widget( $args, $instance ) {
$dash_notice_login = apply_filters( 'widget_dash_notice_login', @$instance['dash_notice_login'] );
$dash_notice_logout = apply_filters( 'widget_dash_notice_logout', @$instance['dash_notice_logout'] );

// Before and after the widget
echo $args['before_widget'];

// The Output
?>
<div class="dash-all">
	<?php esc_html_e('Welcome', 'wise-blog'); echo '&#44; '; ?>
	<div class="dash-gravatar"><?php global $userdata; wp_get_current_user(); echo wp_kses_post(get_avatar( @$userdata->ID, 50 ));  ?></div>
	<h2 class="dash-name"><?php if(is_user_logged_in()) { echo esc_attr(wp_get_current_user()->display_name); } else { esc_html_e('Guest','wise-blog'); } ?></h2>		
	<?php if (is_user_logged_in()) { ?>
		<div class="dash-tools">
			<a href="<?php echo esc_url( home_url('/') . 'wp-admin/'); ?>"><?php esc_html_e( 'Dashboard', 'wise-blog' ); ?></a>
			<?php if(function_exists('is_woocommerce') && is_woocommerce() ) : echo '<a class="dash-home" href="' . wc_customer_edit_account_url() . '">' . esc_html__( 'Edit Account', 'wise-blog') . '</a>';
				else : echo '<a class="dash-home" href="' . esc_url( home_url('/') . 'wp-admin/profile.php') . '">' . esc_html__( 'Edit Account', 'wise-blog') . '</a>'; endif; ?>
		</div>
		<a class="dash-out" href="<?php echo wp_logout_url( home_url('/') ); ?>"><?php esc_html_e( 'Log out', 'wise-blog' ); ?></a>
		<span class="dash-notice"><i><?php echo esc_attr($dash_notice_login); ?></i></span>
	<?php } else { ?>
		<div class="dash-tools">
			<a class="lg-in" href="<?php if ( function_exists('is_woocommerce') ) { echo get_permalink( get_option('woocommerce_myaccount_page_id') ); } else { echo esc_url( home_url('/') . 'wp-admin/'); } ?>"><?php esc_html_e( 'Login', 'wise-blog' ); ?></a>
			<a class="lg-reg dash-home" href="<?php echo esc_url( home_url('/') . 'wp-login.php?action=register'); ?>"><?php esc_html_e( 'Register', 'wise-blog' ); ?></a>
		</div>
		<span class="dash-notice"><i><?php echo esc_attr($dash_notice_logout); ?></i></span>
	<?php } ?>
</div>
<?php

echo $args['after_widget'];
}
		
// Backend
public function form( $instance ) {

if ( isset( $instance[ 'dash_notice_login' ] ) ) {
	$dash_notice_login = $instance[ 'dash_notice_login' ];
}
else {
	$dash_notice_login = esc_html__( 'You are logged in.', 'wise-blog' );
}

if ( isset( $instance[ 'dash_notice_logout' ] ) ) {
	$dash_notice_logout = $instance[ 'dash_notice_logout' ];
}
else {
	$dash_notice_logout = esc_html__( 'You are logged out.', 'wise-blog' );
}

// Backend Admin Form
?>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'dash_notice_login' )); ?>"><?php esc_html_e( 'Dashboard user notice when logged in:', 'wise-blog' ); ?></label>
<textarea class="widefat" rows="12" cols="20" id="<?php echo esc_attr($this->get_field_id('dash_notice_login')); ?>" name="<?php echo esc_attr($this->get_field_name('dash_notice_login')); ?>"><?php echo esc_attr($dash_notice_login); ?></textarea></p>
<p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'dash_notice_logout' )); ?>"><?php esc_html_e( 'Dashboard user notice when not logged in:', 'wise-blog' ); ?></label>
<textarea class="widefat" rows="12" cols="20" id="<?php echo esc_attr($this->get_field_id('dash_notice_logout')); ?>" name="<?php echo esc_attr($this->get_field_name('dash_notice_logout')); ?>"><?php echo esc_attr($dash_notice_logout); ?></textarea></p>
<p>

<?php 
}
	
// New Instances
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['dash_notice_login'] = ( ! empty( $new_instance['dash_notice_login'] ) ) ? strip_tags( $new_instance['dash_notice_login'] ) : '';
$instance['dash_notice_logout'] = ( ! empty( $new_instance['dash_notice_logout'] ) ) ? strip_tags( $new_instance['dash_notice_logout'] ) : '';
return $instance;
}
}

// Register and load widget
function dashuser_load_widget() {
	register_widget( 'dashuser_widget' );
}
add_action( 'widgets_init', 'dashuser_load_widget' );