<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('shieldgroup_cf7_theme_setup9')) {
	add_action( 'after_setup_theme', 'shieldgroup_cf7_theme_setup9', 9 );
	function shieldgroup_cf7_theme_setup9() {
		
		if (shieldgroup_exists_cf7()) {
			add_action( 'wp_enqueue_scripts', 								'shieldgroup_cf7_frontend_scripts', 1100 );
			add_filter( 'shieldgroup_filter_merge_styles',						'shieldgroup_cf7_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'shieldgroup_filter_tgmpa_required_plugins',			'shieldgroup_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'shieldgroup_cf7_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('shieldgroup_filter_tgmpa_required_plugins',	'shieldgroup_cf7_tgmpa_required_plugins');
	function shieldgroup_cf7_tgmpa_required_plugins($list=array()) {
		if (shieldgroup_storage_isset('required_plugins', 'contact-form-7')) {
			// CF7 plugin
			$list[] = array(
					'name' 		=> shieldgroup_storage_get_array('required_plugins', 'contact-form-7'),
					'slug' 		=> 'contact-form-7',
					'required' 	=> false
			);
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( !function_exists( 'shieldgroup_exists_cf7' ) ) {
	function shieldgroup_exists_cf7() {
		return class_exists('WPCF7');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'shieldgroup_cf7_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'shieldgroup_cf7_frontend_scripts', 1100 );
	function shieldgroup_cf7_frontend_scripts() {
		if (shieldgroup_is_on(shieldgroup_get_theme_option('debug_mode')) && shieldgroup_get_file_dir('plugins/contact-form-7/contact-form-7.css')!='')
			wp_enqueue_style( 'shieldgroup-contact-form-7',  shieldgroup_get_file_url('plugins/contact-form-7/contact-form-7.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'shieldgroup_cf7_merge_styles' ) ) {
	//Handler of the add_filter('shieldgroup_filter_merge_styles', 'shieldgroup_cf7_merge_styles');
	function shieldgroup_cf7_merge_styles($list) {
		$list[] = 'plugins/contact-form-7/contact-form-7.css';
		return $list;
	}
}
?>