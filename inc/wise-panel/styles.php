<?php
/*
* Custom Inline Styles
*
*/

/*--------------------------------------------------------------
-----TABLE OF CONTENTS------------------------------------------
----------------------------------------------------------------
1. Main Background Fix
2. Header, Sticky Header and Footer Opacity
3. Color Customizations
4. Preloader
5. Author Link
--------------------------------------------------------------*/

/*--------------------------------------------------------------
1. Main Background Fix
--------------------------------------------------------------*/
function wise_back_inline_styles() {
    $wise_main_back = get_theme_mod('wise_mainback');
    $wise_def_back = get_template_directory_uri() . '/img/background.jpg';
    if(get_theme_mod('wise_disable_back') == true) {
        $wise_body_back = 'none';
    } else {
        $wise_body_back = !empty($wise_main_back) ? $wise_main_back : $wise_def_back;
    }
    
    if( !empty($wise_body_back) && (get_theme_mod('wise_disable_back') == false) ) :
        $wise_back_inline_css = "body {
    background-image: url({$wise_body_back});
}";		
        wp_add_inline_style( 'wise-style', $wise_back_inline_css );
    endif;
}
add_action( 'wp_enqueue_scripts', 'wise_back_inline_styles' );

/*--------------------------------------------------------------
2. Header, Sticky Header and Footer Opacity
--------------------------------------------------------------*/
function wise_inline_styles() {
    $headhesive_opacity = get_theme_mod('wise_headhesive_opacity');
    $headhesive_opacity = !empty($headhesive_opacity) ? $headhesive_opacity : '.95';
    $head_opacity = get_theme_mod('wise_head_opacity');
    $head_opacity = !empty($head_opacity) ? $head_opacity : '.95';
    $footer_opacity = get_theme_mod('wise_footer_opacity');
    $footer_opacity = !empty($footer_opacity) ? $footer_opacity : '.95';
    
    if( !empty($headhesive_opacity) || !empty($head_opacity) || !empty($footer_opacity) ) :
        $wise_inline_css = ".headhesive {
    background-color: rgba( 255, 255, 255, {$headhesive_opacity} );
}

.header-wrapper {
    background-color: rgba( 255, 255, 255, {$head_opacity} );
}

.footer-wrapper {
    background-color: rgba( 46, 46, 46, {$footer_opacity} );
}";		
        wp_add_inline_style( 'wise-style', $wise_inline_css );
    endif;
}
add_action( 'wp_enqueue_scripts', 'wise_inline_styles' );

/*--------------------------------------------------------------
3. Color Customizations
--------------------------------------------------------------*/
// Header Lines
function wise_headlinecolor_inline_styles() {
	$wise_headlinecolor = get_theme_mod('wise_hline_color');
	
	if( !empty($wise_headlinecolor) ) :
		$wise_headlinecolor_inline_css = ".header-wrapper {
    border-bottom: 9px solid {$wise_headlinecolor};
}

.headhesive {
    border-bottom: 5px solid {$wise_headlinecolor};
}";		
		wp_add_inline_style( 'wise-style', $wise_headlinecolor_inline_css );
	endif;
}
add_action( 'wp_enqueue_scripts', 'wise_headlinecolor_inline_styles' );

// Button Colors
function wise_buttoncolor_inline_styles() {
	$wise_buttoncolor = get_theme_mod('wise_button_color');
	
	if( !empty($wise_buttoncolor) ) :
		$wise_buttoncolor_inline_css = "a.button-2:hover,
a.button-2:active,
a.button-2:focus {
	background: {$wise_buttoncolor};
}

a.button-orig:hover,
a.button-orig:active,
a.button-orig:focus {
	background: {$wise_buttoncolor};
}

button:hover,
input[type='button']:hover,
input[type='reset']:hover,
input[type='submit']:hover {
	background: {$wise_buttoncolor};
}

.res-button a:hover,
.res-button a.active,
.res-button a:visited,
.res-button-top a:hover,
.res-button-top a.active,
.res-button-top a:visited {
        color: {$wise_buttoncolor};
}

.search-icon2 a:hover, 
.search-icon2 a.active {
	background: {$wise_buttoncolor};
}

.cd-top:hover {
	background-color: {$wise_buttoncolor};
}

.no-touch .cd-top:hover {
	background-color: {$wise_buttoncolor};
}

#sc_chat_box .sc-chat-wrapper .sc-start-chat-btn > a:hover {
	background-color: {$wise_buttoncolor};
}

.bbp-login-form .bbp-login-links a:hover {
	color: {$wise_buttoncolor};
}

#bbpress-forums a:hover {
	color: {$wise_buttoncolor};
}

.bbp-login-form .bbp-login-links a:hover {
	color: {$wise_buttoncolor};
}

.woocommerce #respond input#submit:hover, 
.woocommerce a.button:hover, 
.woocommerce button.button:hover, 
.woocommerce input.button:hover {
	background: {$wise_buttoncolor};
}

.index-cart:hover {
	background: {$wise_buttoncolor};
}

.woocommerce span.onsale {
	background-color: {$wise_buttoncolor};
}

.woocommerce span.onsale:after {
	border-left: 14px solid {$wise_buttoncolor};
}

