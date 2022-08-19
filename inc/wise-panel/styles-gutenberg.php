<?php
/*
* Wise Gutenberg Editor Styles
*
*/

/*--------------------------------------------------------------
-----TABLE OF CONTENTS------------------------------------------
----------------------------------------------------------------
1. Google Fonts and FontAwesome
2. Heading Fonts
3. Body Fonts
4. Input and Meta Fonts
5. Button Fonts
6. Content Editor Fix
--------------------------------------------------------------*/

/*--------------------------------------------------------------
1. Google Fonts and FontAwesome
--------------------------------------------------------------*/
if( !function_exists('wise_gfonts_gutenberg_styles') ) :
	function wise_gfonts_gutenberg_styles() {
		$wise_google_fonts_settings = function_exists('wise_google_fonts_settings') ? wise_google_fonts_settings() : null;
		$wise_font_awesome = get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css';

		wp_enqueue_style( 'wise-google-fonts', $wise_google_fonts_settings, false, null, 'all' );
		wp_enqueue_style ( 'font-awesome', $wise_font_awesome );
	}

	add_action( 'enqueue_block_editor_assets', 'wise_gfonts_gutenberg_styles' );

endif; // End if function_exists

/*--------------------------------------------------------------
2. Heading Fonts
--------------------------------------------------------------*/
if( !function_exists('wise_heading_gutenberg_styles') ) :
    function wise_heading_gutenberg_styles() {
        $wise_heading_font = !empty( get_theme_mod('wise_heading_font') ) ? get_theme_mod('wise_heading_font') : 'Roboto';
        $wise_big_heading_weight = !empty( get_theme_mod('wise_big_heading_weight') ) ? get_theme_mod('wise_big_heading_weight') : '700';
        $wise_gen_heading_weight = !empty( get_theme_mod('wise_gen_heading_weight') ) ? get_theme_mod('wise_gen_heading_weight') : '500';
        $wise_other_heading_weight = !empty( get_theme_mod('wise_other_heading_weight') ) ? get_theme_mod('wise_other_heading_weight') : '400';
        $wise_heading_categ = $wise_heading_font ? wise_google_fonts('category', $wise_heading_font) : 'sans-serif';
        
		$wise_heading_gutenberg_css = ".editor-post-title__block .editor-post-title__input {
	font-family: '{$wise_heading_font}', {$wise_heading_categ};
	font-weight: {$wise_gen_heading_weight};
	font-size: 2em;
}

.editor-styles-wrapper .mce-content-body h1,
.editor-styles-wrapper .mce-content-body h2,
.editor-styles-wrapper .mce-content-body h3,
.editor-styles-wrapper .mce-content-body h4,
.editor-styles-wrapper .mce-content-body h5,
.editor-styles-wrapper .mce-content-body h6,
.wp-block h1,
.wp-block h2,
.wp-block h3,
.wp-block h4,
.wp-block h5,
.wp-block h6 {
	font-family: '{$wise_heading_font}', {$wise_heading_categ};
    font-weight: {$wise_gen_heading_weight};
    margin-top: .5em;
    margin-bottom: .5em;
    color: #333232;
}

.editor-styles-wrapper .mce-content-body h1,
.editor-styles-wrapper .mce-content-body h2,
.editor-styles-wrapper .mce-content-body h3,
.editor-styles-wrapper .mce-content-body h4,
.editor-styles-wrapper .mce-content-body h5,
.editor-styles-wrapper .mce-content-body h6 {
	margin-top: .5em;
	margin-bottom: .5em;
}

.editor-styles-wrapper .mce-content-body h1 {
    font-size: 32px;
	font-size: 2rem;
}

.editor-styles-wrapper .mce-content-body h2 {
    font-size: 28px;
	font-size: 1.75rem;
}

.editor-styles-wrapper .mce-content-body h3 {
    font-size: 26px;
    font-size: 1.625rem;
}

.editor-styles-wrapper .mce-content-body h4 {
    font-size: 24px;
    font-size: 1.5rem;
}

.editor-styles-wrapper .mce-content-body h5 {
    font-size: 22px;
    font-size: 1.375rem;
}

