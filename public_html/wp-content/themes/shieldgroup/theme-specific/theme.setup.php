<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0.22
 */

if (!defined("SHIELDGROUP_THEME_FREE")) define("SHIELDGROUP_THEME_FREE", false);
if (!defined("SHIELDGROUP_THEME_FREE_WP")) define("SHIELDGROUP_THEME_FREE_WP", false);

// Theme storage
$SHIELDGROUP_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'					=> esc_html__('ThemeREX Addons', 'shieldgroup'),

			// Recommended (supported) plugins fot both (lite and full) versions
			// If plugin not need - comment (or remove) it
			'contact-form-7'				=> esc_html__('Contact Form 7', 'shieldgroup'),
			'woocommerce'					=> esc_html__('WooCommerce', 'shieldgroup')
		),

		// List of plugins for PREMIUM version only
		//-----------------------------------------------------
		SHIELDGROUP_THEME_FREE 
			? array(
					// Recommended (supported) plugins for the FREE (lite) version
					'siteorigin-panels'			=> esc_html__('SiteOrigin Panels', 'shieldgroup'),
					) 
			: array(
					// Recommended (supported) plugins for the PRO (full) version
					// If plugin not need - comment (or remove) it
					'js_composer'				=> esc_html__('Visual Composer', 'shieldgroup'),
					'essential-grid'			=> esc_html__('Essential Grid', 'shieldgroup'),
					'revslider'					=> esc_html__('Revolution Slider', 'shieldgroup')
				)
	),
	
	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url' => 'http://shieldgroup.ancorathemes.com',
	'theme_doc_url'  => 'http://shieldgroup.ancorathemes.com/doc',

	'theme_video_url' => 'https://www.youtube.com/channel/UCdIjRh7-lPVHqTTKpaf8PLA',	// Ancora

	'theme_support_url'  => 'https://ancorathemes.ticksy.com',
    'theme_download_url'=> 'https://1.envato.market/c/1262870/275988/4415?subId1=ancora&u=themeforest.net/item/shieldgroup-insurance-finance-wp-theme/21052570',
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( !function_exists('shieldgroup_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'shieldgroup_customizer_theme_setup1', 1 );
	function shieldgroup_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		shieldgroup_storage_set('settings', array(
			
			'duplicate_options'		=> 'child',		// none  - use separate options for template and child-theme
													// child - duplicate theme options from the main theme to the child-theme only
													// both  - sinchronize changes in the theme options between main and child themes
			
			'custmize_refresh'		=> 'auto',		// Refresh method for preview area in the Appearance - Customize:
													// auto - refresh preview area on change each field with Theme Options
													// manual - refresh only obn press button 'Refresh' at the top of Customize frame
		
			'max_load_fonts'		=> 5,			// Max fonts number to load from Google fonts or from uploaded fonts
		
			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true,		// Place 'comment' field before the 'name' and 'email'
			
			'socials_type'			=> 'icons',		// Type of socials:
													// icons - use font icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_type'			=> 'icons',		// Type of other icons:
													// icons - use font icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_selector'		=> 'internal',	// Icons selector in the shortcodes:
													// vc (default) - standard VC icons selector (very slow and don't support images)
													// internal - internal popup with plugin's or theme's icons list (fast)
			'check_min_version'		=> true,		// Check if exists a .min version of .css and .js and return path to it
													// instead the path to the original file
													// (if debug_mode is off and modification time of the original file < time of the .min file)
			'autoselect_menu'		=> false,		// Show any menu if no menu selected in the location 'main_menu'
													// (for example, the theme is just activated)
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
			
			'tgmpa_upload'			=> false		// Allow upload not pre-packaged plugins via TGMPA
		));


		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		shieldgroup_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Merriweather Sans',
				'family' => 'sans-serif',
				'styles' => '300,400,400i,700'		// Parameter 'style' used only for the Google fonts
				),
            array(
                'name'	 => 'Ubuntu',
                'family' => 'sans-serif',
                'styles' => '300,400,500'		// Parameter 'style' used only for the Google fonts
            )

		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		shieldgroup_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		shieldgroup_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'shieldgroup'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'shieldgroup'),
				'font-family'		=> '"Merriweather Sans",sans-serif',
				'font-size' 		=> '17px',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.53em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.4em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'shieldgroup'),
				'font-family'		=> '"Ubuntu",sans-serif',
				'font-size' 		=> '4.48em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1.8px',
				'margin-top'		=> '7.5rem',
				'margin-bottom'		=> '6.05rem'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'shieldgroup'),
				'font-family'		=> '"Ubuntu",sans-serif',
				'font-size' 		=> '3.824em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.08em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1.3px',
				'margin-top'		=> '7.5rem',
				'margin-bottom'		=> '6rem'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'shieldgroup'),
				'font-family'		=> '"Ubuntu",sans-serif',
				'font-size' 		=> '3.118em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.13em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1px',
				'margin-top'		=> '7.65rem',
				'margin-bottom'		=> '4.6rem'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'shieldgroup'),
				'font-family'		=> '"Ubuntu",sans-serif',
				'font-size' 		=> '2.529em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.23em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.8px',
				'margin-top'		=> '7.5rem',
				'margin-bottom'		=> '4.25rem'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'shieldgroup'),
				'font-family'		=> '"Ubuntu",sans-serif',
				'font-size' 		=> '1.882em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.09em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.7px',
				'margin-top'		=> '7.6rem',
				'margin-bottom'		=> '2.3rem'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'shieldgroup'),
				'font-family'		=> '"Merriweather Sans",sans-serif',
				'font-size' 		=> '1.294em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.27em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.4px',
				'margin-top'		=> '8.1rem',
				'margin-bottom'		=> '1.35rem'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'shieldgroup'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'shieldgroup'),
				'font-family'		=> '"Ubuntu",sans-serif',
				'font-size' 		=> '1.765em',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.8px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'shieldgroup'),
				'font-family'		=> '"Merriweather Sans",sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.3px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'shieldgroup'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'shieldgroup'),
				'font-family'		=> '"Merriweather Sans",sans-serif',
				'font-size' 		=> '0.941em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'shieldgroup'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'shieldgroup'),
				'font-family'		=> '"Merriweather Sans",sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'shieldgroup'),
				'description'		=> esc_html__('Font settings of the main menu items', 'shieldgroup'),
				'font-family'		=> '"Merriweather Sans",sans-serif',
				'font-size' 		=> '17px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.3px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'shieldgroup'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'shieldgroup'),
				'font-family'		=> '"Merriweather Sans",sans-serif',
				'font-size' 		=> '17px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		shieldgroup_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> __('Main', 'shieldgroup'),
							'description'	=> __('Colors of the main content area', 'shieldgroup')
							),
			'alter'	=> array(
							'title'			=> __('Alter', 'shieldgroup'),
							'description'	=> __('Colors of the alternative blocks (sidebars, etc.)', 'shieldgroup')
							),
			'extra'	=> array(
							'title'			=> __('Extra', 'shieldgroup'),
							'description'	=> __('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'shieldgroup')
							),
			'inverse' => array(
							'title'			=> __('Inverse', 'shieldgroup'),
							'description'	=> __('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'shieldgroup')
							),
			'input'	=> array(
							'title'			=> __('Input', 'shieldgroup'),
							'description'	=> __('Colors of the form fields (text field, textarea, select, etc.)', 'shieldgroup')
							),
			)
		);
		shieldgroup_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> __('Background color', 'shieldgroup'),
							'description'	=> __('Background color of this block in the normal state', 'shieldgroup')
							),
			'bg_hover'	=> array(
							'title'			=> __('Background hover', 'shieldgroup'),
							'description'	=> __('Background color of this block in the hovered state', 'shieldgroup')
							),
			'bd_color'	=> array(
							'title'			=> __('Border color', 'shieldgroup'),
							'description'	=> __('Border color of this block in the normal state', 'shieldgroup')
							),
			'bd_hover'	=>  array(
							'title'			=> __('Border hover', 'shieldgroup'),
							'description'	=> __('Border color of this block in the hovered state', 'shieldgroup')
							),
			'text'		=> array(
							'title'			=> __('Text', 'shieldgroup'),
							'description'	=> __('Color of the plain text inside this block', 'shieldgroup')
							),
			'text_dark'	=> array(
							'title'			=> __('Text dark', 'shieldgroup'),
							'description'	=> __('Color of the dark text (bold, header, etc.) inside this block', 'shieldgroup')
							),
			'text_light'=> array(
							'title'			=> __('Text light', 'shieldgroup'),
							'description'	=> __('Color of the light text (post meta, etc.) inside this block', 'shieldgroup')
							),
			'text_link'	=> array(
							'title'			=> __('Link', 'shieldgroup'),
							'description'	=> __('Color of the links inside this block', 'shieldgroup')
							),
			'text_hover'=> array(
							'title'			=> __('Link hover', 'shieldgroup'),
							'description'	=> __('Color of the hovered state of links inside this block', 'shieldgroup')
							),
			'text_link2'=> array(
							'title'			=> __('Link 2', 'shieldgroup'),
							'description'	=> __('Color of the accented texts (areas) inside this block', 'shieldgroup')
							),
			'text_hover2'=> array(
							'title'			=> __('Link 2 hover', 'shieldgroup'),
							'description'	=> __('Color of the hovered state of accented texts (areas) inside this block', 'shieldgroup')
							),
			'text_link3'=> array(
							'title'			=> __('Link 3', 'shieldgroup'),
							'description'	=> __('Color of the other accented texts (buttons) inside this block', 'shieldgroup')
							),
			'text_hover3'=> array(
							'title'			=> __('Link 3 hover', 'shieldgroup'),
							'description'	=> __('Color of the hovered state of other accented texts (buttons) inside this block', 'shieldgroup')
							)
			)
		);
		shieldgroup_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'shieldgroup'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff',   //
					'bd_color'			=> '#e1e4e5',  //
		
					// Text and links colors
					'text'				=> '#8ea1b2',   //
					'text_light'		=> '#8ea1b2',   //
					'text_dark'			=> '#384657',   //
					'text_link'			=> '#369df5',   //
					'text_hover'		=> '#1cdbdd',   //
					'text_link2'		=> '#5637d7',   //
					'text_hover2'		=> '#4228b4',   //
					'text_link3'		=> '#d1e9fe',   //
					'text_hover3'		=> '#3d9ff2',   //
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#f2f5f7',   //
					'alter_bg_hover'	=> '#f8fafb',   //
					'alter_bd_color'	=> '#e5e5e5',
					'alter_bd_hover'	=> '#dadada',
					'alter_text'		=> '#333333',
					'alter_light'		=> '#d5dade',   //
					'alter_dark'		=> '#1d1d1d',
					'alter_link'		=> '#1cdbdd',   //
					'alter_hover'		=> '#72cfd5',
					'alter_link2'		=> '#30dbdc',   //
					'alter_hover2'		=> '#23c6c8',   //
					'alter_link3'		=> '#20b2f9',   //
					'alter_hover3'		=> '#ec8375',   //
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1f2529',   //
					'extra_bg_hover'	=> '#29313c',   //
					'extra_bd_color'	=> '#2a323c',   //
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#bfbfbf',
					'extra_light'		=> '#afafaf',
					'extra_dark'		=> '#96a1ab',   //
					'extra_link'		=> '#72cfd5',
					'extra_hover'		=> '#fe7259',
					'extra_link2'		=> '#4f7aee',   //
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#f2f5f7',   //
					'input_bg_hover'	=> '#f2f5f7',   //
					'input_bd_color'	=> '#f2f5f7',   //
					'input_bd_hover'	=> '#30dbdc',   //
					'input_text'		=> '#8ea1b2',   //
					'input_light'		=> '#8ea1b2',   //
					'input_dark'		=> '#8ea1b2',   //
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#333333',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'shieldgroup'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#2a323c',   //
					'bd_color'			=> '#1f2529',   //
		
					// Text and links colors
					'text'				=> '#96a1ab',   //
					'text_light'		=> '#5f5f5f',
					'text_dark'			=> '#ffffff',
                    'text_link'			=> '#369df5',   //
                    'text_hover'		=> '#1cdbdd',   //
                    'text_link2'		=> '#5637d7',   //
                    'text_hover2'		=> '#4228b4',   //
                    'text_link3'		=> '#d1e9fe',   //
                    'text_hover3'		=> '#3d9ff2',   //

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#1e1d22',
					'alter_bg_hover'	=> '#333333',
					'alter_bd_color'	=> '#464646',
					'alter_bd_hover'	=> '#4a4a4a',
					'alter_text'		=> '#ccd0d3',   //
					'alter_light'		=> '#d5dade',//
					'alter_dark'		=> '#ffffff',
					'alter_link'		=> '#1cdbdd',
					'alter_hover'		=> '#fe7259',
                    'alter_link2'		=> '#30dbdc',   //
                    'alter_hover2'		=> '#23c6c8',   //
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1e1d22',
					'extra_bg_hover'	=> '#29313c',   //
					'extra_bd_color'	=> '#464646',
					'extra_bd_hover'	=> '#4a4a4a',
					'extra_text'		=> '#a6a6a6',
					'extra_light'		=> '#5f5f5f',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#1cdbdd',
					'extra_hover'		=> '#fe7259',
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#2e2d32',
					'input_bg_hover'	=> '#2e2d32',
					'input_bd_color'	=> '#2e2d32',
					'input_bd_hover'	=> '#353535',
					'input_text'		=> '#b7b7b7',
					'input_light'		=> '#5f5f5f',
					'input_dark'		=> '#ffffff',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#5f5f5f',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			)
		
		));
		
		// Simple schemes substitution
		shieldgroup_storage_set('schemes_simple', array(
			// Main color	// Slave elements and it's darkness koef.
			'text_link'		=> array('alter_hover' => 1,	'extra_link' => 1, 'inverse_bd_color' => 0.85, 'inverse_bd_hover' => 0.7),
			'text_hover'	=> array('alter_link' => 1,		'extra_hover' => 1),
			'text_link2'	=> array('alter_hover2' => 1,	'extra_link2' => 1),
			'text_hover2'	=> array('alter_link2' => 1,	'extra_hover2' => 1),
			'text_link3'	=> array('alter_hover3' => 1,	'extra_link3' => 1),
			'text_hover3'	=> array('alter_link3' => 1,	'extra_hover3' => 1)
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('shieldgroup_customizer_add_theme_colors')) {
	function shieldgroup_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = shieldgroup_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = shieldgroup_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_04']  = shieldgroup_hex2rgba( $colors['bg_color'], 0.4 );
			$colors['bg_color_07']  = shieldgroup_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = shieldgroup_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = shieldgroup_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['inverse_link_02']  = shieldgroup_hex2rgba( $colors['inverse_link'], 0.2 );
			$colors['alter_bg_color_07']  = shieldgroup_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = shieldgroup_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = shieldgroup_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = shieldgroup_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['extra_bg_color_07']  = shieldgroup_hex2rgba( $colors['extra_bg_color'], 0.7 );
			$colors['extra_bg_hover_08']  = shieldgroup_hex2rgba( $colors['extra_bg_hover'], 0.8 );
			$colors['inverse_dark_05']  = shieldgroup_hex2rgba( $colors['inverse_dark'], 0.5 );
			$colors['inverse_dark_06']  = shieldgroup_hex2rgba( $colors['inverse_dark'], 0.6 );
			$colors['inverse_link_04']  = shieldgroup_hex2rgba( $colors['inverse_link'], 0.4 );
			$colors['inverse_link_05']  = shieldgroup_hex2rgba( $colors['inverse_link'], 0.5 );
			$colors['inverse_link_06']  = shieldgroup_hex2rgba( $colors['inverse_link'], 0.6 );
			$colors['inverse_link_07']  = shieldgroup_hex2rgba( $colors['inverse_link'], 0.7 );
			$colors['text_dark_05']  = shieldgroup_hex2rgba( $colors['text_dark'], 0.5 );
			$colors['text_dark_06']  = shieldgroup_hex2rgba( $colors['text_dark'], 0.6 );
			$colors['text_dark_07']  = shieldgroup_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = shieldgroup_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = shieldgroup_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_link_blend'] = shieldgroup_hsb2hex(shieldgroup_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = shieldgroup_hsb2hex(shieldgroup_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['extra_bg_color_07'] = '{{ data.extra_bg_color_07 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('shieldgroup_customizer_add_theme_fonts')) {
	function shieldgroup_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			//$rez[$tag] = $font;
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !shieldgroup_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !shieldgroup_is_inherit($font['font-size'])
														? 'font-size:' . shieldgroup_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !shieldgroup_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !shieldgroup_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !shieldgroup_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !shieldgroup_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !shieldgroup_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !shieldgroup_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !shieldgroup_is_inherit($font['margin-top'])
														? 'margin-top:' . shieldgroup_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !shieldgroup_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . shieldgroup_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}




//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('shieldgroup_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'shieldgroup_customizer_theme_setup' );
	function shieldgroup_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('shieldgroup_filter_add_thumb_sizes', array(
			'shieldgroup-thumb-huge'		=> array(1290, 658, true),
			'shieldgroup-thumb-big' 		=> array( 850, 408, true),
			'shieldgroup-thumb-med' 		=> array( 370, 208, true),
			'shieldgroup-thumb-posts' 		=> array( 486, 261, true),
            'shieldgroup-thumb-post' 		=> array( 630, 384, true),
			'shieldgroup-thumb-serv' 		=> array( 325, 242, true),
			'shieldgroup-thumb-team' 		=> array( 300, 375, true),
			'shieldgroup-thumb-tiny' 		=> array(  90,  90, true),
			'shieldgroup-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'shieldgroup-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = shieldgroup_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'shieldgroup_filter_content_width', 1290*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('shieldgroup_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'shieldgroup_customizer_image_sizes' );
	function shieldgroup_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('shieldgroup_filter_add_thumb_sizes', array(
			'shieldgroup-thumb-huge'		=> esc_html__( 'Huge image', 'shieldgroup' ),
			'shieldgroup-thumb-big'			=> esc_html__( 'Large image', 'shieldgroup' ),
			'shieldgroup-thumb-med'			=> esc_html__( 'Medium image', 'shieldgroup' ),
			'shieldgroup-thumb-tiny'		=> esc_html__( 'Small square avatar', 'shieldgroup' ),
			'shieldgroup-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'shieldgroup' ),
			'shieldgroup-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'shieldgroup' ),
			)
		);
		$mult = shieldgroup_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'shieldgroup' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'shieldgroup_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'shieldgroup_customizer_trx_addons_add_thumb_sizes');
	function shieldgroup_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'shieldgroup_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'shieldgroup_customizer_trx_addons_get_thumb_size');
	function shieldgroup_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
            'trx_addons-thumb-posts',
            'trx_addons-thumb-posts-@retina',
            'trx_addons-thumb-post',
            'trx_addons-thumb-post-@retina',
            'trx_addons-thumb-serv',
            'trx_addons-thumb-serv-@retina',
            'trx_addons-thumb-team',
            'trx_addons-thumb-team-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'shieldgroup-thumb-huge',
							'shieldgroup-thumb-huge-@retina',
							'shieldgroup-thumb-big',
							'shieldgroup-thumb-big-@retina',
							'shieldgroup-thumb-med',
							'shieldgroup-thumb-med-@retina',
                                'shieldgroup-thumb-posts',
                                'shieldgroup-thumb-posts-@retina',
                                'shieldgroup-thumb-post',
                                'shieldgroup-thumb-post-@retina',
                                'shieldgroup-thumb-serv',
                                'shieldgroup-thumb-serv-@retina',
                                'shieldgroup-thumb-team',
                                'shieldgroup-thumb-team-@retina',
							'shieldgroup-thumb-tiny',
							'shieldgroup-thumb-tiny-@retina',
							'shieldgroup-thumb-masonry-big',
							'shieldgroup-thumb-masonry-big-@retina',
							'shieldgroup-thumb-masonry',
							'shieldgroup-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'shieldgroup_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'shieldgroup_importer_set_options', 9 );
	function shieldgroup_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(shieldgroup_get_protocol() . '://demofiles.ancorathemes.com/sheildgroup/');
			// Required plugins
			$options['required_plugins'] = array_keys(shieldgroup_storage_get('required_plugins'));
			// Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 3;
			// Default demo
			$options['files']['default']['title'] = esc_html__('ShieldGroup Demo', 'shieldgroup');
			$options['files']['default']['domain_dev'] = esc_url(shieldgroup_get_protocol().'://sheildgroup.dv.ancorathemes.com');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(shieldgroup_get_protocol().'://shieldgroup.ancorathemes.com');		// Demo-site domain
			// Banners
			$options['banners'] = array(
									array(
										'image' => shieldgroup_get_file_url('theme-specific/theme.about/images/frontpage.png'),
										'title' => esc_html__('Front page Builder', 'shieldgroup'),
										'content' => wp_kses_post(__('Create your Frontpage right in WordPress Customizer! To do this, you will not need either the Visual Composer or any other Builder. Just turn on/off sections, and fill them with content and decorate to your liking', 'shieldgroup')),
										'link_url' => esc_url('//www.youtube.com/watch?v=VT0AUbMl_KA'),
										'link_caption' => esc_html__('More about Frontpage Builder', 'shieldgroup'),
										'duration' => 20
										),
									array(
										'image' => shieldgroup_get_file_url('theme-specific/theme.about/images/layouts.png'),
										'title' => esc_html__('Custom layouts', 'shieldgroup'),
										'content' => wp_kses_post(__('Forget about problems with customization of header or footer! You can edit any layout without any changes in CSS or HTML, directly in Visual Builder. Moreover - you can easily create your own headers and footers and use them along with built-in', 'shieldgroup')),
										'link_url' => esc_url('//www.youtube.com/watch?v=pYhdFVLd7y4'),
										'link_caption' => esc_html__('More about Custom Layouts', 'shieldgroup'),
										'duration' => 20
										),
									array(
										'image' => shieldgroup_get_file_url('theme-specific/theme.about/images/documentation.png'),
										'title' => esc_html__('Read full documentation', 'shieldgroup'),
										'content' => wp_kses_post(__('Need more details? Please check our full online documentation for detailed information on how to use ShieldGroup', 'shieldgroup')),
										'link_url' => esc_url(shieldgroup_storage_get('theme_doc_url')),
										'link_caption' => esc_html__('Online documentation', 'shieldgroup'),
										'duration' => 15
										),
									array(
										'image' => shieldgroup_get_file_url('theme-specific/theme.about/images/video-tutorials.png'),
										'title' => esc_html__('Video tutorials', 'shieldgroup'),
										'content' => wp_kses_post(__('No time for reading documentation? Check out our video tutorials and learn how to customize ShieldGroup in detail.', 'shieldgroup')),
										'link_url' => esc_url(shieldgroup_storage_get('theme_video_url')),
										'link_caption' => esc_html__('Video tutorials', 'shieldgroup'),
										'duration' => 15
										),
									array(
										'image' => shieldgroup_get_file_url('theme-specific/theme.about/images/studio.png'),
										'title' => esc_html__('Mockingbird Website Custom studio', 'shieldgroup'),
										'content' => wp_kses_post(__('We can make a website based on this theme for a very fair price.
We can implement any extra functional: translate your website, WPML implementation and many other customization according to your request.', 'shieldgroup')),
										'link_url' => esc_url('//mockingbird.ticksy.com/'),
										'link_caption' => esc_html__('Contact us', 'shieldgroup'),
										'duration' => 25
										)
									);
		}
		return $options;
	}
}




// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('shieldgroup_create_theme_options')) {

	function shieldgroup_create_theme_options() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __('<b>Attention!</b> Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages', 'shieldgroup');

		shieldgroup_storage_set('options', array(
		
			// 'Logo & Site Identity'
			'title_tagline' => array(
				"title" => esc_html__('Logo & Site Identity', 'shieldgroup'),
				"desc" => '',
				"priority" => 10,
				"type" => "section"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo in the header', 'shieldgroup'),
				"desc" => '',
				"priority" => 20,
				"type" => "info",
				),
			'logo_text' => array(
				"title" => esc_html__('Use Site Name as Logo', 'shieldgroup'),
				"desc" => wp_kses_data( __('Use the site title and tagline as a text logo if no image is selected', 'shieldgroup') ),
				"class" => "shieldgroup_column-1_2 shieldgroup_new_row",
				"priority" => 30,
				"std" => 1,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_retina_enabled' => array(
				"title" => esc_html__('Allow retina display logo', 'shieldgroup'),
				"desc" => wp_kses_data( __('Show fields to select logo images for Retina display', 'shieldgroup') ),
				"class" => "shieldgroup_column-1_2",
				"priority" => 40,
				"refresh" => false,
				"std" => 0,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_max_height' => array(
				"title" => esc_html__('Logo max. height', 'shieldgroup'),
				"desc" => wp_kses_data( __("Max. height of the logo image (in pixels). Maximum size of logo depends on the actual size of the picture", 'shieldgroup') ),
				"std" => 80,
				"min" => 20,
				"max" => 160,
				"step" => 1,
				"refresh" => false,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "slider"
				),
			// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'shieldgroup') ),
				"class" => "shieldgroup_column-1_2",
				"priority" => 70,
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile_header' => array(
				"title" => esc_html__('Logo for the mobile header', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'shieldgroup') ),
				"class" => "shieldgroup_column-1_2 shieldgroup_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_header_retina' => array(
				"title" => esc_html__('Logo for the mobile header for Retina', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'shieldgroup') ),
				"class" => "shieldgroup_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile' => array(
				"title" => esc_html__('Logo mobile', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile menu', 'shieldgroup') ),
				"class" => "shieldgroup_column-1_2 shieldgroup_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_retina' => array(
				"title" => esc_html__('Logo mobile for Retina', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'shieldgroup') ),
				"class" => "shieldgroup_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'shieldgroup') ),
				"class" => "shieldgroup_column-1_2 shieldgroup_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'shieldgroup') ),
				"class" => "shieldgroup_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "image"
				),
			
		
		
			// 'General settings'
			'general' => array(
				"title" => esc_html__('General Settings', 'shieldgroup'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 20,
				"type" => "section",
				),

			'general_layout_info' => array(
				"title" => esc_html__('Layout', 'shieldgroup'),
				"desc" => '',
				"type" => "info",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select width of the body content', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'shieldgroup')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => shieldgroup_get_list_body_styles(),
				"type" => "select"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'shieldgroup') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'shieldgroup')
				),
				"std" => '',
				"hidden" => true,
				"type" => "image"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'shieldgroup'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'shieldgroup')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),

			'general_sidebar_info' => array(
				"title" => esc_html__('Sidebar', 'shieldgroup'),
				"desc" => '',
				"type" => "info",
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'shieldgroup')
				),
				"std" => 'right',
				"options" => array(),
				"type" => "switch"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'shieldgroup')
				),
				"dependency" => array(
					'sidebar_position' => array('left', 'right')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'shieldgroup'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'shieldgroup') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),


			'general_widgets_info' => array(
				"title" => esc_html__('Additional widgets', 'shieldgroup'),
				"desc" => '',
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "info",
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'shieldgroup')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'shieldgroup')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'shieldgroup')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'shieldgroup')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
				),

			'general_effects_info' => array(
				"title" => esc_html__('Design & Effects', 'shieldgroup'),
				"desc" => '',
				"type" => "info",
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'shieldgroup'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'shieldgroup') ),
				"std" => 0,
				"type" => "text"
				),

			'general_misc_info' => array(
				"title" => esc_html__('Miscellaneous', 'shieldgroup'),
				"desc" => '',
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "info",
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'shieldgroup'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'shieldgroup') ),
				"std" => 0,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),
            'privacy_text' => array(
                "title" => esc_html__("Text with Privacy Policy link", 'shieldgroup'),
                "desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'shieldgroup') ),
                "std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'shieldgroup') ),
                "type"  => "text"
            ),
		
		
			// 'Header'
			'header' => array(
				"title" => esc_html__('Header', 'shieldgroup'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 30,
				"type" => "section"
				),

			'header_style_info' => array(
				"title" => esc_html__('Header style', 'shieldgroup'),
				"desc" => '',
				"type" => "info"
				),
			'header_type' => array(
				"title" => esc_html__('Header style', 'shieldgroup'),
				"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'shieldgroup')
				),
				"std" => 'default',
				"options" => shieldgroup_get_list_header_footer_types(),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "switch"
				),
			'header_style' => array(
				"title" => esc_html__('Select custom layout', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select custom header from Layouts Builder', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'shieldgroup')
				),
				"dependency" => array(
					'header_type' => array('custom')
				),
				"std" => SHIELDGROUP_THEME_FREE ? 'header-default' : 'header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'shieldgroup')
				),
				"std" => 'default',
				"options" => array(),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "switch"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'shieldgroup'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'shieldgroup')
				),
				"std" => 0,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_zoom' => array(
				"title" => esc_html__('Header zoom', 'shieldgroup'),
				"desc" => wp_kses_data( __("Zoom the header title. 1 - original size", 'shieldgroup') ),
				"std" => 1,
				"min" => 0.3,
				"max" => 2,
				"step" => 0.1,
				"refresh" => false,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "slider"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'shieldgroup'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'shieldgroup')
				),
				"dependency" => array(
					'header_type' => array('default')
				),
				"std" => 1,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_widgets_info' => array(
				"title" => esc_html__('Header widgets', 'shieldgroup'),
				"desc" => wp_kses_data( __('Here you can place a widget slider, advertising banners, etc.', 'shieldgroup') ),
				"type" => "info"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'shieldgroup'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'shieldgroup') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'shieldgroup')
				),
				"dependency" => array(
					'header_type' => array('default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => shieldgroup_get_list_range(0,6),
				"type" => "select"
				),

			'menu_info' => array(
				"title" => esc_html__('Main menu', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'shieldgroup') ),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'shieldgroup')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'shieldgroup'),
					'left'	=> esc_html__('Left',	'shieldgroup'),
					'right'	=> esc_html__('Right',	'shieldgroup')
				),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "switch"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'shieldgroup'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'shieldgroup')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 0,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'shieldgroup'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'shieldgroup')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'shieldgroup'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'shieldgroup') ),
				"std" => 1,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_image_info' => array(
				"title" => esc_html__('Header image', 'shieldgroup'),
				"desc" => '',
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "info"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'shieldgroup'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'shieldgroup') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'shieldgroup')
				),
				"std" => 0,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_mobile_info' => array(
				"title" => esc_html__('Mobile header', 'shieldgroup'),
				"desc" => wp_kses_data( __("Configure the mobile version of the header", 'shieldgroup') ),
				"priority" => 500,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "info"
				),
			'header_mobile_enabled' => array(
				"title" => esc_html__('Enable the mobile header', 'shieldgroup'),
				"desc" => wp_kses_data( __("Use the mobile version of the header (if checked) or relayout the current header on mobile devices", 'shieldgroup') ),
				"std" => 0,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_additional_info' => array(
				"title" => esc_html__('Additional info', 'shieldgroup'),
				"desc" => wp_kses_data( __('Additional info to show at the top of the mobile header', 'shieldgroup') ),
				"std" => '',
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"refresh" => false,
				"teeny" => false,
				"rows" => 20,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "text_editor"
				),
			'header_mobile_hide_info' => array(
				"title" => esc_html__('Hide additional info', 'shieldgroup'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_logo' => array(
				"title" => esc_html__('Hide logo', 'shieldgroup'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_login' => array(
				"title" => esc_html__('Hide login/logout', 'shieldgroup'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_search' => array(
				"title" => esc_html__('Hide search', 'shieldgroup'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_cart' => array(
				"title" => esc_html__('Hide cart', 'shieldgroup'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
				),


		
			// 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'shieldgroup'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 50,
				"type" => "section"
				),
			'footer_type' => array(
				"title" => esc_html__('Footer style', 'shieldgroup'),
				"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'shieldgroup')
				),
				"std" => 'default',
				"options" => shieldgroup_get_list_header_footer_types(),
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "switch"
				),
			'footer_style' => array(
				"title" => esc_html__('Select custom layout', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select custom footer from Layouts Builder', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'shieldgroup')
				),
				"dependency" => array(
					'footer_type' => array('custom')
				),
				"std" => SHIELDGROUP_THEME_FREE ? 'footer-default' : 'footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'shieldgroup')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'shieldgroup')
				),
				"dependency" => array(
					'footer_type' => array('default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => shieldgroup_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'shieldgroup'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'shieldgroup') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'shieldgroup')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'shieldgroup'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'shieldgroup') ),
				'refresh' => false,
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'shieldgroup') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1)
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'shieldgroup') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1),
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'shieldgroup'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'shieldgroup') ),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'shieldgroup'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'shieldgroup') ),
				"std" => esc_html__('AncoraThemes &copy; {Y}. All rights reserved.', 'shieldgroup'),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
			
		
		
			// 'Blog'
			'blog' => array(
				"title" => esc_html__('Blog', 'shieldgroup'),
				"desc" => wp_kses_data( __('Options of the the blog archive', 'shieldgroup') ),
				"priority" => 70,
				"type" => "panel",
				),
		
				// Blog - Posts page
				'blog_general' => array(
					"title" => esc_html__('Posts page', 'shieldgroup'),
					"desc" => wp_kses_data( __('Style and components of the blog archive', 'shieldgroup') ),
					"type" => "section",
					),
				'blog_general_info' => array(
					"title" => esc_html__('General settings', 'shieldgroup'),
					"desc" => '',
					"type" => "info",
					),
				'blog_style' => array(
					"title" => esc_html__('Blog style', 'shieldgroup'),
					"desc" => '',
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'shieldgroup')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"std" => 'excerpt',
					"options" => array(),
					"type" => "select"
					),
				'first_post_large' => array(
					"title" => esc_html__('First post large', 'shieldgroup'),
					"desc" => wp_kses_data( __('Make your first post stand out by making it bigger', 'shieldgroup') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'shieldgroup')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style' => array('classic', 'masonry')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				"blog_content" => array( 
					"title" => esc_html__('Posts content', 'shieldgroup'),
					"desc" => wp_kses_data( __("Display either post excerpts or the full post content", 'shieldgroup') ),
					"std" => "excerpt",
					"dependency" => array(
						'blog_style' => array('excerpt')
					),
					"options" => array(
						'excerpt'	=> esc_html__('Excerpt',	'shieldgroup'),
						'fullpost'	=> esc_html__('Full post',	'shieldgroup')
					),
					"type" => "switch"
					),
				'excerpt_length' => array(
					"title" => esc_html__('Excerpt length', 'shieldgroup'),
					"desc" => wp_kses_data( __("Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged", 'shieldgroup') ),
					"dependency" => array(
						'blog_style' => array('excerpt'),
						'blog_content' => array('excerpt')
					),
					"std" => 60,
					"type" => "text"
					),
				'blog_columns' => array(
					"title" => esc_html__('Blog columns', 'shieldgroup'),
					"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'shieldgroup') ),
					"std" => 2,
					"options" => shieldgroup_get_list_range(2,4),
					"type" => "hidden"
					),
				'post_type' => array(
					"title" => esc_html__('Post type', 'shieldgroup'),
					"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'shieldgroup') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'shieldgroup')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"linked" => 'parent_cat',
					"refresh" => false,
					"hidden" => true,
					"std" => 'post',
					"options" => array(),
					"type" => "select"
					),
				'parent_cat' => array(
					"title" => esc_html__('Category to show', 'shieldgroup'),
					"desc" => wp_kses_data( __('Select category to show in the blog archive', 'shieldgroup') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'shieldgroup')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"refresh" => false,
					"hidden" => true,
					"std" => '0',
					"options" => array(),
					"type" => "select"
					),
				'posts_per_page' => array(
					"title" => esc_html__('Posts per page', 'shieldgroup'),
					"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'shieldgroup') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'shieldgroup')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"hidden" => true,
					"std" => '',
					"type" => "text"
					),
				"blog_pagination" => array( 
					"title" => esc_html__('Pagination style', 'shieldgroup'),
					"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'shieldgroup') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'shieldgroup')
					),
					"std" => "pages",
					"options" => array(
						'pages'	=> esc_html__("Page numbers", 'shieldgroup'),
						'links'	=> esc_html__("Older/Newest", 'shieldgroup'),
						'more'	=> esc_html__("Load more", 'shieldgroup'),
						'infinite' => esc_html__("Infinite scroll", 'shieldgroup')
					),
					"type" => "select"
					),
				'show_filters' => array(
					"title" => esc_html__('Show filters', 'shieldgroup'),
					"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'shieldgroup') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'shieldgroup')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style' => array('portfolio', 'gallery')
					),
					"hidden" => true,
					"std" => 0,
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
					),
	
				'blog_sidebar_info' => array(
					"title" => esc_html__('Sidebar', 'shieldgroup'),
					"desc" => '',
					"type" => "info",
					),
				'sidebar_position_blog' => array(
					"title" => esc_html__('Sidebar position', 'shieldgroup'),
					"desc" => wp_kses_data( __('Select position to show sidebar', 'shieldgroup') ),
					"std" => 'right',
					"options" => array(),
					"type" => "switch"
					),
				'sidebar_widgets_blog' => array(
					"title" => esc_html__('Sidebar widgets', 'shieldgroup'),
					"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'shieldgroup') ),
					"dependency" => array(
						'sidebar_position_blog' => array('left', 'right')
					),
					"std" => 'sidebar_widgets',
					"options" => array(),
					"type" => "select"
					),
				'expand_content_blog' => array(
					"title" => esc_html__('Expand content', 'shieldgroup'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'shieldgroup') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
	
	
				'blog_widgets_info' => array(
					"title" => esc_html__('Additional widgets', 'shieldgroup'),
					"desc" => '',
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "info",
					),
				'widgets_above_page_blog' => array(
					"title" => esc_html__('Widgets at the top of the page', 'shieldgroup'),
					"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'shieldgroup') ),
					"std" => 'hide',
					"options" => array(),
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
					),
				'widgets_above_content_blog' => array(
					"title" => esc_html__('Widgets above the content', 'shieldgroup'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'shieldgroup') ),
					"std" => 'hide',
					"options" => array(),
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_content_blog' => array(
					"title" => esc_html__('Widgets below the content', 'shieldgroup'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'shieldgroup') ),
					"std" => 'hide',
					"options" => array(),
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_page_blog' => array(
					"title" => esc_html__('Widgets at the bottom of the page', 'shieldgroup'),
					"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'shieldgroup') ),
					"std" => 'hide',
					"options" => array(),
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
					),

				'blog_advanced_info' => array(
					"title" => esc_html__('Advanced settings', 'shieldgroup'),
					"desc" => '',
					"type" => "info",
					),
				'no_image' => array(
					"title" => esc_html__('Image placeholder', 'shieldgroup'),
					"desc" => wp_kses_data( __('Select or upload an image used as placeholder for posts without a featured image', 'shieldgroup') ),
					"std" => '',
					"type" => "image"
					),
				'time_diff_before' => array(
					"title" => esc_html__('Easy Readable Date Format', 'shieldgroup'),
					"desc" => wp_kses_data( __("For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'shieldgroup') ),
					"std" => 0,
					"type" => "text"
					),
				'sticky_style' => array(
					"title" => esc_html__('Sticky posts style', 'shieldgroup'),
					"desc" => wp_kses_data( __('Select style of the sticky posts output', 'shieldgroup') ),
					"std" => 'inherit',
					"options" => array(
						'inherit' => esc_html__('Decorated posts', 'shieldgroup'),
						'columns' => esc_html__('Mini-cards',	'shieldgroup')
					),
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
					),
				"blog_animation" => array( 
					"title" => esc_html__('Animation for the posts', 'shieldgroup'),
					"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'shieldgroup') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'shieldgroup')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"std" => "none",
					"options" => array(),
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
					),
				'meta_parts' => array(
					"title" => esc_html__('Post meta', 'shieldgroup'),
					"desc" => wp_kses_data( __("If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page.", 'shieldgroup') )
								. '<br>'
								. wp_kses_data( __("<b>Tip:</b> Drag items to change their order.", 'shieldgroup') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'shieldgroup')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=0|date=1|author=1|counters=1|share=0|edit=0',
					"options" => array(
						'categories' => esc_html__('Categories', 'shieldgroup'),
						'date'		 => esc_html__('Post date', 'shieldgroup'),
						'author'	 => esc_html__('Post author', 'shieldgroup'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'shieldgroup'),
						'share'		 => esc_html__('Share links', 'shieldgroup'),
						'edit'		 => esc_html__('Edit link', 'shieldgroup')
					),
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checklist"
				),
				'counters' => array(
					"title" => esc_html__('Views, Likes and Comments', 'shieldgroup'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'shieldgroup') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'shieldgroup')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'comments=1|views=0|likes=0',
					"options" => array(
						'views' => esc_html__('Views', 'shieldgroup'),
						'likes' => esc_html__('Likes', 'shieldgroup'),
						'comments' => esc_html__('Comments', 'shieldgroup')
					),
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checklist"
				),

				
				// Blog - Single posts
				'blog_single' => array(
					"title" => esc_html__('Single posts', 'shieldgroup'),
					"desc" => wp_kses_data( __('Settings of the single post', 'shieldgroup') ),
					"type" => "section",
					),
				'hide_featured_on_single' => array(
					"title" => esc_html__('Hide featured image on the single post', 'shieldgroup'),
					"desc" => wp_kses_data( __("Hide featured image on the single post's pages", 'shieldgroup') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'shieldgroup')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'hide_sidebar_on_single' => array(
					"title" => esc_html__('Hide sidebar on the single post', 'shieldgroup'),
					"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'shieldgroup') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'show_post_meta' => array(
					"title" => esc_html__('Show post meta', 'shieldgroup'),
					"desc" => wp_kses_data( __("Display block with post's meta: date, categories, counters, etc.", 'shieldgroup') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'meta_parts_post' => array(
					"title" => esc_html__('Post meta', 'shieldgroup'),
					"desc" => wp_kses_data( __("Meta parts for single posts.", 'shieldgroup') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=0|date=1|author=1|counters=1|share=0|edit=0',
					"options" => array(
						'categories' => esc_html__('Categories', 'shieldgroup'),
						'date'		 => esc_html__('Post date', 'shieldgroup'),
						'author'	 => esc_html__('Post author', 'shieldgroup'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'shieldgroup'),
						'share'		 => esc_html__('Share links', 'shieldgroup'),
						'edit'		 => esc_html__('Edit link', 'shieldgroup')
					),
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checklist"
				),
				'counters_post' => array(
					"title" => esc_html__('Views, Likes and Comments', 'shieldgroup'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'shieldgroup') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'comments=1|views=0|likes=0',
					"options" => array(
						'views' => esc_html__('Views', 'shieldgroup'),
						'likes' => esc_html__('Likes', 'shieldgroup'),
						'comments' => esc_html__('Comments', 'shieldgroup')
					),
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checklist"
				),
				'show_share_links' => array(
					"title" => esc_html__('Show share links', 'shieldgroup'),
					"desc" => wp_kses_data( __("Display share links on the single post", 'shieldgroup') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'show_author_info' => array(
					"title" => esc_html__('Show author info', 'shieldgroup'),
					"desc" => wp_kses_data( __("Display block with information about post's author", 'shieldgroup') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'blog_single_related_info' => array(
					"title" => esc_html__('Related posts', 'shieldgroup'),
					"desc" => '',
					"type" => "info",
					),
				'show_related_posts' => array(
					"title" => esc_html__('Show related posts', 'shieldgroup'),
					"desc" => wp_kses_data( __("Show section 'Related posts' on the single post's pages", 'shieldgroup') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'shieldgroup')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'related_posts' => array(
					"title" => esc_html__('Related posts', 'shieldgroup'),
					"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts shown.', 'shieldgroup') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => shieldgroup_get_list_range(1,9),
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
					),
				'related_columns' => array(
					"title" => esc_html__('Related columns', 'shieldgroup'),
					"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'shieldgroup') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => shieldgroup_get_list_range(1,4),
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "switch"
					),
				'related_style' => array(
					"title" => esc_html__('Related posts style', 'shieldgroup'),
					"desc" => wp_kses_data( __('Select style of the related posts output', 'shieldgroup') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => shieldgroup_get_list_styles(1,2),
					"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "switch"
					),
			'blog_end' => array(
				"type" => "panel_end",
				),
			
		
		
			// 'Colors'
			'panel_colors' => array(
				"title" => esc_html__('Colors', 'shieldgroup'),
				"desc" => '',
				"priority" => 300,
				"type" => "section"
				),

			'color_schemes_info' => array(
				"title" => esc_html__('Color schemes', 'shieldgroup'),
				"desc" => wp_kses_data( __('Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'shieldgroup') ),
				"type" => "info",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'shieldgroup'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'shieldgroup')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'shieldgroup'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'shieldgroup')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Sidemenu Color Scheme', 'shieldgroup'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'shieldgroup')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "switch"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'shieldgroup'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'shieldgroup')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'shieldgroup'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'shieldgroup')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),

			'color_scheme_editor_info' => array(
				"title" => esc_html__('Color scheme editor', 'shieldgroup'),
				"desc" => wp_kses_data(__('Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'shieldgroup') ),
				"type" => "info",
				),
			'scheme_storage' => array(
				"title" => esc_html__('Color scheme editor', 'shieldgroup'),
				"desc" => '',
				"std" => '$shieldgroup_get_scheme_storage',
				"refresh" => false,
				"colorpicker" => "tiny",
				"type" => "scheme_editor"
				),


			// 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'shieldgroup'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'shieldgroup') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'shieldgroup')
				),
				"hidden" => true,
				"std" => '',
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'shieldgroup'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'shieldgroup') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'shieldgroup')
				),
				"hidden" => true,
				"std" => '',
				"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			// Use huge priority to call render this elements after all options!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"priority" => 10000,
				"type" => "hidden",
				),

			'last_option' => array(		// Need to manually call action to include Tiny MCE scripts
				"title" => '',
				"desc" => '',
				"std" => 1,
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// 'Fonts'
			'fonts' => array(
				"title" => esc_html__('Typography', 'shieldgroup'),
				"desc" => '',
				"priority" => 200,
				"type" => "panel"
				),

			// Fonts - Load_fonts
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'shieldgroup'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'shieldgroup') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'shieldgroup') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'shieldgroup'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'shieldgroup') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'shieldgroup') ),
				"class" => "shieldgroup_column-1_3 shieldgroup_new_row",
				"refresh" => false,
				"std" => '$shieldgroup_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=shieldgroup_get_theme_setting('max_load_fonts'); $i++) {
			if (shieldgroup_get_value_gp('page') != 'theme_options') {
				$fonts["load_fonts-{$i}-info"] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					"title" => esc_html(sprintf(__('Font %s', 'shieldgroup'), $i)),
					"desc" => '',
					"type" => "info",
					);
			}
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'shieldgroup'),
				"desc" => '',
				"class" => "shieldgroup_column-1_3 shieldgroup_new_row",
				"refresh" => false,
				"std" => '$shieldgroup_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'shieldgroup'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'shieldgroup') )
							: '',
				"class" => "shieldgroup_column-1_3",
				"refresh" => false,
				"std" => '$shieldgroup_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'shieldgroup'),
					'serif' => esc_html__('serif', 'shieldgroup'),
					'sans-serif' => esc_html__('sans-serif', 'shieldgroup'),
					'monospace' => esc_html__('monospace', 'shieldgroup'),
					'cursive' => esc_html__('cursive', 'shieldgroup'),
					'fantasy' => esc_html__('fantasy', 'shieldgroup')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'shieldgroup'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'shieldgroup') )
								. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'shieldgroup') )
							: '',
				"class" => "shieldgroup_column-1_3",
				"refresh" => false,
				"std" => '$shieldgroup_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = shieldgroup_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html(sprintf(__('%s settings', 'shieldgroup'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								// Translators: Add tag's name to make description
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'shieldgroup'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'shieldgroup'),
						'100' => esc_html__('100 (Light)', 'shieldgroup'), 
						'200' => esc_html__('200 (Light)', 'shieldgroup'), 
						'300' => esc_html__('300 (Thin)',  'shieldgroup'),
						'400' => esc_html__('400 (Normal)', 'shieldgroup'),
						'500' => esc_html__('500 (Semibold)', 'shieldgroup'),
						'600' => esc_html__('600 (Semibold)', 'shieldgroup'),
						'700' => esc_html__('700 (Bold)', 'shieldgroup'),
						'800' => esc_html__('800 (Black)', 'shieldgroup'),
						'900' => esc_html__('900 (Black)', 'shieldgroup')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'shieldgroup'),
						'normal' => esc_html__('Normal', 'shieldgroup'), 
						'italic' => esc_html__('Italic', 'shieldgroup')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'shieldgroup'),
						'none' => esc_html__('None', 'shieldgroup'), 
						'underline' => esc_html__('Underline', 'shieldgroup'),
						'overline' => esc_html__('Overline', 'shieldgroup'),
						'line-through' => esc_html__('Line-through', 'shieldgroup')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'shieldgroup'),
						'none' => esc_html__('None', 'shieldgroup'), 
						'uppercase' => esc_html__('Uppercase', 'shieldgroup'),
						'lowercase' => esc_html__('Lowercase', 'shieldgroup'),
						'capitalize' => esc_html__('Capitalize', 'shieldgroup')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"class" => "shieldgroup_column-1_5",
					"refresh" => false,
					"std" => '$shieldgroup_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters to Theme Options
		shieldgroup_storage_set_array_before('options', 'panel_colors', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			shieldgroup_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'shieldgroup'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'shieldgroup') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'shieldgroup')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is 'Theme Options'
		if (!function_exists('the_custom_logo') || (isset($_REQUEST['page']) && $_REQUEST['page']=='theme_options')) {
			shieldgroup_storage_set_array_before('options', 'logo_retina', function_exists('the_custom_logo') ? 'custom_logo' : 'logo', array(
				"title" => esc_html__('Logo', 'shieldgroup'),
				"desc" => wp_kses_data( __('Select or upload the site logo', 'shieldgroup') ),
				"class" => "shieldgroup_column-1_2 shieldgroup_new_row",
				"priority" => 60,
				"std" => '',
				"type" => "image"
				)
			);
		}
	}
}


