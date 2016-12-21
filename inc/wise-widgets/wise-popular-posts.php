<?php
/*
* Wise Popular Posts Widget
*
*/

// Create the widget
class ppl_widget extends WP_Widget {

function __construct() {
$widget_ops = array( 'description' => esc_html__( 'Displays your popular sidebar widget.', 'wise-blog'));
$control_ops = array('width' => 400, 'height' => 350);

parent::__construct( 'ppl_widget', esc_html__( '#Wise Popular Posts', 'wise-blog' ), $widget_ops, $control_ops);
}

// Frontend
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', @$instance['title'] );
$number = apply_filters( 'widget_number', @$instance['number'] );
$categ = apply_filters( 'widget_categ', @$instance['categ'] );
$weekly = apply_filters( 'widget_weekly', @$instance['weekly'] );
$monthly = apply_filters( 'widget_monthly', @$instance['monthly'] );
$yearly = apply_filters( 'widget_yearly', @$instance['yearly'] );

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
	
	$popularpost = new WP_Query( array( 'year' => $yearly, 'monthnum' => $monthly, 'w' => $weekly, 'posts_per_page' => $number, 'category_name' => $categ_slug, 'meta_key' => 'wise_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'ignore_sticky_posts' => 1  ) );
	while ( $popularpost->have_posts() ) : $popularpost->the_post();

		echo '<li>' . '<a href="' . esc_url(esc_url(get_the_permalink())) . ' "> ';
		
		if ( has_post_thumbnail() ) {
			echo '<span class="alignleft-side">';
			the_post_thumbnail('wise-side-thumb');
			echo '</span>';
		} else { null; }
		
		echo '<div class="url-popular"><h4>' . esc_html(get_the_title()) . '</h4><span class="entry-meta-popular">';
		wise_posted_on();
		echo '</span></div></a></li>';

	endwhile;
	wp_reset_postdata();
	
	echo '</ul></div><!-- End Popular Posts -->';

echo wp_kses_post($args['after_widget']);
}
		
// Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}
else {
	$title = esc_html__( 'Popular Posts', 'wise-blog' );
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

if ( isset( $instance[ 'weekly' ] ) ) {
	$weekly = $instance[ 'weekly' ];
}
else {
	$weekly = null;
}

if ( isset( $instance[ 'monthly' ] ) ) {
	$monthly = $instance[ 'monthly' ];
}
else {
	$monthly = null;
}

if ( isset( $instance[ 'yearly' ] ) ) {
	$yearly = $instance[ 'yearly' ];
}
else {
	$yearly = null;
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
<label for="<?php echo esc_attr($this->get_field_id( 'categ' )); ?>"><?php esc_html_e( 'Leave this blank to show posts from all category:', 'wise-blog' ); ?></label>
<select id="<?php echo esc_attr($this->get_field_id( 'categ' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'categ' )); ?>" class="widefat">
<option value="">
<?php echo esc_html__( '&mdash; Select Category &mdash;', 'wise-blog' ); ?></option> 
 <?php 
  $categories = get_categories('hide_empty=0&orderby=name'); 
  foreach ( $categories as $category ) {
  	echo '<option value="' . esc_attr($category->cat_ID) . '"';
	if(get_cat_name($categ) == $category->cat_name) { echo 'selected'; }
	echo '>';
	echo esc_html($category->cat_name);
	echo '</option>';
  }
 ?>
</select>
</p>

<?php 	
	$week = date_i18n( 'W' );
	$month = date_i18n( 'm' );
	$year = date_i18n( 'Y' ); ?>

<p>
<label for="<?php echo esc_attr($this->get_field_id( '' )); ?>"><?php esc_html_e( 'Choose how your popular posts will be displayed:', 'wise-blog' ); ?></label>
</p>

<!-- Weekly -->
<p>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'weekly' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'weekly' )); ?>" type="checkbox" value="<?php echo esc_attr($week); ?>" <?php if($weekly == $week) { echo 'checked'; } ?>>
<label for="<?php echo esc_attr($this->get_field_id( 'weekly' )); ?>"><?php esc_html_e( 'This Week Popular Posts', 'wise-blog' ); ?></label>
</p>

<!-- Monthly -->
<p>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'monthly' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'monthly' )); ?>" type="checkbox" value="<?php echo esc_attr($month); ?>" <?php if($monthly == $month) { echo 'checked'; } ?>>
<label for="<?php echo esc_attr($this->get_field_id( 'monthly' )); ?>"><?php esc_html_e( 'This Month Popular Posts', 'wise-blog' ); ?></label>
</p>

<!-- Yearly -->
<p>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'yearly' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'yearly' )); ?>" type="checkbox" value="<?php echo esc_attr($year); ?>" <?php if($yearly == $year) { echo 'checked'; } ?>>
<label for="<?php echo esc_attr($this->get_field_id( 'yearly' )); ?>"><?php esc_html_e( 'This Year Popular Posts', 'wise-blog' ); ?></label>
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( '' )); ?>"><?php global $wise_allowed_html; echo wp_kses( __( '<i>*Please make sure week starts on Monday in your Settings tab.</i><br>Settings=>General=>Week Starts On=><strong>Monday</strong><br><i>*If you want to display all-time popular posts, leave all checkbox unchecked.</i>', 'wise-blog' ), $wise_allowed_html); ?></label>
</p>
<?php 
}
	
// New Instances
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
$instance['categ'] = ( ! empty( $new_instance['categ'] ) ) ? strip_tags( $new_instance['categ'] ) : '';
$instance['weekly'] = ( ! empty( $new_instance['weekly'] ) ) ? strip_tags( $new_instance['weekly'] ) : '';
$instance['monthly'] = ( ! empty( $new_instance['monthly'] ) ) ? strip_tags( $new_instance['monthly'] ) : '';
$instance['yearly'] = ( ! empty( $new_instance['yearly'] ) ) ? strip_tags( $new_instance['yearly'] ) : '';
return $instance;
}
}

// Register and load the widget
function ppl_load_widget() {
	register_widget( 'ppl_widget' );
}
add_action( 'widgets_init', 'ppl_load_widget' );