.editor-styles-wrapper .mce-content-body h6 {
    font-size: 20px;
    font-size: 1.25rem;
}
";		
		wp_add_inline_style( 'wise-style', $wise_heading_gutenberg_css );

		wp_register_style( 'wise-gutenberg', false );
		wp_enqueue_style( 'wise-gutenberg' );
		wp_add_inline_style( 'wise-gutenberg',  $wise_heading_gutenberg_css );
    }

	add_action( 'enqueue_block_editor_assets', 'wise_heading_gutenberg_styles', 998 );

endif; // End if function_exists

/*--------------------------------------------------------------
3. Body Fonts
--------------------------------------------------------------*/
if( !function_exists('wise_bodycont_gutenberg_styles') ) :
    function wise_bodycont_gutenberg_styles() {
        $wise_bodycont_font = get_theme_mod('wise_bodycont_font') ? get_theme_mod('wise_bodycont_font') : 'Open Sans';
        $wise_bodycont_weight = get_theme_mod('wise_bodycont_weight') ? get_theme_mod('wise_bodycont_weight') : '400';
        $wise_bodycont_categ = $wise_bodycont_font ? wise_google_fonts('category', $wise_bodycont_font) : 'sans-serif';
        $wise_textcolor = get_theme_mod('wise_text_color') ? get_theme_mod('wise_text_color') : '#3a90fd';

        $wise_bodycont_gutenberg_css = ".editor-styles-wrapper p {
    margin-top: 1em;
}

.wp-block-freeform.block-library-rich-text__tinymce li, 
.wp-block-freeform.block-library-rich-text__tinymce p {
    line-height: 1.7;
}
        
.editor-styles-wrapper .mce-content-body,
.wp-block[data-type='core/paragraph'],
.wp-block[data-type='core/list'],
.cf-block__preview,
.editor-styles-wrapper p.rich-text,
.editor-styles-wrapper table .rich-text {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ} !important;
	font-weight: {$wise_bodycont_weight} !important;
	color: #555 !important;
	font-size: 15px !important;
}

.editor-styles-wrapper .mce-content-body p,
.wp-block[data-type='core/paragraph'] p,
.cf-block__preview p {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ} !important;
    font-weight: {$wise_bodycont_weight};
    margin-top: 1em;
    margin-bottom: 1em;
}

.editor-styles-wrapper .mce-content-body blockquote,
.editor-styles-wrapper .wp-block blockquote {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ} !important;
	font-weight: {$wise_bodycont_weight};
}

.wp-block-freeform.block-library-rich-text__tinymce blockquote {
    margin: 0;
    box-shadow: none;
    border-left: none;
    padding-left: 1em;
}

.editor-styles-wrapper .mce-content-body blockquote:before,
.editor-styles-wrapper .mce-content-body blockquote:after,
.editor-styles-wrapper .wp-block blockquote:before,
.editor-styles-wrapper .wp-block blockquote:after {
	content: '';
}

.editor-styles-wrapper .mce-content-body blockquote,
.editor-styles-wrapper .wp-block blockquote {
	quotes: '' '';
}

.editor-styles-wrapper .mce-content-body blockquote p,
.editor-styles-wrapper .wp-block blockquote p,
.editor-styles-wrapper .wp-block blockquote {
	font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ} !important;
	font-weight: {$wise_bodycont_weight};
	font-size: 19px;
	font-size: 1.188rem;
	line-height: 1.5em;
	display: block;
	margin: 1em 0 .5em;
}

.editor-styles-wrapper .mce-content-body blockquote,
.editor-styles-wrapper .wp-block blockquote {
	font-style: italic;
	padding: .5em 3em 0;
	background: transparent;
	display: block;
	margin: 0;
	overflow: hidden;
	box-sizing: border-box;
}

.editor-styles-wrapper .mce-content-body blockquote p:before,
.editor-styles-wrapper .wp-block blockquote p:before {
	content: '\\f10d';
	font-family: 'Fontawesome';
	font-size: 24px;
	font-size: 1.5rem;
	display: inline-block;
	padding-right: 10px;
    color: {$wise_textcolor};
	position: relative;
}

.editor-styles-wrapper .mce-content-body blockquote em,
.editor-styles-wrapper .wp-block blockquote em {
	font-style: normal;
}

.editor-styles-wrapper .mce-content-body blockquote.alignleft,
.editor-styles-wrapper .wp-block blockquote.alignleft {
	display: block;
	float: left;
	width: 50%;
	padding: 0 1em 0 2.8em;
	margin-right: 1.5em;
	margin-bottom: 0;
}