// Returns a list of options that can be overridden for CPT
if (!function_exists('shieldgroup_options_get_list_cpt_options')) {
	function shieldgroup_options_get_list_cpt_options($cpt, $title='') {
		if (empty($title)) $title = ucfirst($cpt);
		return array(
					"header_info_{$cpt}" => array(
						"title" => esc_html__('Header', 'shieldgroup'),
						"desc" => '',
						"type" => "info",
						),
					"header_type_{$cpt}" => array(
						"title" => esc_html__('Header style', 'shieldgroup'),
						"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'shieldgroup') ),
						"std" => 'inherit',
						"options" => shieldgroup_get_list_header_footer_types(true),
						"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "switch"
						),
					"header_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'shieldgroup'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select custom layout to display the site header on the %s pages', 'shieldgroup'), $title) ),
						"dependency" => array(
							"header_type_{$cpt}" => array('custom')
						),
						"std" => 'inherit',
						"options" => array(),
						"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
						),
					"header_position_{$cpt}" => array(
						"title" => esc_html__('Header position', 'shieldgroup'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to display the site header on the %s pages', 'shieldgroup'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "switch"
						),
					"header_image_override_{$cpt}" => array(
						"title" => esc_html__('Header image override', 'shieldgroup'),
						"desc" => wp_kses_data( __("Allow override the header image with the post's featured image", 'shieldgroup') ),
						"std" => 0,
						"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "checkbox"
						),
					"header_widgets_{$cpt}" => array(
						"title" => esc_html__('Header widgets', 'shieldgroup'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select set of widgets to show in the header on the %s pages', 'shieldgroup'), $title) ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
						
					"sidebar_info_{$cpt}" => array(
						"title" => esc_html__('Sidebar', 'shieldgroup'),
						"desc" => '',
						"type" => "info",
						),
					"sidebar_position_{$cpt}" => array(
						"title" => esc_html__('Sidebar position', 'shieldgroup'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to show sidebar on the %s pages', 'shieldgroup'), $title) ),
						"refresh" => false,
						"std" => 'left',
						"options" => array(),
						"type" => "switch"
						),
					"sidebar_widgets_{$cpt}" => array(
						"title" => esc_html__('Sidebar widgets', 'shieldgroup'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select sidebar to show on the %s pages', 'shieldgroup'), $title) ),
						"dependency" => array(
							"sidebar_position_{$cpt}" => array('left', 'right')
						),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"hide_sidebar_on_single_{$cpt}" => array(
						"title" => esc_html__('Hide sidebar on the single pages', 'shieldgroup'),
						"desc" => wp_kses_data( __("Hide sidebar on the single page", 'shieldgroup') ),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"footer_info_{$cpt}" => array(
						"title" => esc_html__('Footer', 'shieldgroup'),
						"desc" => '',
						"type" => "info",
						),
					"footer_type_{$cpt}" => array(
						"title" => esc_html__('Footer style', 'shieldgroup'),
						"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'shieldgroup') ),
						"std" => 'inherit',
						"options" => shieldgroup_get_list_header_footer_types(true),
						"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "switch"
						),
					"footer_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'shieldgroup'),
						"desc" => wp_kses_data( __('Select custom layout to display the site footer', 'shieldgroup') ),
						"std" => 'inherit',
						"dependency" => array(
							"footer_type_{$cpt}" => array('custom')
						),
						"options" => array(),
						"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
						),
					"footer_widgets_{$cpt}" => array(
						"title" => esc_html__('Footer widgets', 'shieldgroup'),
						"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'shieldgroup') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 'footer_widgets',
						"options" => array(),
						"type" => "select"
						),
					"footer_columns_{$cpt}" => array(
						"title" => esc_html__('Footer columns', 'shieldgroup'),
						"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'shieldgroup') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default'),
							"footer_widgets_{$cpt}" => array('^hide')
						),
						"std" => 0,
						"options" => shieldgroup_get_list_range(0,6),
						"type" => "select"
						),
					"footer_wide_{$cpt}" => array(
						"title" => esc_html__('Footer fullwide', 'shieldgroup'),
						"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'shieldgroup') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"widgets_info_{$cpt}" => array(
						"title" => esc_html__('Additional panels', 'shieldgroup'),
						"desc" => '',
						"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "info",
						),
					"widgets_above_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the top of the page', 'shieldgroup'),
						"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'shieldgroup') ),
						"std" => 'hide',
						"options" => array(),
						"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
						),
					"widgets_above_content_{$cpt}" => array(
						"title" => esc_html__('Widgets above the content', 'shieldgroup'),
						"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'shieldgroup') ),
						"std" => 'hide',
						"options" => array(),
						"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_content_{$cpt}" => array(
						"title" => esc_html__('Widgets below the content', 'shieldgroup'),
						"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'shieldgroup') ),
						"std" => 'hide',
						"options" => array(),
						"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the bottom of the page', 'shieldgroup'),
						"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'shieldgroup') ),
						"std" => 'hide',
						"options" => array(),
						"type" => SHIELDGROUP_THEME_FREE ? "hidden" : "select"
						)
					);
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('shieldgroup_options_get_list_choises')) {
	add_filter('shieldgroup_filter_options_get_list_choises', 'shieldgroup_options_get_list_choises', 10, 2);
	function shieldgroup_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = shieldgroup_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = shieldgroup_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = shieldgroup_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (substr($id, -7) == '_scheme')
				$list = shieldgroup_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = shieldgroup_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = shieldgroup_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = shieldgroup_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = shieldgroup_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = shieldgroup_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = shieldgroup_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = shieldgroup_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = shieldgroup_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = shieldgroup_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = shieldgroup_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = shieldgroup_array_merge(array(0 => esc_html__('- Select category -', 'shieldgroup')), shieldgroup_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = shieldgroup_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = shieldgroup_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = shieldgroup_get_list_load_fonts(true);
		}
		return $list;
	}
}
?>