<?php
/*
* Wise Tab Posts Widget
*
*/

// Create the widget
class ppl_crp_widget extends WP_Widget {

function __construct() {
$widget_ops = array( 'description' => esc_html__( 'Displays your tab popular and recent posts widget.', 'wise-blog'));
$control_ops = array('width' => 400, 'height' => 350);

parent::__construct( 'ppl_crp_widget', esc_html__( '#Wise Tab Posts', 'wise-blog' ), $widget_ops, $control_ops);
}

// Frontend
public function widget( $args, $instance ) {
// For Popular Posts
$title_ppl = apply_filters( 'widget_title_ppl', @$instance['title_ppl'] );
$number_ppl = apply_filters( 'widget_number_ppl', @$instance['number_ppl'] );
$categ_ppl = apply_filters( 'widget_categ_ppl', @$instance['categ_ppl'] );
$weekly_ppl = apply_filters( 'widget_weekly_ppl', @$instance['weekly_ppl'] );
$monthly_ppl = apply_filters( 'widget_monthly_ppl', @$instance['monthly_ppl'] );
$yearly_ppl = apply_filters( 'widget_yearly_ppl', @$instance['yearly_ppl'] );

// For Recent Posts
$title_crp = apply_filters( 'widget_title_crp', @$instance['title_crp'] );
$number_crp = apply_filters( 'widget_number_crp', @$instance['number_crp'] );
$categ_crp = apply_filters( 'widget_categ_crp', @$instance['categ_crp'] );
$order_crp = apply_filters( 'widget_order_crp', @$instance['order_crp'] );

?>
<div class="widget tab-sidebar">
	<ul class="nav nav-pills">
		<li class="active"><a data-toggle="tab" href="#popular"><?php echo esc_attr($title_ppl); ?></a></li>
		<li><a data-toggle="tab" href="#recent"><?php echo esc_attr($title_crp); ?></a></li>
	</ul>

	<div class="tab-content">
		<div id="popular" class="tab-pane fade in active">
			<?php // Output for Popular Posts
				echo '<div class="custom-posts"><ul>';
				
				if( $categ_ppl != null ) {
					$categ_name_ppl = get_cat_name($categ_ppl);
					$categ_ID_ppl = get_cat_ID($categ_name_ppl);
					$categ_slug_ppl = wise_get_cat_slug($categ_ID_ppl);
				} else { $categ_slug_ppl = null; }
				
				$popularpost_ppl = new WP_Query( array( 'year' => $yearly_ppl, 'monthnum' => $monthly_ppl, 'w' => $weekly_ppl, 'posts_per_page' => $number_ppl, 'post_type'=>"post", 'category_name' => $categ_slug_ppl, 'meta_key' => 'wise_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'ignore_sticky_posts' => 1 ) );
				while ( $popularpost_ppl->have_posts() ) : $popularpost_ppl->the_post();

					echo '<li>' . '<a href="' . esc_url( get_the_permalink() ) . ' "> ';
					
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

			?>
		</div>
		<div id="recent" class="tab-pane fade">
			<?php // Output for Recent Posts
				echo '<div class="custom-posts"><ul>';
				
				if( $categ_crp != null ) {
					$categ_name_crp = get_cat_name($categ_crp);
					$categ_ID_crp = get_cat_ID($categ_name_crp);
					$categ_slug_crp = wise_get_cat_slug($categ_ID_crp);
				} else { $categ_slug_crp = null; }
	
				$the_query_crp = new WP_Query( array('posts_per_page' => $number_crp, 'category_name' => $categ_slug_crp, 'ignore_sticky_posts' => 1, 'post_status'=>"publish", 'post_type'=>"post", 'orderby'=> $order_crp) );

				while ($the_query_crp -> have_posts()) : $the_query_crp -> the_post();
				
					echo '<li>' . '<a href="' . esc_url( get_the_permalink() ) . ' "> ';
					
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
				
				echo '</ul></div><!-- End Recent Posts -->';
			?>
		</div>
	</div>
</div>
<?php

}
		
// Backend for Popular Posts
public function form( $instance ) {
if ( isset( $instance[ 'title_ppl' ] ) ) {
	$title_ppl = $instance[ 'title_ppl' ];
}
else {
	$title_ppl = esc_html__( 'Popular Posts', 'wise-blog' );
}
if ( isset( $instance[ 'number_ppl' ] ) ) {
	$number_ppl = $instance[ 'number_ppl' ];
}
else {
	$number_ppl = '7';
}

if ( isset( $instance[ 'categ_ppl' ] ) ) {
	$categ_ppl = $instance[ 'categ_ppl' ];
}
else {
	$categ_ppl = null;
}

if ( isset( $instance[ 'weekly_ppl' ] ) ) {
	$weekly_ppl = $instance[ 'weekly_ppl' ];
}
else {
	$weekly_ppl = null;
}

if ( isset( $instance[ 'monthly_ppl' ] ) ) {
	$monthly_ppl = $instance[ 'monthly_ppl' ];
}
else {
	$monthly_ppl = null;
}

if ( isset( $instance[ 'yearly_ppl' ] ) ) {
	$yearly_ppl = $instance[ 'yearly_ppl' ];
}
else {
	$yearly_ppl = null;
}

// Backend for Recent Posts
if ( isset( $instance[ 'title_crp' ] ) ) {
	$title_crp = $instance[ 'title_crp' ];
}
else {
	$title_crp = esc_html__( 'Recent Posts', 'wise-blog' );
}

if ( isset( $instance[ 'number_crp' ] ) ) {
	$number_crp = $instance[ 'number_crp' ];
}
else {
	$number_crp = '7';
}

if ( isset( $instance[ 'categ_crp' ] ) ) {
	$categ_crp = $instance[ 'categ_crp' ];
}
else {
	$categ_crp = null;
}

if ( isset( $instance[ 'order_crp' ] ) ) {
	$order_crp = $instance[ 'order_crp' ];
}
else {
	$order_crp = null;
}

// Backend Admin Form for Popular Posts
?>
<p style="text-align:center;text-transform:uppercase;font-weight:bold;">
<label for="<?php echo esc_attr($this->get_field_id( '' )); ?>"><?php esc_html_e( 'Popular Posts Configuration', 'wise-blog' ); ?></label>
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'title_ppl' )); ?>"><?php esc_html_e( 'Title:', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title_ppl' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title_ppl' )); ?>" type="text" value="<?php echo esc_attr( $title_ppl ); ?>">
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'number_ppl' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'wise-blog' ); ?></label>
<input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number_ppl' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number_ppl' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number_ppl); ?>" size="3"></p>
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'categ_ppl' )); ?>"><?php esc_html_e( 'Leave this blank to show posts from all category:', 'wise-blog' ); ?></label>
<select id="<?php echo esc_attr($this->get_field_id( 'categ_ppl' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'categ_ppl' )); ?>" class="widefat">
<option value="">
<?php echo esc_html__( '&mdash; Select Category &mdash;', 'wise-blog' ); ?></option> 
 <?php 
  $categories_ppl = get_categories('hide_empty=0&orderby=name'); 
  foreach ( $categories_ppl as $category_ppl ) {
  	echo '<option value="' . esc_attr($category_ppl->cat_ID) . '"';
	if(get_cat_name($categ_ppl) == $category_ppl->cat_name) { echo 'selected'; }
	echo '>';
	echo esc_html($category_ppl->cat_name);
	echo '</option>';
  }
 ?>