.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover {
	background-color: {$wise_buttoncolor};
}

.woocommerce #respond input#submit.disabled, .woocommerce #respond input#submit:disabled, .woocommerce #respond input#submit:disabled[disabled], .woocommerce a.button.disabled, .woocommerce a.button:disabled, .woocommerce a.button:disabled[disabled], .woocommerce button.button.disabled, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled], .woocommerce input.button.disabled, .woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled] {
	background-color: {$wise_buttoncolor};
}

.ctc-alignleft-side {
	background: {$wise_buttoncolor};
}
			
.woocommerce div.product .woocommerce-tabs ul.tabs li.active {
	background-color: {$wise_buttoncolor} !important;
}

.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover {
	color: {$wise_buttoncolor};
}

div#schat-widget .schat-button.schat-primary:hover {
	background-color: {$wise_buttoncolor} !important;
}

div#schat-widget .schat-popup a.schat-button:hover {
	background: {$wise_buttoncolor} !important;
}

.page-numbers a.next,
.page-numbers span.next {
	background: {$wise_buttoncolor};
}

.page-numbers a.next:after,
.page-numbers span.next:after {
	border-left: 10px solid {$wise_buttoncolor};
}

.paging-navigation .current {
	color: {$wise_buttoncolor};
}

.feat-home-index-thumb .index-cat {
	background: {$wise_buttoncolor};
}

.search-iconhead a:hover, 
.search-iconhead a.active {
	background: {$wise_buttoncolor};
}

.search-top a:hover, 
.search-top a.active {
	background: {$wise_buttoncolor};
}";		
		wp_add_inline_style( 'wise-style', $wise_buttoncolor_inline_css );
	endif;
}
add_action( 'wp_enqueue_scripts', 'wise_buttoncolor_inline_styles' );

// Tabs Colors
function wise_tabscolor_inline_styles() {
	$wise_tabscolor = get_theme_mod('wise_tabs_color');
	
	if( !empty($wise_tabscolor) ) :
		$wise_tabscolor_inline_css = ".nav-pills > li.active > a,
.nav-pills > li.active > a:hover,
.nav-pills > li.active > a:focus {
	color: {$wise_tabscolor};
}

.nav-pills > li > a:hover {
	color: {$wise_tabscolor} !important;
}
.wise-tabs .ui-state-active a,
.wise-tabs .ui-state-active a:link,
.wise-tabs .ui-state-active a:visited {
	color: {$wise_tabscolor};
}

.wise-tabs .ui-state-active,
.wise-tabs .ui-widget-content .ui-state-active,
.wise-tabs .ui-widget-header .ui-state-active,
.wise-tabs a.ui-button:active,
.wise-tabs .ui-button:active,
.wise-tabs .ui-button.ui-state-active:hover {
	border: 4px solid {$wise_tabscolor};
	color: {$wise_tabscolor};
}

.wise-tabs ul li a:hover,
.wise-tabs .tab-sermon ul li a:hover,
.wise-tabs .tab-sermon .ctc-home-tabs > li.active > a:hover {
	color: {$wise_tabscolor};
}";		
		wp_add_inline_style( 'wise-style', $wise_tabscolor_inline_css );
	endif;
}
add_action( 'wp_enqueue_scripts', 'wise_tabscolor_inline_styles' );

// Text Colors
function wise_textcolor_inline_styles() {
	$wise_textcolor = get_theme_mod('wise_text_color');
	
	if( !empty($wise_textcolor) ) :
		$wise_textcolor_inline_css = ".login-top a:hover {
    color: {$wise_textcolor};
}

.tag-span {
    color: {$wise_textcolor};
}

.headhesive-menu li:hover > a,
.headhesive-menu li.focus > a {
    color: {$wise_textcolor};
}

.headhesive-menu .sf-arrows > li > .sf-with-ul:focus:after,
.headhesive-menu .sf-arrows > li:hover > .sf-with-ul:after,
.headhesive-menu .sf-arrows > .sfHover > .sf-with-ul:after {
    border-top-color: {$wise_textcolor};
}

.headhesive-tag-lines a:hover {
    color: {$wise_textcolor};
}

.headhesive-social a:hover,
.headhesive-social a.active {
    color: {$wise_textcolor};
}

a:hover,
a:active {
    color: {$wise_textcolor};
}

.main-navigation li:hover > a,
.main-navigation li.focus > a {
    color: {$wise_textcolor};
}

.main-navigation .sf-arrows > li > .sf-with-ul:focus:after,
.main-navigation .sf-arrows > li:hover > .sf-with-ul:after,
.main-navigation .sf-arrows > .sfHover > .sf-with-ul:after {
    border-top-color: {$wise_textcolor};
}

.secondary-menu li:hover > a,
.secondary-menu li.focus > a {
    color: {$wise_textcolor};
}

.secondary-menu .sf-arrows > li > .sf-with-ul:focus:after,
.secondary-menu .sf-arrows > li:hover > .sf-with-ul:after,
.secondary-menu .sf-arrows > .sfHover > .sf-with-ul:after {
    border-top-color: {$wise_textcolor};
}

.widget a:hover,
.widget li a:hover {
    color: {$wise_textcolor};
}

