<?php
/*
* Custom Search Form
*
*/
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo esc_html__( 'Search for:', 'wise-blog' ); ?></span>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr__( 'What are you looking for?', 'wise-blog' ); ?>"
            value="<?php echo get_search_query(); ?>" name="s"
            title="<?php echo esc_attr__( 'Search for:', 'wise-blog' ); ?>">
    </label>
    <input type="submit" class="search-submit"
        value="<?php echo esc_attr__( 'Search', 'wise-blog' ); ?>">
</form>