.editor-styles-wrapper .mce-content-body blockquote.alignright,
.editor-styles-wrapper .wp-block blockquote.alignright {
	width: 50%;
	float: right;
	padding: 0 1em 0 2.8em;
	margin-left: 1.5em;
	display: block;
}

.editor-styles-wrapper .wp-block-pullquote {
    border-top: none;
    border-bottom: none;
    margin-bottom: 0;
    color: #555;
}

.editor-styles-wrapper .wp-block-pullquote {
    padding: .5em 3em 0;
    margin-left: 0;
    margin-right: 0;
    text-align: center;
}

.editor-styles-wrapper .mce-content-body .wp-block-quote,
.wp-block .wp-block-quote {
	border: none;
}

.editor-styles-wrapper .mce-content-body table,
.editor-styles-wrapper .wp-block-table table {
	margin: 0 0 1.5em;
	width: 100%;
    border-collapse: collapse;
	border-spacing: 0;
    border: 1px solid #eee;
    font-size: 15px;
}
 
.editor-styles-wrapper .mce-content-body .mce-item-table td, 
.editor-styles-wrapper .mce-content-body .mce-item-table th, 
.editor-styles-wrapper .mce-content-body .mce-item-table caption,
.editor-styles-wrapper .wp-block-table .mce-item-table td, 
.editor-styles-wrapper .wp-block-table .mce-item-table th, 
.editor-styles-wrapper .wp-block-table .mce-item-table caption {
    border: 1px solid #eee !important;
}

.editor-styles-wrapper .mce-content-body th,
.editor-styles-wrapper .wp-block-table th {
    background: #f7f7f7;
    text-align: left;
    font-weight: 600;
}

.editor-styles-wrapper .mce-content-body td,
.editor-styles-wrapper .mce-content-body th,
.editor-styles-wrapper .wp-block-table td,
.editor-styles-wrapper .wp-block-table th {
	padding: .5em;
	border: 1px solid #ddd;
}

.editor-styles-wrapper .mce-content-body .alignleft {
	display: block;
	float: left;
	padding-top: .5em !important;
	margin-right: 1.5em !important;
	padding-bottom: .5em !important;
	text-align: left;
}

.editor-styles-wrapper .mce-content-body .alignright {
	display: block;
	float: right;
	padding-top: .5em !important;
	margin-left: 1.5em !important;
	padding-bottom: .5em !important;
	text-align: right;
}

.editor-styles-wrapper .mce-content-body .aligncenter {
	clear: both;
	display: block !important;
	margin-left: auto;
	margin-right: auto;
	text-align: center;
}

.editor-styles-wrapper .alignleft,
.editor-styles-wrapper .has-text-align-left {
	display: block;
	float: left;
	padding-top: .5em;
	margin-right: 1.5em;
	padding-bottom: .5em;
	text-align: left;
}

.editor-styles-wrapper .alignright,
.editor-styles-wrapper .has-text-align-right {
	display: block;
	float: right;
	padding-top: .5em;
	margin-left: 1.5em;
	padding-bottom: .5em;
	text-align: right;
}

.editor-styles-wrapper .aligncenter,
.editor-styles-wrapper .has-text-align-center {
	clear: both;
	display: block !important;
	margin-left: auto;
	margin-right: auto;
	text-align: center;
}

.editor-styles-wrapper .mce-content-body pre,
.editor-styles-wrapper .wp-block-code,
.editor-styles-wrapper pre.wp-block-verse,
.editor-styles-wrapper pre {
    background: #f7f7f7;
    font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
    font-size: 15px;
    font-size: 0.9375rem;
    line-height: 1.6;
    margin-bottom: 1.6em;
    max-width: 100%;
    overflow: auto;
    padding: 1.6em;
    border: 1px solid #eee;
    box-shadow: none !important;
    white-space: pre-wrap;
}

.editor-styles-wrapper .wp-block-code .block-editor-plain-text {
    font-size: 15px;
    font-size: 0.9375rem;
    background: transparent;
    border-radius: 0;
}

.wp-block-freeform.block-library-rich-text__tinymce code{
    background: transparent;
}

.editor-styles-wrapper .wp-block ul.rich-text, 
.editor-styles-wrapper .wp-block ol.rich-text {
    margin: 0 0 1.5em 2em;
}

.editor-styles-wrapper .mce-content-body p,
.editor-styles-wrapper .mce-content-body ul {
    font-size: 15px;
	font-size: 0.9375rem;
    line-height: 1.7;
}