.read-more:hover {
    color: {$wise_textcolor} !important;
}

.entry-title-index a:hover {
    color: {$wise_textcolor};
}

.entry-title-index-feat a:hover {
    color: {$wise_textcolor};
}

.entry-title-index-grid a:hover {
    color: {$wise_textcolor};
}

.top-meta a {
    color: {$wise_textcolor};
}

.comments-count,
.comments-count a {
    color: {$wise_textcolor};
}

.entry-title a:hover {
    color: {$wise_textcolor};
}

.entry-content a {
    color: {$wise_textcolor};
}

.post-pagination a,
.post-pagination span {
    color: #ffffff;
    background: {$wise_textcolor};
}

blockquote p:before{
    color: {$wise_textcolor};
}

.related-wise-post-thumb a:hover {
    color: {$wise_textcolor};
}

.custom-posts ul li a h4:hover {
    color: {$wise_textcolor};
}

a.default-url:hover {
    color: {$wise_textcolor};
}

.top-meta-2 a {
    color: {$wise_textcolor};
}

.config-please a:hover {
    color: {$wise_textcolor};
}

.complex-titles a > .page-title:hover {
    color: {$wise_textcolor};
}

.entry-title-index-compsub a:hover {
    color: {$wise_textcolor};
}

.titles-cover h1 a:hover {
    color: {$wise_textcolor};
}

.woocommerce .lost_password a:hover {
    color: {$wise_textcolor};
}

.custom-posts ul li a h4:hover {
    color: {$wise_textcolor};
}

div#schat-widget .schat-links a:hover {
    color: {$wise_textcolor} !important;
}

#bbpress-forums div.bbp-reply-content a {
    color: {$wise_textcolor};
}";		
		wp_add_inline_style( 'wise-style', $wise_textcolor_inline_css );
	endif;
}
add_action( 'wp_enqueue_scripts', 'wise_textcolor_inline_styles' );

// Borders and Objects Colors
function wise_linecolor_inline_styles() {
	$wise_linecolor = get_theme_mod('wise_line_color');
	
	if( !empty($wise_linecolor) ) :
		$wise_linecolor_inline_css = ".widget-title:after {
    background: {$wise_linecolor};
}

.page-title {
    border-left: 7px solid {$wise_linecolor};
}

.page-title-archive:after {
    background: {$wise_linecolor};
}

.titles-cover {
    border-bottom: 7px solid {$wise_linecolor};
}

.related h2 {
    border-left: 7px solid {$wise_linecolor};
}

p.demo_store {
    background-color: {$wise_linecolor};
}";		
		wp_add_inline_style( 'wise-style', $wise_linecolor_inline_css );
	endif;
}
add_action( 'wp_enqueue_scripts', 'wise_linecolor_inline_styles' );

/*--------------------------------------------------------------
4. Preloader
**	@by Probewise
**	@Use .png, .jpeg with bouncing animation or .gif
**	@Compatible with Retina Display
--------------------------------------------------------------*/
// Choose Preloader
function wise_preloader_inline_styles() {
    $wise_def_color = get_theme_mod('wise_def_preload_color');
    $wise_def_color = !empty($wise_def_color) ? $wise_def_color : '#3a90fd';
    $wise_pre_preload = get_theme_mod('wise_pre_preload');

if( !empty($wise_pre_preload) ) :
    if($wise_pre_preload == 'rotating-plane') {
        $wise_preload_inline_css = ".sk-rotating-plane {
    width: 50px;
    height: 50px;
    background-color: {$wise_def_color};
    margin: -25px 0 0 -25px;
    -webkit-animation: sk-rotatePlane 1.2s infinite ease-in-out;
            animation: sk-rotatePlane 1.2s infinite ease-in-out; }

@-webkit-keyframes sk-rotatePlane {
    0% {
    -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg);
            transform: perspective(120px) rotateX(0deg) rotateY(0deg); }
    50% {
    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
            transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg); }
    100% {
    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
            transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg); } }

@keyframes sk-rotatePlane {
    0% {
    -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg);
            transform: perspective(120px) rotateX(0deg) rotateY(0deg); }
    50% {
    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
            transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg); }
    100% {
    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
            transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg); } }";
                    
    } elseif($wise_pre_preload == 'double-bounce') {
        $wise_preload_inline_css = ".sk-double-bounce {
    width: 50px;
    height: 50px;
    margin: -25px 0 0 -25px; }
    .sk-double-bounce .sk-child {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background-color: {$wise_def_color};
    opacity: 0.6;
    position: absolute;
    top: 0;
    left: 0;
    -webkit-animation: sk-doubleBounce 2s infinite ease-in-out;
            animation: sk-doubleBounce 2s infinite ease-in-out; }
    .sk-double-bounce .sk-double-bounce2 {
    -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s; }

