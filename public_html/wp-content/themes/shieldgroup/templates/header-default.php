<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */


$shieldgroup_header_css = $shieldgroup_header_image = '';
$shieldgroup_header_video = shieldgroup_get_header_video();
if (true || empty($shieldgroup_header_video)) {
	$shieldgroup_header_image = get_header_image();
	if (shieldgroup_trx_addons_featured_image_override()) $shieldgroup_header_image = shieldgroup_get_current_mode_image($shieldgroup_header_image);
}

?><header class="top_panel top_panel_default<?php
					echo !empty($shieldgroup_header_image) || !empty($shieldgroup_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($shieldgroup_header_video!='') echo ' with_bg_video';
					if ($shieldgroup_header_image!='') echo ' '.esc_attr(shieldgroup_add_inline_css_class('background-image: url('.esc_url($shieldgroup_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (shieldgroup_is_on(shieldgroup_get_theme_option('header_fullheight'))) echo ' header_fullheight shieldgroup-full-height';
					?> scheme_<?php echo esc_attr(shieldgroup_is_inherit(shieldgroup_get_theme_option('header_scheme')) 
													? shieldgroup_get_theme_option('color_scheme') 
													: shieldgroup_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($shieldgroup_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (shieldgroup_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	get_template_part( 'templates/header-single' );

?></header>