.editor-styles-wrapper .mce-content-body-index p,
.editor-styles-wrapper .mce-content-body-index ul,
.editor-styles-wrapper .mce-content-body-index ol,
.editor-styles-wrapper .wp-block ol.rich-text {
    font-size: 15px;
	font-size: 0.9375rem;
    line-height: 1.7;
	display: block;
}

.editor-styles-wrapper .mce-content-body ol,
.editor-styles-wrapper .wp-block ol.rich-text {
    counter-reset: li;
    margin-left: 0;
    padding-left: 0;
}

.editor-styles-wrapper .mce-content-body li img,
.editor-styles-wrapper .wp-block li img {
	padding-top: 1em;
}

.editor-styles-wrapper .mce-content-body ol > li,
.editor-styles-wrapper .wp-block ol.rich-text > li {
	position: relative;
    margin: .7em 0 6px 2em;
    padding: 4px 8px;
    list-style: decimal;
    background: transparent;
}

.editor-styles-wrapper .mce-content-body ol > li:before,
.editor-styles-wrapper .wp-block ol.rich-text > li:before {
	content: counter(li);
    counter-increment: li;
    position: absolute;
	top: 0;
    left: -2em;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    width: 2em;
    margin-right: 8px;
    padding: 4px 0;
    color: #ffffff;
    background: #ccc;
    font-family: 'Ubuntu', sans-serif;
	font-weight: 400;
    font-size: 17px;
    text-align: center;
	border-radius: 1em;
	line-height: 26px;
}

.editor-styles-wrapper .mce-content-body ol#alps > li:before,
.editor-styles-wrapper .mce-content-body ol#roms > li:before,
.editor-styles-wrapper .mce-content-body ol#decs > li:before,
.editor-styles-wrapper .mce-content-body ol#lowalps > li:before,
.editor-styles-wrapper .mce-content-body ol#lowroms > li:before,
.editor-styles-wrapper .mce-content-body ol#decszero > li:before {
	display: none;
}

.editor-styles-wrapper .mce-content-body ol#alps > li {
	list-style-type: upper-alpha;
}

.editor-styles-wrapper .mce-content-body ol#roms > li {
	list-style-type: upper-roman;
}

.editor-styles-wrapper .mce-content-body ol#decs > li {
	list-style-type: decimal;
}

.editor-styles-wrapper .mce-content-body ol#lowalps > li {
	list-style-type: lower-alpha;
}

.editor-styles-wrapper .mce-content-body ol#lowroms > li {
	list-style-type: lower-roman;
}

.editor-styles-wrapper .mce-content-body ol#decszero > li {
	list-style-type: decimal-leading-zero;
}

.editor-styles-wrapper .mce-content-body li ol {
	margin-top: 6px;
}

.editor-styles-wrapper .mce-content-body ol ol li:last-child {
	margin-bottom: 0;
}

.editor-styles-wrapper .mce-content-body a,
.editor-styles-wrapper .rich-text a {
	text-decoration: none;
    color: {$wise_textcolor};
    cursor: pointer;
}

.editor-styles-wrapper .mce-content-body a:hover,
.editor-styles-wrapper .rich-text a:hover {
	text-decoration: underline;
}";
		wp_register_style( 'wise-gutenberg', false );
		wp_enqueue_style( 'wise-gutenberg' );
		wp_add_inline_style( 'wise-gutenberg',  $wise_bodycont_gutenberg_css );
    }

    add_action( 'enqueue_block_editor_assets', 'wise_bodycont_gutenberg_styles', 998 );

endif; // End if function_exists