@-webkit-keyframes sk-doubleBounce {
    0%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0); }
    50% {
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes sk-doubleBounce {
    0%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0); }
    50% {
    -webkit-transform: scale(1);
            transform: scale(1); } }";
                    
    } elseif($wise_pre_preload == 'wave') {
        $wise_preload_inline_css = ".sk-wave {
    margin: -35px 0 0 -30px;
    width: 70px;
    height: 60px;
    text-align: center;
    font-size: 10px; }
    .sk-wave .sk-rect {
    background-color: {$wise_def_color};
    height: 100%;
    width: 8px;
    display: inline-block;
    -webkit-animation: sk-waveStretchDelay 1.2s infinite ease-in-out;
            animation: sk-waveStretchDelay 1.2s infinite ease-in-out; }
    .sk-wave .sk-rect1 {
    -webkit-animation-delay: -1.2s;
            animation-delay: -1.2s; }
    .sk-wave .sk-rect2 {
    -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s; }
    .sk-wave .sk-rect3 {
    -webkit-animation-delay: -1s;
            animation-delay: -1s; }
    .sk-wave .sk-rect4 {
    -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s; }
    .sk-wave .sk-rect5 {
    -webkit-animation-delay: -0.8s;
            animation-delay: -0.8s; }

@-webkit-keyframes sk-waveStretchDelay {
    0%, 40%, 100% {
    -webkit-transform: scaleY(0.4);
            transform: scaleY(0.4); }
    20% {
    -webkit-transform: scaleY(1);
            transform: scaleY(1); } }

@keyframes sk-waveStretchDelay {
    0%, 40%, 100% {
    -webkit-transform: scaleY(0.4);
            transform: scaleY(0.4); }
    20% {
    -webkit-transform: scaleY(1);
            transform: scaleY(1); } }";

    } elseif($wise_pre_preload == 'wandering-cubes') {
        $wise_preload_inline_css = ".sk-wandering-cubes {
    margin: -25px 0 0 -25px;
    width: 50px;
    height: 50px; }
    .sk-wandering-cubes .sk-cube {
    background-color: {$wise_def_color};
    width: 20px;
    height: 20px;
    position: absolute;
    top: 0;
    left: 0;
    -webkit-animation: sk-wanderingCube 1.8s ease-in-out -1.8s infinite both;
            animation: sk-wanderingCube 1.8s ease-in-out -1.8s infinite both; }
    .sk-wandering-cubes .sk-cube2 {
    -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s; }

@-webkit-keyframes sk-wanderingCube {
    0% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg); }
    25% {
    -webkit-transform: translateX(30px) rotate(-90deg) scale(0.5);
            transform: translateX(30px) rotate(-90deg) scale(0.5); }
    50% {
    /* Hack to make FF rotate in the right direction */
    -webkit-transform: translateX(30px) translateY(30px) rotate(-179deg);
            transform: translateX(30px) translateY(30px) rotate(-179deg); }
    50.1% {
    -webkit-transform: translateX(30px) translateY(30px) rotate(-180deg);
            transform: translateX(30px) translateY(30px) rotate(-180deg); }
    75% {
    -webkit-transform: translateX(0) translateY(30px) rotate(-270deg) scale(0.5);
            transform: translateX(0) translateY(30px) rotate(-270deg) scale(0.5); }
    100% {
    -webkit-transform: rotate(-360deg);
            transform: rotate(-360deg); } }

@keyframes sk-wanderingCube {
    0% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg); }
    25% {
    -webkit-transform: translateX(30px) rotate(-90deg) scale(0.5);
            transform: translateX(30px) rotate(-90deg) scale(0.5); }
    50% {
    /* Hack to make FF rotate in the right direction */
    -webkit-transform: translateX(30px) translateY(30px) rotate(-179deg);
            transform: translateX(30px) translateY(30px) rotate(-179deg); }
    50.1% {
    -webkit-transform: translateX(30px) translateY(30px) rotate(-180deg);
            transform: translateX(30px) translateY(30px) rotate(-180deg); }
    75% {
    -webkit-transform: translateX(0) translateY(30px) rotate(-270deg) scale(0.5);
            transform: translateX(0) translateY(30px) rotate(-270deg) scale(0.5); }
    100% {
    -webkit-transform: rotate(-360deg);
            transform: rotate(-360deg); } }";

    } elseif($wise_pre_preload == 'pulse') {
        $wise_preload_inline_css = ".sk-spinner-pulse {
    width: 60px;
    height: 60px;
    margin: -30px 0 0 -30px;
    background-color: {$wise_def_color};
    border-radius: 100%;
    -webkit-animation: sk-pulseScaleOut 1s infinite ease-in-out;
            animation: sk-pulseScaleOut 1s infinite ease-in-out; }

@-webkit-keyframes sk-pulseScaleOut {
    0% {
    -webkit-transform: scale(0);
            transform: scale(0); }
    100% {
    -webkit-transform: scale(1);
            transform: scale(1);
    opacity: 0; } }

