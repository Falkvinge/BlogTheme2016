<?php
/*
* Wise Typography Styles
*
*/

/*--------------------------------------------------------------
-----TABLE OF CONTENTS------------------------------------------
----------------------------------------------------------------
1. Heading Fonts
2. Body Fonts
3. Input and Meta Fonts
4. Button Fonts
5. Navigation Fonts
6. Description Fonts
--------------------------------------------------------------*/

/*--------------------------------------------------------------
1. Heading Fonts
--------------------------------------------------------------*/
if( !function_exists('wise_heading_inline_styles') ) :
    function wise_heading_inline_styles() {
		$wise_heading_font = !empty( get_theme_mod('wise_heading_font') ) ? get_theme_mod('wise_heading_font') : 'Roboto';
        $wise_heading_font_title = !empty( get_theme_mod('wise_heading_font') ) ? get_theme_mod('wise_heading_font') : 'Ubuntu';
        $wise_big_heading_weight = !empty( get_theme_mod('wise_big_heading_weight') ) ? get_theme_mod('wise_big_heading_weight') : '700';
        $wise_gen_heading_weight = !empty( get_theme_mod('wise_gen_heading_weight') ) ? get_theme_mod('wise_gen_heading_weight') : '500';
        $wise_other_heading_weight = !empty( get_theme_mod('wise_other_heading_weight') ) ? get_theme_mod('wise_other_heading_weight') : '400';
		$wise_heading_categ = $wise_heading_font ? wise_google_fonts('category', $wise_heading_font) : 'sans-serif';
		$wise_heading_categ_title = $wise_heading_font_title ? wise_google_fonts('category', $wise_heading_font_title) : 'sans-serif';
        
        $wise_heading_inline_css = ".titles-cover h1 a {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_big_heading_weight};
}
.feat-title-content-index-carousel h1 a {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_big_heading_weight};
}

.carousel-title {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_big_heading_weight};
}

.titles-cover h1 a {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_big_heading_weight};
}

.ctc-single-title {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_big_heading_weight};
}

.our-pastor-name {
    font-family: '{$wise_heading_font_title}', {$wise_heading_categ_title};
    font-weight: {$wise_big_heading_weight};
}

.welcome-message h1,
.welcome-message-down h1 {
    font-family: '{$wise_heading_font_title}', {$wise_heading_categ_title};
    font-weight: {$wise_big_heading_weight};
}

.logo-message {
    font-family: '{$wise_heading_font_title}', {$wise_heading_categ_title};
    font-weight: {$wise_gen_heading_weight};
}

h1,
h2,
h3,
h4,
h5,
h6 {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_gen_heading_weight};
}

.page-title-recent {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_gen_heading_weight};
}

.sc-usr-name {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_gen_heading_weight};
}

.nav-pills {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_gen_heading_weight};
}

.wise-tabs .ui-tabs .ui-tabs-nav {
    font-family: '{$wise_heading_font}',{$wise_heading_categ};
    font-weight: {$wise_gen_heading_weight};
}

.related h2 {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_gen_heading_weight};
}

.ctc-button-event {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_gen_heading_weight};
}

.widget li {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_gen_heading_weight};
}

.widget_rss li a {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_gen_heading_weight};
}

.comment-author .fn {
    font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_gen_heading_weight};
}

.sc-chat-header-title {
    font-family: '{$wise_heading_font}', {$wise_heading_categ} !important;
    font-weight: {$wise_other_heading_weight};
}";		
        wp_add_inline_style( 'wise-style', $wise_heading_inline_css );
    }

    add_action( 'wp_enqueue_scripts', 'wise_heading_inline_styles' );

endif; // End if function_exists

