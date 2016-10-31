<?php
/*
* Wise Recent Posts Widget
*
*/

// Create the widget
class crp_widget extends WP_Widget {

function __construct() {
$widget_ops = array( 'description' => esc_html__( 'Displays your custom recent posts.', 'wise-blog'));
$control_ops = array('width' => 400, 'height' => 350);

parent::__construct( 'crp_widget', esc_html__( '#Wise Recent Posts', 'wise-blog' ), $widget_ops, $control_ops);
}

// Frontend
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', @$instance['title'] );
$number = apply_filters( 'widget_number', @$instance['number'] );
$categ = apply_filters( 'widget_categ', @$instance['categ'] );
$order = apply_filters( 'widget_order', @$instance['order'] );

// Before and after the widget
echo wp_kses_post($args['before_widget']);
if ( ! empty( $title ) )
echo wp_kses_post($args['before_title']) . esc_html($title) . wp_kses_post($args['after_title']);

// The Output
	echo '<div class="custom-posts"><ul>';
	
	if( $categ != null ) {
		$categ_name = get_cat_name($categ);
		$categ_ID = get_cat_ID($categ_name);
		$categ_slug = wise_get_cat_slug($categ_ID);
	} else { $categ_slug = null; }
	
	$the_query = new WP_Query( array('posts_per_page' => $number, 'category_name' => $categ_slug, 'ignore_sticky_posts' => 1, 'post_status' => "publish", 'post_type' =>"post", 'orderby' => $order ) );

	while ($the_query -> have_posts()) : $the_query -> the_post();
	
		echo '<li>' . '<a href="' . esc_url(esc_url(get_the_permalink())) . ' "> ';
		
		if ( has_post_thumbnail() ) {
			echo '<span class="alignleft-side">';
			echo the_post_thumbnail('wise-side-thumb');
			echo '</span>';
		} else { null; }
		
		echo '<div class="url-popular"><h4>' . esc_html(get_the_title()) . '</h4><span class="entry-meta-popular">';
		echo wise_posted_on() . '</span></div></a></li>';
		
	endwhile;
	wp_reset_postdata();
	
	echo '</ul></div><!-- End Recent Posts -->';

echo wp_kses_post($args['after_widget']);
}
		
// Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}
else {
	$title = esc_html__( 'Recent Posts', 'wise-blog' );
}

if ( isset( $instance[ 'number' ] ) ) {
	$number = $instance[ 'number' ];
}
else {
	$number = '7';
}

if ( isset( $instance[ 'categ' ] ) ) {
	$categ = $instance[ 'categ' ];
}
else {
	$categ = null;
}

if ( isset( $instance[ 'order' ] ) ) {
	$order = $instance[ 'order' ];
}
else {
	$order = null;
}

// Backend Admin Form
?>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'wise-blog' ); ?></label>
	<input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="3">
</p>

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'categ' )); ?>"><?php esc_html_e( 'Leave this blank to show recent posts:', 'wise-blog' ); ?></label>
	<select id="<?php echo esc_attr($this->get_field_id( 'categ' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'categ' )); ?>" class="widefat">
		<option value="">
		<?php echo esc_html__( '&mdash; Select Category &mdash;', 'wise-blog' ); ?></option> 
		 <?php 
		  $categories = get_categories('hide_empty=0&orderby=name'); 
		  foreach ( $categories as $category ) {
			echo '<option value="' . esc_attr($category->cat_ID) . '"';
			if(get_cat_name($categ)==$category->cat_name) { echo 'selected'; }
			echo '>';
			echo esc_html($category->cat_name);
			echo '</option>';
		  }
	 ?>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'order' )); ?>"><?php esc_html_e( 'Choose how post will be ordered:', 'wise-blog' ); ?></label>
	<select id="<?php echo esc_attr($this->get_field_id( 'order' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'order' )); ?>" class="widefat">
		<option value="date" <?php if($order == 'date') { echo 'selected'; } ?>><?php echo esc_html__( 'Date', 'wise-blog' ); ?></option>
		<option value="rand" <?php if($order == 'rand') { echo 'selected'; } ?>><?php echo esc_html__( 'Random', 'wise-blog' ); ?></option> 
		<option value="title" <?php if($order == 'title') { echo 'selected'; } ?>><?php echo esc_html__( 'Title', 'wise-blog' ); ?></option>
		<option value="comment_count" <?php if($order == 'comment_count') { echo 'selected'; } ?>><?php echo esc_html__( 'Comment', 'wise-blog' ); ?></option> 
	</select>
</p>
<?php 
}
	
// New Instances
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
$instance['categ'] = ( ! empty( $new_instance['categ'] ) ) ? strip_tags( $new_instance['categ'] ) : '';
$instance['order'] = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';
return $instance;
}
}

// Register and load the widget
function crp_load_widget() {
	register_widget( 'crp_widget' );
}
add_action( 'widgets_init', 'crp_load_widget' );