@keyframes sk-pulseScaleOut {
    0% {
    -webkit-transform: scale(0);
            transform: scale(0); }
    100% {
    -webkit-transform: scale(1);
            transform: scale(1);
    opacity: 0; } }";

    } elseif($wise_pre_preload == 'chasing-dots') {
        $wise_preload_inline_css = ".sk-chasing-dots {
    margin: -30px 0 0 -30px;
    width: 60px;
    height: 60px;
    text-align: center;
    -webkit-animation: sk-chasingDotsRotate 2s infinite linear;
            animation: sk-chasingDotsRotate 2s infinite linear; }
    .sk-chasing-dots .sk-child {
    width: 60%;
    height: 60%;
    display: inline-block;
    position: absolute;
    top: 0;
    background-color: {$wise_def_color};
    border-radius: 100%;
    -webkit-animation: sk-chasingDotsBounce 2s infinite ease-in-out;
            animation: sk-chasingDotsBounce 2s infinite ease-in-out; }
    .sk-chasing-dots .sk-dot2 {
    top: auto;
    bottom: 0;
    -webkit-animation-delay: -1s;
            animation-delay: -1s; }

@-webkit-keyframes sk-chasingDotsRotate {
    100% {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg); } }

@keyframes sk-chasingDotsRotate {
    100% {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg); } }

@-webkit-keyframes sk-chasingDotsBounce {
    0%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0); }
    50% {
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes sk-chasingDotsBounce {
    0%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0); }
    50% {
    -webkit-transform: scale(1);
            transform: scale(1); } }";

    } elseif($wise_pre_preload == 'three-bounce') {
        $wise_preload_inline_css = ".sk-three-bounce {
    margin: -35px 0 0 -35px;
    width: 70px;
    text-align: center; }
    .sk-three-bounce .sk-child {
    width: 20px;
    height: 20px;
    background-color: {$wise_def_color};
    border-radius: 100%;
    display: inline-block;
    -webkit-animation: sk-three-bounce 1.4s ease-in-out 0s infinite both;
            animation: sk-three-bounce 1.4s ease-in-out 0s infinite both; }
    .sk-three-bounce .sk-bounce1 {
    -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s; }
    .sk-three-bounce .sk-bounce2 {
    -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s; }

@-webkit-keyframes sk-three-bounce {
    0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0); }
    40% {
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes sk-three-bounce {
    0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0); }
    40% {
    -webkit-transform: scale(1);
            transform: scale(1); } }";

    } elseif($wise_pre_preload == 'circle') {
        $wise_preload_inline_css = ".sk-circle {
    margin: -30px 0 0 -30px;
    width: 60px;
    height: 60px; }
    .sk-circle .sk-child {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0; }
    .sk-circle .sk-child:before {
    content: '';
    display: block;
    margin: 0 auto;
    width: 15%;
    height: 15%;
    background-color: {$wise_def_color};
    border-radius: 100%;
    -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
            animation: sk-circleBounceDelay 1.2s infinite ease-in-out both; }
    .sk-circle .sk-circle2 {
    -webkit-transform: rotate(30deg);
        -ms-transform: rotate(30deg);
            transform: rotate(30deg); }
    .sk-circle .sk-circle3 {
    -webkit-transform: rotate(60deg);
        -ms-transform: rotate(60deg);
            transform: rotate(60deg); }
    .sk-circle .sk-circle4 {
    -webkit-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
            transform: rotate(90deg); }
    .sk-circle .sk-circle5 {
    -webkit-transform: rotate(120deg);
        -ms-transform: rotate(120deg);
            transform: rotate(120deg); }
    .sk-circle .sk-circle6 {
    -webkit-transform: rotate(150deg);
        -ms-transform: rotate(150deg);
            transform: rotate(150deg); }
    .sk-circle .sk-circle7 {
    -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
            transform: rotate(180deg); }
    .sk-circle .sk-circle8 {
    -webkit-transform: rotate(210deg);
        -ms-transform: rotate(210deg);
            transform: rotate(210deg); }
    .sk-circle .sk-circle9 {
    -webkit-transform: rotate(240deg);
        -ms-transform: rotate(240deg);
            transform: rotate(240deg); }
    .sk-circle .sk-circle10 {
    -webkit-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
            transform: rotate(270deg); }
    .sk-circle .sk-circle11 {
    -webkit-transform: rotate(300deg);
        -ms-transform: rotate(300deg);
            transform: rotate(300deg); }
    .sk-circle .sk-circle12 {
    -webkit-transform: rotate(330deg);
        -ms-transform: rotate(330deg);
            transform: rotate(330deg); }
    .sk-circle .sk-circle2:before {
    -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s; }
    .sk-circle .sk-circle3:before {
    -webkit-animation-delay: -1s;
            animation-delay: -1s; }
    .sk-circle .sk-circle4:before {
    -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s; }
    .sk-circle .sk-circle5:before {
    -webkit-animation-delay: -0.8s;
            animation-delay: -0.8s; }
    .sk-circle .sk-circle6:before {
    -webkit-animation-delay: -0.7s;
            animation-delay: -0.7s; }
    .sk-circle .sk-circle7:before {
    -webkit-animation-delay: -0.6s;
            animation-delay: -0.6s; }
    .sk-circle .sk-circle8:before {
    -webkit-animation-delay: -0.5s;
            animation-delay: -0.5s; }
    .sk-circle .sk-circle9:before {
    -webkit-animation-delay: -0.4s;
            animation-delay: -0.4s; }
    .sk-circle .sk-circle10:before {
    -webkit-animation-delay: -0.3s;
            animation-delay: -0.3s; }
    .sk-circle .sk-circle11:before {
    -webkit-animation-delay: -0.2s;
            animation-delay: -0.2s; }
    .sk-circle .sk-circle12:before {
    -webkit-animation-delay: -0.1s;
            animation-delay: -0.1s; }

