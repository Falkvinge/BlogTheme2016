<?php
/*
* Custom Search Form
*
*/
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo esc_attr_e( 'Search for:', 'wise-blog' ) ?></span>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_e( 'What are you looking for?', 'wise-blog' ) ?>"
            value="<?php echo get_search_query(); ?>" name="s"
            title="<?php echo esc_attr_e( 'Search for:', 'wise-blog' ); ?>">
    </label>
    <input type="submit" class="search-submit"
        value="<?php echo esc_attr_e( 'Search', 'wise-blog' ); ?>">
</form>