/*--------------------------------------------------------------
2. Body Fonts
--------------------------------------------------------------*/
if( !function_exists('wise_bodycont_inline_styles') ) :
    function wise_bodycont_inline_styles() {
        $wise_bodycont_font = get_theme_mod('wise_bodycont_font') ? get_theme_mod('wise_bodycont_font') : 'Open Sans';
        $wise_bodycont_weight = get_theme_mod('wise_bodycont_weight') ? get_theme_mod('wise_bodycont_weight') : '400';
        $wise_bodycont_categ = $wise_bodycont_font ? wise_google_fonts('category', $wise_bodycont_font) : 'sans-serif';

        $wise_bodycont_inline_css = "body,
button,
input,
select,
textarea {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.widget {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.widget-area-left {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.share-count span {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.entry-content blockquote {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.entry-content blockquote p {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.reply, .reply a {
    font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.comment-form {
    font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.comment-awaiting-moderation {
    font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.footer-side {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.menu-footer-menu-container {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

#sc_chat_box, #sc_chat_box *, .sc_chat_box,
#sc_chat_box textarea.f-chat-line,
#sc_chat_box .sc-chat-wrapper input,
#sc_chat_box .sc-chat-wrapper textarea {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

#bbpress-forums div.bbp-topic-author a.bbp-author-name, #bbpress-forums div.bbp-reply-author a.bbp-author-name {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
    font-weight: {$wise_bodycont_weight};
}

.triple-description p {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.profile-details,
.profile-details a {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.site-footer {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.rssSummary {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.flowplayer {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}

.profile-details,
.profile-details a {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
	font-weight: {$wise_bodycont_weight};
}";
        wp_add_inline_style( 'wise-style', $wise_bodycont_inline_css );
    }

    add_action( 'wp_enqueue_scripts', 'wise_bodycont_inline_styles' );

endif; // End if function_exists

/*--------------------------------------------------------------
3. Input and Meta Fonts
--------------------------------------------------------------*/
if( !function_exists('wise_inmeta_inline_styles') ) :
    function wise_inmeta_inline_styles() {
        $wise_inmeta_font = get_theme_mod('wise_inmeta_font') ? get_theme_mod('wise_inmeta_font') : 'Ubuntu';
        $wise_inmeta_weight = get_theme_mod('wise_inmeta_weight') ? get_theme_mod('wise_inmeta_weight') : '400';
        $wise_inmeta_categ = $wise_inmeta_font ? wise_google_fonts('category', $wise_inmeta_font) : 'sans-serif';

        $wise_inmeta_inline_css = "input,
select,
textarea {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

input[type='text'],
input[type='email'],
input[type='url'],
input[type='password'],
input[type='search'],
textarea {
    font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

input[type='email'],
input[type='url'],
input[type='password'],
input[type='search'] {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
    font-weight: {$wise_inmeta_weight};
}

input[type='search'] {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.search-form2 input[type='search'] {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.entry-meta-popular,
.entry-meta-sub,
.entry-meta-subig {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.index-cat a{
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.entry-meta-index,
.entry-meta-index a {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.top-meta {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.top-meta-2 {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.comments-count,
.comments-count a {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.entry-meta {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.share-entry-meta {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.entry-content ol > li:before {
    font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

blockquote cite {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.entry-footer {
    font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.comment-metadata,
.comment-metadata a {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.comment-form textarea {
    font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.comment-form input {
    font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.wp-caption .wp-caption-text {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.gallery-caption {
    font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.subscribe-sidebar input[type='email'] {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.entry-content input[type='password'],
.entry-content input[type='text'] {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.subscribe-footer input[type='email'] {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

#breadcrumbs, #breadcrumbs .separator,
.bread-current {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
    font-weight: {$wise_inmeta_weight};
}

#bbpress-forums .bbp-forum-info .bbp-forum-content,
#bbpress-forums p.bbp-topic-meta {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.entry-content #bbpress-forums ol > li:before {
    font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
    font-weight: {$wise_inmeta_weight};
}

.entry-content .bbp-breadcrumb p {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.quotation-one cite {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.profile-single {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.widget_rss span.rss-date {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.subscribe-sidebar input[type='email'] {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.ctc-alignleft-side {
    font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.home-subs input[type='email'] {
    font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}";
        wp_add_inline_style( 'wise-style', $wise_inmeta_inline_css );
    }

    add_action( 'wp_enqueue_scripts', 'wise_inmeta_inline_styles' );

endif; // End if function_exists

/*--------------------------------------------------------------
4. Button Fonts
--------------------------------------------------------------*/
if( !function_exists('wise_button_inline_styles') ) :
    function wise_button_inline_styles() {
        $wise_button_font = get_theme_mod('wise_button_font') ? get_theme_mod('wise_button_font') : 'Open Sans';
        $wise_button_weight = get_theme_mod('wise_button_weight') ? get_theme_mod('wise_button_weight') : '600';
        $wise_button_categ = $wise_button_font ? wise_google_fonts('category', $wise_button_font) : 'sans-serif';

        $wise_button_inline_css = "a.button-1 {
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

a.button-2 {
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

a.button-orig {
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

button,
input[type='button'],
input[type='reset'],
input[type='submit'] {
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

#sc_chat_box .sc-chat-wrapper .sc-start-chat-btn > a {
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

.give-btn {
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce a.button-orig, .woocommerce button.button, .woocommerce input.button {
    font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

.comment-form input.submit {
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

.read-more {
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

.schat-form-btn {
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

div#schat-widget .schat-button {
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

a.button-3 {
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}";
        wp_add_inline_style( 'wise-style', $wise_button_inline_css );
    }

    add_action( 'wp_enqueue_scripts', 'wise_button_inline_styles' );

endif; // End if function_exists

/*--------------------------------------------------------------
5. Navigation Fonts
--------------------------------------------------------------*/
if( !function_exists('wise_navi_inline_styles') ) :
    function wise_navi_inline_styles() {
        $wise_navi_font = get_theme_mod('wise_navi_font') ? get_theme_mod('wise_navi_font') : 'Open Sans';
        $wise_navi_weight = get_theme_mod('wise_navi_weight') ? get_theme_mod('wise_navi_weight') : '600';
        $wise_navi_categ = $wise_navi_font ? wise_google_fonts('category', $wise_navi_font) : 'sans-serif';

        $wise_navi_inline_css = ".headhesive-tag-lines {
	font-family: '{$wise_navi_font}', {$wise_navi_categ};
	font-weight: {$wise_navi_weight};
}

.tag-lines {
	font-family: '{$wise_navi_font}', {$wise_navi_categ};
	font-weight: {$wise_navi_weight};
}

.header-login {
	font-family: '{$wise_navi_font}', {$wise_navi_categ};
	font-weight: {$wise_navi_weight};
}

.response-nav ul li {
	font-family: '{$wise_navi_font}', {$wise_navi_categ};
	font-weight: {$wise_navi_weight};
}

.headhesive-menu {
	font-family: '{$wise_navi_font}', {$wise_navi_categ};
	font-weight: {$wise_navi_weight};
}

.headhesive-social {
	font-family: '{$wise_navi_font}', {$wise_navi_categ};
	font-weight: {$wise_navi_weight};
}

.main-navigation {
	font-family: '{$wise_navi_font}', {$wise_navi_categ};
	font-weight: {$wise_navi_weight};
}

.site-main .comment-navigation,
.site-main .paging-navigation,
.site-main .post-navigation {
	font-family: '{$wise_navi_font}', {$wise_navi_categ};
	font-weight: {$wise_navi_weight};
}

.secondary-menu {
	font-family: '{$wise_navi_font}', {$wise_navi_categ};
	font-weight: {$wise_navi_weight};
}

.paging-navigation .current {
	font-family: '{$wise_navi_font}', {$wise_navi_categ};
	font-weight: {$wise_navi_weight};
}

.screen-reader-text:focus {
	font-family: '{$wise_navi_font}', {$wise_navi_categ};
	font-weight: {$wise_navi_weight};
}";
        wp_add_inline_style( 'wise-style', $wise_navi_inline_css );
    }

    add_action( 'wp_enqueue_scripts', 'wise_navi_inline_styles' );

endif; // End if function_exists

/*--------------------------------------------------------------
6. Description Fonts
--------------------------------------------------------------*/
if( !function_exists('wise_taxdesc_inline_styles') ) :
    function wise_taxdesc_inline_styles() {
        $wise_taxdesc_font = get_theme_mod('wise_taxdesc_font') ? get_theme_mod('wise_taxdesc_font') : 'Raleway';
        $wise_taxdesc_weight = get_theme_mod('wise_taxdesc_weight') ? get_theme_mod('wise_taxdesc_weight') : '400';
        $wise_taxdesc_categ = $wise_taxdesc_font ? wise_google_fonts('category', $wise_taxdesc_font) : 'sans-serif';

        $wise_taxdesc_inline_css = ".taxonomy-description p {
	font-family: '{$wise_taxdesc_font}', {$wise_taxdesc_categ};
	font-weight: {$wise_taxdesc_weight};
}

.term-description p {
	font-family: '{$wise_taxdesc_font}', {$wise_taxdesc_categ};
    font-weight: {$wise_taxdesc_weight};
}

.welcome-message p,
.welcome-message-down p {
	font-family: '{$wise_taxdesc_font}', {$wise_taxdesc_categ};
	font-weight: {$wise_taxdesc_weight};
}

.quotation-one p {
	font-family: '{$wise_taxdesc_font}', {$wise_taxdesc_categ};
	font-weight: {$wise_taxdesc_weight};
}

.tab-sermon .tab-content .ctf-audio span.ctf-audio-title {
    font-family: '{$wise_taxdesc_font}', {$wise_taxdesc_categ};
    font-weight: {$wise_taxdesc_weight};
}

.wise-error-message {
	font-family: '{$wise_taxdesc_font}', {$wise_taxdesc_categ};
	font-weight: {$wise_taxdesc_weight};
}

.our-pastor-message {
	font-family: '{$wise_taxdesc_font}', {$wise_taxdesc_categ};
	font-weight: {$wise_taxdesc_weight};
}

.wise-subs-title p {
	font-family: '{$wise_taxdesc_font}', {$wise_taxdesc_categ};
	font-weight: {$wise_taxdesc_weight};
}";
        wp_add_inline_style( 'wise-style', $wise_taxdesc_inline_css );
    }

    add_action( 'wp_enqueue_scripts', 'wise_taxdesc_inline_styles' );

endif; // End if function_exists