@-webkit-keyframes sk-circleBounceDelay {
    0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0); }
    40% {
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes sk-circleBounceDelay {
    0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0); }
    40% {
    -webkit-transform: scale(1);
            transform: scale(1); } }";

    } elseif($wise_pre_preload == 'cube-grid') {
        $wise_preload_inline_css = ".sk-cube-grid {
    width: 60px;
    height: 60px;
    margin: -30px 0 0 -30px;
    /*
    * Spinner positions
    * 1 2 3
    * 4 5 6
    * 7 8 9
    */ }
    .sk-cube-grid .sk-cube {
    width: 33.33%;
    height: 33.33%;
    background-color: {$wise_def_color};
    float: left;
    -webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
            animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out; }
    .sk-cube-grid .sk-cube1 {
    -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s; }
    .sk-cube-grid .sk-cube2 {
    -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s; }
    .sk-cube-grid .sk-cube3 {
    -webkit-animation-delay: 0.4s;
            animation-delay: 0.4s; }
    .sk-cube-grid .sk-cube4 {
    -webkit-animation-delay: 0.1s;
            animation-delay: 0.1s; }
    .sk-cube-grid .sk-cube5 {
    -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s; }
    .sk-cube-grid .sk-cube6 {
    -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s; }
    .sk-cube-grid .sk-cube7 {
    -webkit-animation-delay: 0.0s;
            animation-delay: 0.0s; }
    .sk-cube-grid .sk-cube8 {
    -webkit-animation-delay: 0.1s;
            animation-delay: 0.1s; }
    .sk-cube-grid .sk-cube9 {
    -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s; }

@-webkit-keyframes sk-cubeGridScaleDelay {
    0%, 70%, 100% {
    -webkit-transform: scale3D(1, 1, 1);
            transform: scale3D(1, 1, 1); }
    35% {
    -webkit-transform: scale3D(0, 0, 1);
            transform: scale3D(0, 0, 1); } }

@keyframes sk-cubeGridScaleDelay {
    0%, 70%, 100% {
    -webkit-transform: scale3D(1, 1, 1);
            transform: scale3D(1, 1, 1); }
    35% {
    -webkit-transform: scale3D(0, 0, 1);
            transform: scale3D(0, 0, 1); } }";

    } elseif($wise_pre_preload == 'fading-circle') {
        $wise_preload_inline_css = ".sk-fading-circle {
    margin: -30px 0 0 -30px;
    width: 60px;
    height: 60px; }
    .sk-fading-circle .sk-circle {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0; }
    .sk-fading-circle .sk-circle:before {
    content: '';
    display: block;
    margin: 0 auto;
    width: 15%;
    height: 15%;
    background-color: {$wise_def_color};
    border-radius: 100%;
    -webkit-animation: sk-circleFadeDelay 1.2s infinite ease-in-out both;
            animation: sk-circleFadeDelay 1.2s infinite ease-in-out both; }
    .sk-fading-circle .sk-circle2 {
    -webkit-transform: rotate(30deg);
        -ms-transform: rotate(30deg);
            transform: rotate(30deg); }
    .sk-fading-circle .sk-circle3 {
    -webkit-transform: rotate(60deg);
        -ms-transform: rotate(60deg);
            transform: rotate(60deg); }
    .sk-fading-circle .sk-circle4 {
    -webkit-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
            transform: rotate(90deg); }
    .sk-fading-circle .sk-circle5 {
    -webkit-transform: rotate(120deg);
        -ms-transform: rotate(120deg);
            transform: rotate(120deg); }
    .sk-fading-circle .sk-circle6 {
    -webkit-transform: rotate(150deg);
        -ms-transform: rotate(150deg);
            transform: rotate(150deg); }
    .sk-fading-circle .sk-circle7 {
    -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
            transform: rotate(180deg); }
    .sk-fading-circle .sk-circle8 {
    -webkit-transform: rotate(210deg);
        -ms-transform: rotate(210deg);
            transform: rotate(210deg); }
    .sk-fading-circle .sk-circle9 {
    -webkit-transform: rotate(240deg);
        -ms-transform: rotate(240deg);
            transform: rotate(240deg); }
    .sk-fading-circle .sk-circle10 {
    -webkit-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
            transform: rotate(270deg); }
    .sk-fading-circle .sk-circle11 {
    -webkit-transform: rotate(300deg);
        -ms-transform: rotate(300deg);
            transform: rotate(300deg); }
    .sk-fading-circle .sk-circle12 {
    -webkit-transform: rotate(330deg);
        -ms-transform: rotate(330deg);
            transform: rotate(330deg); }
    .sk-fading-circle .sk-circle2:before {
    -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s; }
    .sk-fading-circle .sk-circle3:before {
    -webkit-animation-delay: -1s;
            animation-delay: -1s; }
    .sk-fading-circle .sk-circle4:before {
    -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s; }
    .sk-fading-circle .sk-circle5:before {
    -webkit-animation-delay: -0.8s;
            animation-delay: -0.8s; }
    .sk-fading-circle .sk-circle6:before {
    -webkit-animation-delay: -0.7s;
            animation-delay: -0.7s; }
    .sk-fading-circle .sk-circle7:before {
    -webkit-animation-delay: -0.6s;
            animation-delay: -0.6s; }
    .sk-fading-circle .sk-circle8:before {
    -webkit-animation-delay: -0.5s;
            animation-delay: -0.5s; }
    .sk-fading-circle .sk-circle9:before {
    -webkit-animation-delay: -0.4s;
            animation-delay: -0.4s; }
    .sk-fading-circle .sk-circle10:before {
    -webkit-animation-delay: -0.3s;
            animation-delay: -0.3s; }
    .sk-fading-circle .sk-circle11:before {
    -webkit-animation-delay: -0.2s;
            animation-delay: -0.2s; }
    .sk-fading-circle .sk-circle12:before {
    -webkit-animation-delay: -0.1s;
            animation-delay: -0.1s; }

