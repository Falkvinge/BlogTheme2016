<?php
/* Header Type: Default, Simple */
$wise_header_type = get_theme_mod( 'wise_header_type' );

if ( $wise_header_type == 'simple' ) {
    get_template_part( 'header', 'simple' );
} else {
    get_template_part( 'header', 'default' );
}