</select>
</p>

<?php 	
	$week_ppl = date_i18n( 'W' );
	$month_ppl = date_i18n( 'm' );
	$year_ppl = date_i18n( 'Y' ); ?>

<p>
<label for="<?php echo esc_attr($this->get_field_id( '' )); ?>"><?php esc_html_e( 'Choose how your popular posts will be displayed:', 'wise-blog' ); ?></label>
</p>

<!-- Weekly -->
<p>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'weekly_ppl' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'weekly_ppl' )); ?>" type="checkbox" value="<?php echo esc_attr($week_ppl); ?>" <?php if($weekly_ppl == $week_ppl) { echo 'checked'; } ?>>
<label for="<?php echo esc_attr($this->get_field_id( 'weekly_ppl' )); ?>"><?php esc_html_e( 'This Week Popular Posts', 'wise-blog' ); ?></label>
</p>

<!-- Monthly -->
<p>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'monthly_ppl' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'monthly_ppl' )); ?>" type="checkbox" value="<?php echo esc_attr($month_ppl); ?>" <?php if($monthly_ppl == $month_ppl) { echo 'checked'; } ?>>
<label for="<?php echo esc_attr($this->get_field_id( 'monthly_ppl' )); ?>"><?php esc_html_e( 'This Month Popular Posts', 'wise-blog' ); ?></label>
</p>

<!-- Yearly -->
<p>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'yearly_ppl' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'yearly_ppl' )); ?>" type="checkbox" value="<?php echo esc_attr($year_ppl); ?>" <?php if($yearly_ppl == $year_ppl) { echo 'checked'; } ?>>
<label for="<?php echo esc_attr($this->get_field_id( 'yearly_ppl' )); ?>"><?php esc_html_e( 'This Year Popular Posts', 'wise-blog' ); ?></label>
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( '' )); ?>"><?php global $wise_allowed_html; echo wp_kses( __( '<i>*Please make sure week starts on Monday in your Settings tab.</i><br>Settings=>General=>Week Starts On=><strong>Monday</strong><br><i>*If you want to display all-time popular posts, leave all checkbox unchecked.</i>', 'wise-blog' ), $wise_allowed_html); ?></label>
</p>

