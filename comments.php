<?php
/*
* Template to Display Comments
*
*/
?>

<?php
	if ( post_password_required() ) {
		return;
	}

        if (is_page())
        {
		return;  // Falkvinge: do not show comment field at all on pages
	}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="page-title">
			<?php esc_html_e( 'Discussion', 'wise-blog'); ?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wise-blog' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><i class="fa fa-arrow-left"></i><?php previous_comments_link( esc_html__( 'Older Comments', 'wise-blog' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'wise-blog' ) ); ?><i class="fa fa-arrow-right"></i></div>

			</div><!-- End of .nav-links -->
		</nav><!-- End of #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'callback'   => 'wise_comment_settings', // Custom function callback, comment or remove this to view defaults
					'short_ping' => true,
					'avatar_size'=> 50,
				) );
			?>
		</ol><!-- End of .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wise-blog' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php echo '<i class="fa fa-arrow-left"></i>'; previous_comments_link( esc_html__( 'Older Comments', 'wise-blog' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'wise-blog' ) ); echo '<i class="fa fa-arrow-right"></i>'; ?></div>

			</div><!-- End of .nav-links -->
		</nav><!-- End of #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wise-blog' ); ?></p>
	<?php endif; ?>

	<?php
		$comment_args = array(
		'id_form'           => 'commentform',
		'class_form'      	=> 'comment-form',
		'id_submit'         => 'submit',
		'class_submit'      => 'submit',
		'name_submit'       => 'submit',
		'title_reply'       => esc_attr__( 'Join the Discussion', 'wise-blog' ),
		'title_reply_to'    => esc_attr__( 'Leave a Reply to', 'wise-blog' ) . ' %s',
		'cancel_reply_link' => esc_attr__( 'Cancel Reply', 'wise-blog' ),
		'label_submit'      => esc_attr__( 'Post Comment', 'wise-blog' ),
		'format'            => 'xhtml',
		
		'comment_field' =>  '<p class="comment-form-comment">' .
		'<textarea id="comment" name="comment" placeholder="What do you think of this? Is somebody wrong on the Internet? Type the right answer here!" cols="45" rows="8" aria-required="true">' .
			'</textarea></p>',
			
		$fields =  array(
		  'author' =>
			'<p class="comment-form-author">' .
			( $req ? '' : '' ) .
			'<input id="author" name="author" type="text" placeholder="Your name, maybe" value="' . esc_attr( $commenter['comment_author']) .
			'" size="30"></p>',

		  'email' =>
			'<p class="comment-form-email">' .
			( $req ? '' : '' ) .
			'<input id="email" name="email" type="text" placeholder="Mail, totally optional" value="' . esc_attr( $commenter['comment_author_email']) .
			'" size="30"></p>',

		  'url' =>
			'<p class="comment-form-url">' .
			'<input id="url" name="url" type="text" placeholder="Link, if relevant" value="' . esc_url( $commenter['comment_author_url']) .
			'" size="30"></p>',
		),
			
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
	);
	comment_form($comment_args); ?>

</div><!-- End of #comments -->
