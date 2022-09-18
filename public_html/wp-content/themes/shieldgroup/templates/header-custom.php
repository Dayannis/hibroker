<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0.06
 */

$shieldgroup_header_css = $shieldgroup_header_image = '';
$shieldgroup_header_video = shieldgroup_get_header_video();
if (true || empty($shieldgroup_header_video)) {
	$shieldgroup_header_image = get_header_image();
	if (shieldgroup_trx_addons_featured_image_override()) $shieldgroup_header_image = shieldgroup_get_current_mode_image($shieldgroup_header_image);
}

$shieldgroup_header_id = str_replace('header-custom-', '', shieldgroup_get_theme_option("header_style"));
if ((int) $shieldgroup_header_id == 0) {
	$shieldgroup_header_id = shieldgroup_get_post_id(array(
												'name' => $shieldgroup_header_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
												)
											);
} else {
	$shieldgroup_header_id = apply_filters('shieldgroup_filter_get_translated_layout', $shieldgroup_header_id);
}
$shieldgroup_header_meta = get_post_meta($shieldgroup_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($shieldgroup_header_id); 
				?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($shieldgroup_header_id)));
				echo !empty($shieldgroup_header_image) || !empty($shieldgroup_header_video) 
					? ' with_bg_image' 
					: ' without_bg_image';
				if ($shieldgroup_header_video!='') 
					echo ' with_bg_video';
				if ($shieldgroup_header_image!='') 
					echo ' '.esc_attr(shieldgroup_add_inline_css_class('background-image: url('.esc_url($shieldgroup_header_image).');'));
				if (!empty($shieldgroup_header_meta['margin']) != '') 
					echo ' '.esc_attr(shieldgroup_add_inline_css_class('margin-bottom: '.esc_attr(shieldgroup_prepare_css_value($shieldgroup_header_meta['margin'])).';'));
				if (is_single() && has_post_thumbnail()) 
					echo ' with_featured_image';
				if (shieldgroup_is_on(shieldgroup_get_theme_option('header_fullheight'))) 
					echo ' header_fullheight shieldgroup-full-height';
				?> scheme_<?php echo esc_attr(shieldgroup_is_inherit(shieldgroup_get_theme_option('header_scheme')) 
												? shieldgroup_get_theme_option('color_scheme') 
												: shieldgroup_get_theme_option('header_scheme'));
				?>"><?php

	// Background video
	if (!empty($shieldgroup_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('shieldgroup_action_show_layout', $shieldgroup_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>