<?php // Backend for Recent Posts ?>
<p style="text-align:center;text-transform:uppercase;font-weight:bold;">
<label for="<?php echo esc_attr($this->get_field_id( '' )); ?>"><?php esc_html_e( 'Recent Posts Configuration', 'wise-blog' ); ?></label>
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'title_crp' )); ?>"><?php esc_html_e( 'Title:', 'wise-blog' ); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title_crp' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title_crp' )); ?>" type="text" value="<?php echo esc_attr( $title_crp ); ?>">
</p>

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'number_crp' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'wise-blog' ); ?></label>
	<input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number_crp' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number_crp' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number_crp); ?>" size="3"></p>

</p>

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'categ_crp' )); ?>"><?php esc_html_e( 'Leave this blank to show recent posts:', 'wise-blog' ); ?></label>
	<select id="<?php echo esc_attr($this->get_field_id( 'categ_crp' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'categ_crp' )); ?>" class="widefat">
		<option value="">
		<?php echo esc_html__( '&mdash; Select Category &mdash;', 'wise-blog' ); ?></option> 
		 <?php 
		  $categories_crp = get_categories('hide_empty=0&orderby=name'); 
		  foreach ( $categories_crp as $category_crp ) {
			echo '<option value="' . esc_attr($category_crp->cat_ID) . '"';
			if(get_cat_name($categ_crp)==$category_crp->cat_name) { echo 'selected'; }
			echo '>';
			echo esc_html($category_crp->cat_name);
			echo '</option>';
		  }
	 ?>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'order_crp' )); ?>"><?php esc_html_e( 'Choose how post will be ordered:', 'wise-blog' ); ?></label>
	<select id="<?php echo esc_attr($this->get_field_id( 'order_crp' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'order_crp' )); ?>" class="widefat">
		<option value="date" <?php if($order_crp == 'date') { echo 'selected'; } ?>><?php echo esc_html__( 'Date', 'wise-blog' ); ?></option>
		<option value="rand" <?php if($order_crp == 'rand') { echo 'selected'; } ?>><?php echo esc_html__( 'Random', 'wise-blog' ); ?></option> 
		<option value="title" <?php if($order_crp == 'title') { echo 'selected'; } ?>><?php echo esc_html__( 'Title', 'wise-blog' ); ?></option>
		<option value="comment_count" <?php if($order_crp == 'comment_count') { echo 'selected'; } ?>><?php echo esc_html__( 'Comment', 'wise-blog' ); ?></option> 
	</select>
</p>

<?php 
}
	
// New Instances
public function update( $new_instance, $old_instance ) {
$instance = array();
// For Popular Posts
$instance['title_ppl'] = ( ! empty( $new_instance['title_ppl'] ) ) ? strip_tags( $new_instance['title_ppl'] ) : '';
$instance['number_ppl'] = ( ! empty( $new_instance['number_ppl'] ) ) ? strip_tags( $new_instance['number_ppl'] ) : '';
$instance['categ_ppl'] = ( ! empty( $new_instance['categ_ppl'] ) ) ? strip_tags( $new_instance['categ_ppl'] ) : '';
$instance['weekly_ppl'] = ( ! empty( $new_instance['weekly_ppl'] ) ) ? strip_tags( $new_instance['weekly_ppl'] ) : '';
$instance['monthly_ppl'] = ( ! empty( $new_instance['monthly_ppl'] ) ) ? strip_tags( $new_instance['monthly_ppl'] ) : '';
$instance['yearly_ppl'] = ( ! empty( $new_instance['yearly_ppl'] ) ) ? strip_tags( $new_instance['yearly_ppl'] ) : '';

// For Recent Posts
$instance['title_crp'] = ( ! empty( $new_instance['title_crp'] ) ) ? strip_tags( $new_instance['title_crp'] ) : '';
$instance['number_crp'] = ( ! empty( $new_instance['number_crp'] ) ) ? strip_tags( $new_instance['number_crp'] ) : '';
$instance['categ_crp'] = ( ! empty( $new_instance['categ_crp'] ) ) ? strip_tags( $new_instance['categ_crp'] ) : '';
$instance['order_crp'] = ( ! empty( $new_instance['order_crp'] ) ) ? strip_tags( $new_instance['order_crp'] ) : '';

return $instance;
}
}

// Register and load the widget
function ppl_crp_load_widget() {
	register_widget( 'ppl_crp_widget' );
}
add_action( 'widgets_init', 'ppl_crp_load_widget' );