@-webkit-keyframes sk-circleFadeDelay {
    0%, 39%, 100% {
    opacity: 0; }
    40% {
    opacity: 1; } }

@keyframes sk-circleFadeDelay {
    0%, 39%, 100% {
    opacity: 0; }
    40% {
    opacity: 1; } }";

    } elseif($wise_pre_preload == 'folding-cube') {
        $wise_preload_inline_css = ".sk-folding-cube {
    margin: -25px 0 0 -25px;
    width: 50px;
    height: 50px;
    -webkit-transform: rotateZ(45deg);
            transform: rotateZ(45deg); }
    .sk-folding-cube .sk-cube {
    float: left;
    width: 50%;
    height: 50%;
    position: relative;
    -webkit-transform: scale(1.1);
        -ms-transform: scale(1.1);
            transform: scale(1.1); }
    .sk-folding-cube .sk-cube:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: {$wise_def_color};
    -webkit-animation: sk-foldCubeAngle 2.4s infinite linear both;
            animation: sk-foldCubeAngle 2.4s infinite linear both;
    -webkit-transform-origin: 100% 100%;
        -ms-transform-origin: 100% 100%;
            transform-origin: 100% 100%; }
    .sk-folding-cube .sk-cube2 {
    -webkit-transform: scale(1.1) rotateZ(90deg);
            transform: scale(1.1) rotateZ(90deg); }
    .sk-folding-cube .sk-cube3 {
    -webkit-transform: scale(1.1) rotateZ(180deg);
            transform: scale(1.1) rotateZ(180deg); }
    .sk-folding-cube .sk-cube4 {
    -webkit-transform: scale(1.1) rotateZ(270deg);
            transform: scale(1.1) rotateZ(270deg); }
    .sk-folding-cube .sk-cube2:before {
    -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s; }
    .sk-folding-cube .sk-cube3:before {
    -webkit-animation-delay: 0.6s;
            animation-delay: 0.6s; }
    .sk-folding-cube .sk-cube4:before {
    -webkit-animation-delay: 0.9s;
            animation-delay: 0.9s; }

@-webkit-keyframes sk-foldCubeAngle {
    0%, 10% {
    -webkit-transform: perspective(140px) rotateX(-180deg);
            transform: perspective(140px) rotateX(-180deg);
    opacity: 0; }
    25%, 75% {
    -webkit-transform: perspective(140px) rotateX(0deg);
            transform: perspective(140px) rotateX(0deg);
    opacity: 1; }
    90%, 100% {
    -webkit-transform: perspective(140px) rotateY(180deg);
            transform: perspective(140px) rotateY(180deg);
    opacity: 0; } }

@keyframes sk-foldCubeAngle {
    0%, 10% {
    -webkit-transform: perspective(140px) rotateX(-180deg);
            transform: perspective(140px) rotateX(-180deg);
    opacity: 0; }
    25%, 75% {
    -webkit-transform: perspective(140px) rotateX(0deg);
            transform: perspective(140px) rotateX(0deg);
    opacity: 1; }
    90%, 100% {
    -webkit-transform: perspective(140px) rotateY(180deg);
            transform: perspective(140px) rotateY(180deg);
    opacity: 0; } }";

        } else {
            $wise_preload_inline_css = null; 
        }

        wp_add_inline_style( 'wise-style', $wise_preload_inline_css );
    endif;
}
add_action( 'wp_enqueue_scripts', 'wise_preloader_inline_styles' );