/*--------------------------------------------------------------
4. Input and Meta Fonts
--------------------------------------------------------------*/
if( !function_exists('wise_inmeta_gutenberg_styles') ) :
    function wise_inmeta_gutenberg_styles() {
        $wise_inmeta_font = get_theme_mod('wise_inmeta_font') ? get_theme_mod('wise_inmeta_font') : 'Ubuntu';
        $wise_inmeta_weight = get_theme_mod('wise_inmeta_weight') ? get_theme_mod('wise_inmeta_weight') : '400';
        $wise_inmeta_categ = $wise_inmeta_font ? wise_google_fonts('category', $wise_inmeta_font) : 'sans-serif';

        $wise_inmeta_gutenberg_css = ".editor-styles-wrapper .mce-content-body input,
.editor-styles-wrapper .mce-content-body select,
.editor-styles-wrapper .mce-content-body textarea {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.editor-styles-wrapper .mce-content-body input[type='text'],
.editor-styles-wrapper .mce-content-body input[type='email'],
.editor-styles-wrapper .mce-content-body input[type='url'],
.editor-styles-wrapper .mce-content-body input[type='password'],
.editor-styles-wrapper .mce-content-body input[type='search'],
.editor-styles-wrapper .mce-content-body textarea {
    font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.editor-styles-wrapper .mce-content-body input[type='email'],
.editor-styles-wrapper .mce-content-body input[type='url'],
.editor-styles-wrapper .mce-content-body input[type='password'],
.editor-styles-wrapper .mce-content-body input[type='search'] {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
    font-weight: {$wise_inmeta_weight};
}

.editor-styles-wrapper .mce-content-body input[type='search'] {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.editor-styles-wrapper .mce-content-body .wp-caption .wp-caption-text {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.editor-styles-wrapper .mce-content-body .gallery-caption {
    font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.editor-styles-wrapper .mce-content-body .editor-styles-wrapper .mce-content-body input[type='password'],
.editor-styles-wrapper .mce-content-body .editor-styles-wrapper .mce-content-body input[type='text'] {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.editor-styles-wrapper .mce-content-body blockquote cite,
.editor-styles-wrapper .wp-block-quote__citation, 
.editor-styles-wrapper .wp-block-quote cite, 
.editor-styles-wrapper .wp-block-pullquote cite, 
.editor-styles-wrapper .wp-block-quote footer,
.editor-styles-wrapper .wp-block-pullquote__citation, 
.editor-styles-wrapper .wp-block-pullquote cite, 
.editor-styles-wrapper .wp-block-pullquote footer {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
    font-weight: {$wise_inmeta_weight};
    text-transform: none;
	display: block;
	font-size: 80%;
	float: right;
	font-style: normal;
	margin-left: 30%;
	line-height: 1.5em;
	margin-top: 1em;
	margin-bottom: 1em;
    margin-right: 1em;
    color: #555;
}

.editor-styles-wrapper .mce-content-body .quotation-one cite {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

.editor-styles-wrapper .wp-block-freeform.block-library-rich-text__tinymce dl.wp-caption .wp-caption-dd {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
	text-align: center;
	padding: 10px 0;
	font-size: 13px;
	font-style: italic;
	background: transparent;
}

.editor-styles-wrapper .wp-block-table figcaption {
    font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
    padding: 0;
    margin-top: -.5em;
	font-size: 13px;
	font-style: italic;
	background: transparent;
}";
		wp_register_style( 'wise-gutenberg', false );
		wp_enqueue_style( 'wise-gutenberg' );
		wp_add_inline_style( 'wise-gutenberg',  $wise_inmeta_gutenberg_css );
    }

    add_action( 'enqueue_block_editor_assets', 'wise_inmeta_gutenberg_styles' );

endif; // End if function_exists

/*--------------------------------------------------------------
5. Button Fonts
--------------------------------------------------------------*/
if( !function_exists('wise_button_gutenberg_styles') ) :
    function wise_button_gutenberg_styles() {
        $wise_button_font = get_theme_mod('wise_button_font') ? get_theme_mod('wise_button_font') : 'Open Sans';
        $wise_button_weight = get_theme_mod('wise_button_weight') ? get_theme_mod('wise_button_weight') : '600';
        $wise_button_categ = $wise_button_font ? wise_google_fonts('category', $wise_button_font) : 'sans-serif';

        $wise_button_gutenberg_css = ".editor-styles-wrapper .mce-content-body .button-single {
	width: 100%;
	display: block;
	position: relative;
}

.editor-styles-wrapper .mce-content-body .butones {
	margin: 10px 10px;
}

.editor-styles-wrapper .mce-content-body a.button-1,
.cf-block__preview a.button-1 {
	padding: 9px 20px;
	font-size: 15px;
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
	color: #000;
	background: #ffffff;
	border: 4px solid #434343;
	text-transform: uppercase;
	text-decoration: none !important;
}

.editor-styles-wrapper .mce-content-body a.button-1:hover,
.editor-styles-wrapper .mce-content-body a.button-1:active,
.editor-styles-wrapper .mce-content-body a.button-1:focus,
.cf-block__preview a.button-1:hover,
.cf-block__preview a.button-1:active,
.cf-block__preview a.button-1:focus {
	color: #434343 !important;
	background: #ccc;
}

.editor-styles-wrapper .mce-content-body a.button-2 {
	padding: 9px 20px;
	font-size: 15px;
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
	color: #ffffff;
	background: none;
	border: 2px solid #ffffff;
	text-transform: uppercase;
	text-decoration: none !important;
}

.editor-styles-wrapper .mce-content-body a.button-2:hover,
.editor-styles-wrapper .mce-content-body a.button-2:active,
.editor-styles-wrapper .mce-content-body a.button-2:focus {
	color: #ffffff;
	background: #222;
}

.editor-styles-wrapper .mce-content-body a.button-orig {
	padding: 9px 20px;
	font-size: 15px;
	font-size: 0.9375rem;
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
	text-transform: uppercase;
	text-decoration: none !important;
	line-height: 1;
	color: #ffffff;
	background: #434343;
	border: none;
	cursor: pointer;
	-webkit-transition: all 0.7s ease-out 0s;
	-moz-transition: all 0.7s ease-out 0s;
	transition: all 0.7s ease-out 0s;
}

.editor-styles-wrapper .mce-content-body a.button-orig:hover,
.editor-styles-wrapper .mce-content-body a.button-orig:active,
.editor-styles-wrapper .mce-content-body a.button-orig:focus {
	color: #ffffff;
	background: #222;
}

.editor-styles-wrapper .mce-content-body button,
.editor-styles-wrapper .mce-content-body input[type='button'],
.editor-styles-wrapper .mce-content-body input[type='reset'],
.editor-styles-wrapper .mce-content-body input[type='submit'] {
	padding: 11px 20px;
	font-size: 15px;
	font-size: 0.9375rem;
	font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
	text-transform: uppercase;
	line-height: 1.1;
	color: #ffffff;
	background: #434343;
	border: none;
	cursor: pointer;
	-webkit-appearance: button;
	-webkit-transition: all 0.7s ease-out 0s;
	-moz-transition: all 0.7s ease-out 0s;
	transition: all 0.7s ease-out 0s;
}

.editor-styles-wrapper .mce-content-body button:hover,
.editor-styles-wrapper .mce-content-body input[type='button']:hover,
.editor-styles-wrapper .mce-content-body input[type='reset']:hover,
.editor-styles-wrapper .mce-content-body input[type='submit']:hover {
	background: #222;
}

.editor-styles-wrapper .mce-content-body button:focus,
.editor-styles-wrapper .mce-content-body input[type='button']:focus,
.editor-styles-wrapper .mce-content-body input[type='reset']:focus,
.editor-styles-wrapper .mce-content-body input[type='submit']:focus,
.editor-styles-wrapper .mce-content-body button:active,
.editor-styles-wrapper .mce-content-body input[type='button']:active,
.editor-styles-wrapper .mce-content-body input[type='reset']:active,
.editor-styles-wrapper .mce-content-body input[type='submit']:active {
	outline: none;
}";
		wp_register_style( 'wise-gutenberg', false );
		wp_enqueue_style( 'wise-gutenberg' );
		wp_add_inline_style( 'wise-gutenberg',  $wise_button_gutenberg_css );
    }

    add_action( 'enqueue_block_editor_assets', 'wise_button_gutenberg_styles' );

endif; // End if function_exists

/*--------------------------------------------------------------
6. Content Editor Fix
--------------------------------------------------------------*/
if( !function_exists('wise_fix_gutenberg_styles') ) :
	function wise_fix_gutenberg_styles() {
        $wise_fix_gutenberg_css = ".components-panel__body .components-button {
    margin: auto;
}

/* Main Blocks */
.wp-block {
    max-width: 730px;
}
 
/* Wide Blocks */
.wp-block[data-align='wide'] {
    max-width: 1110px;
}
 
/* Full-wide Blocks */
.wp-block[data-align='full'] {
    max-width: none;
}";
	wp_register_style( 'wise-gutenberg', false );
	wp_enqueue_style( 'wise-gutenberg' );
	wp_add_inline_style( 'wise-gutenberg',  $wise_fix_gutenberg_css );
	}

	add_action( 'enqueue_block_editor_assets', 'wise_fix_gutenberg_styles' );

endif; // End if function_exists