<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Wise Blog for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';

function wise_register_required_plugins() {

	$plugins = array(

		/* Required Plugins */

		// Wise Blog Contents
		array(
			'name'               => 'Wise Blog Contents',
			'slug'               => 'wise-blog-contents',
			'source'             => 'https://www.probewise.com/go/wise-blog-contents/',
            'required'           => true,
            'version'            => '20220618',
		),

		// Carbon Fields
		array(
			'name'               => 'Carbon Fields',
			'slug'               => 'carbon-fields',
			'source'             => 'https://www.probewise.com/go/carbon-fields/',
            'required'           => true,
            'version'            => '3.3.4',
		),

		/* Recommended Plugins */

		// Autoptimize
		array(
			'name'      => 'Autoptimize',
			'slug'      => 'autoptimize',
			'required'  => false,
        ),
        
		// WP Super Cache
		array(
			'name'      => 'WP Super Cache',
			'slug'      => 'wp-super-cache',
			'required'  => false,
		),

		// Contact Form 7
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),

		// Screets Live Chat Unlimited
		array(
			'name'               => 'Screets Live Chat Unlimited',
			'slug'               => 'screets-lcx',
			'source'             => 'https://www.probewise.com/go/screets-lcx/',
            'required'           => false,
            'version'            => '2.9.5',
		),

		// bbPress
		array(
			'name'      => 'bbPress',
			'slug'      => 'bbpress',
			'required'  => false,
		),

		// WooCommerce
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
		),

		// Google XML Sitemaps
		array(
			'name'      => 'Google XML Sitemaps',
			'slug'      => 'google-sitemap-generator',
			'required'  => false,
		),
		
		// The SEO Framework
		array(
			'name'      => 'The SEO Framework',
			'slug'      => 'autodescription',
			'required'  => false,
		),

		// Stop Spammers
		array(
			'name'      => 'Stop Spammers',
			'slug'      => 'stop-spammer-registrations-plugin',
			'required'  => false,
		),

		// Customizer Export/Import
		array(
			'name'      => 'Customizer Export/Import',
			'slug'      => 'customizer-export-import',
			'required'  => false,
		),

		// Widget Importer & Exporter
		array(
			'name'      => 'Widget Importer & Exporter',
			'slug'      => 'widget-importer-exporter',
			'required'  => false,
		),

		// One Click Demo Import
		array(
			'name'      => 'One Click Demo Import',
			'slug'      => 'one-click-demo-import',
			'required'  => false,
		),

	); // End plugins array

	$config = array(
		'id'           => 'wise-blog',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'wise_register_required_plugins' );