// Initialize Preloader
function wise_preloader() {
	$wise_pre_preload = get_theme_mod('wise_pre_preload');
	$wise_preloader = get_theme_mod( 'wise_preload' );
	if( $wise_pre_preload != null || $wise_preloader != null ) : ?>
		<div id="wiseload">
			<?php 	if($wise_preloader != null) : // If preloader is not empty
						list($width) = getimagesize($wise_preloader);
						$wise_chunks = explode('.', $wise_preloader); 
						$wise_ext = end($wise_chunks); // Get the image extension
					endif;
			?>
			<?php if($wise_preloader == null) { ?>
				<?php if($wise_pre_preload == 'rotating-plane') { ?>
					<div class="sk-rotating-plane wise-preloader-centered"></div>
				<?php } elseif($wise_pre_preload == 'double-bounce') { ?>
					<div class="sk-double-bounce wise-preloader-centered">
						<div class="sk-child sk-double-bounce1"></div>
						<div class="sk-child sk-double-bounce2"></div>
					</div>
				<?php } elseif($wise_pre_preload == 'wave') { ?>
					<div class="sk-wave wise-preloader-centered">
						<div class="sk-rect sk-rect1"></div>
						<div class="sk-rect sk-rect2"></div>
						<div class="sk-rect sk-rect3"></div>
						<div class="sk-rect sk-rect4"></div>
						<div class="sk-rect sk-rect5"></div>
					</div>
				<?php } elseif($wise_pre_preload == 'wandering-cubes') { ?>
					<div class="sk-wandering-cubes wise-preloader-centered">
						<div class="sk-cube sk-cube1"></div>
						<div class="sk-cube sk-cube2"></div>
					</div>
				<?php } elseif($wise_pre_preload == 'pulse') { ?>
					<div class="sk-spinner sk-spinner-pulse wise-preloader-centered"></div>
				<?php } elseif($wise_pre_preload == 'chasing-dots') { ?>
					<div class="sk-chasing-dots wise-preloader-centered">
						<div class="sk-child sk-dot1"></div>
						<div class="sk-child sk-dot2"></div>
					</div>
				<?php } elseif($wise_pre_preload == 'three-bounce') { ?>
					<div class="sk-three-bounce wise-preloader-centered">
						<div class="sk-child sk-bounce1"></div>
						<div class="sk-child sk-bounce2"></div>
						<div class="sk-child sk-bounce3"></div>
					</div>
				<?php } elseif($wise_pre_preload == 'circle') { ?>
					<div class="sk-circle wise-preloader-centered">
						<div class="sk-circle1 sk-child"></div>
						<div class="sk-circle2 sk-child"></div>
						<div class="sk-circle3 sk-child"></div>
						<div class="sk-circle4 sk-child"></div>
						<div class="sk-circle5 sk-child"></div>
						<div class="sk-circle6 sk-child"></div>
						<div class="sk-circle7 sk-child"></div>
						<div class="sk-circle8 sk-child"></div>
						<div class="sk-circle9 sk-child"></div>
						<div class="sk-circle10 sk-child"></div>
						<div class="sk-circle11 sk-child"></div>
						<div class="sk-circle12 sk-child"></div>
					</div>
				<?php } elseif($wise_pre_preload == 'cube-grid') { ?>
					<div class="sk-cube-grid wise-preloader-centered">
						<div class="sk-cube sk-cube1"></div>
						<div class="sk-cube sk-cube2"></div>
						<div class="sk-cube sk-cube3"></div>
						<div class="sk-cube sk-cube4"></div>
						<div class="sk-cube sk-cube5"></div>
						<div class="sk-cube sk-cube6"></div>
						<div class="sk-cube sk-cube7"></div>
						<div class="sk-cube sk-cube8"></div>
						<div class="sk-cube sk-cube9"></div>
					</div>
				<?php } elseif($wise_pre_preload == 'fading-circle') { ?>
					<div class="sk-fading-circle wise-preloader-centered">
						<div class="sk-circle1 sk-circle"></div>
						<div class="sk-circle2 sk-circle"></div>
						<div class="sk-circle3 sk-circle"></div>
						<div class="sk-circle4 sk-circle"></div>
						<div class="sk-circle5 sk-circle"></div>
						<div class="sk-circle6 sk-circle"></div>
						<div class="sk-circle7 sk-circle"></div>
						<div class="sk-circle8 sk-circle"></div>
						<div class="sk-circle9 sk-circle"></div>
						<div class="sk-circle10 sk-circle"></div>
						<div class="sk-circle11 sk-circle"></div>
						<div class="sk-circle12 sk-circle"></div>
					</div>
				<?php } elseif($wise_pre_preload == 'folding-cube') { ?>
					<div class="sk-folding-cube wise-preloader-centered">
						<div class="sk-cube1 sk-cube"></div>
						<div class="sk-cube2 sk-cube"></div>
						<div class="sk-cube4 sk-cube"></div>
						<div class="sk-cube3 sk-cube"></div>
					</div>
				<?php } else { null; ?>
				<?php } ?>
			<?php } else { ?>
				<div id="stats" <?php if($wise_ext != 'gif') : echo 'class="animated bounce infinite"'; endif; ?> style="background: url('<?php echo esc_url($wise_preloader); ?>') no-repeat center; <?php if($width > 200) : echo 'background-size: 100% !important;'; endif; ?>"></div>
			<?php } ?>
		</div>
	<?php endif; ?><?php
}

/*--------------------------------------------------------------
5. Author Link
--------------------------------------------------------------*/
function wise_auth_inline_styles() {
    $disable_authlink = get_theme_mod('wise_footer_authlink_dis');

    if( $disable_authlink == true ) :
        $wise_auth_inline_css = ".wise-author-link {
    display: none;
}";
        wp_add_inline_style( 'wise-style', $wise_auth_inline_css );
    endif;
}
add_action( 'wp_enqueue_scripts', 'wise_auth_inline_styles' );